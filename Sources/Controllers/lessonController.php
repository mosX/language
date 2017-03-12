<?php
    class lessonController extends Model {
        public function init() {            
            $_POST = json_decode(file_get_contents('php://input'), true);   //для Content-Type: application/json
        }

        public function indexAction(){
            $this->m->setTitle("Level1");

            $this->m->addJS("phaser.min");            
        }
        
        public function answerAction(){
            $this->disableTemplate();
            $this->disableView();            
            
            //проверяем или ответ был верен
            $this->m->_db->setQuery(
                        "SELECT * FROM `answers` WHERE `answers`.`item` = ".$_POST['item']
                        . " AND `answers`.`user_id` = ".$this->m->_user->id
                        . " AND `answers`.`lesson_id` = ".$_POST['lesson']
                        . " AND `answers`.`session` = '".$_POST['session']."'" 
                        . " AND `answers`.`status` = 0"
                        . " LIMIT 1"
                    );
            $this->m->_db->loadObject($result);
            
            if(!$result){
                //создаем неудачную попытку
                $row->user_id = $result->user_id;
                $row->lesson_id = $result->lesson_id;
                $row->session = $result->session;
                $row->item = $result->item;
                $row->answer = $_POST['item'];
                $row->status = 2;
                $row->date_answer = date("Y-m-d H:i:s");
                $this->m->_db->insertObject('answers',$row);
                
                echo '{"status":"error"}';
            }else{
                //меняем статус на удачный                
                $this->m->_db->setQuery(
                            "UPDATE `answers` SET `answers`.`status` = 1"
                            . " WHERE `answers`.`id` = ".$result->id
                            . " AND `answers`.`user_id` = ".$this->m->_user->id
                            . " AND `answers`.`session` = '".$result->session."'"
                            . " LIMIT 1"
                        );
                $this->m->_db->query();                
                
                echo '{"status":"success"}';
            }
        }
        
        public function questionAction(){
            $this->disableTemplate();
            $this->disableView();
            
            if(!$_POST['session']) return false;
            xload('class.answers');
            $answers = new Answers($this->m);
            
            //тут тоже сделать проверку или уже был задан вопрос какойто 
            $this->m->answer = $answers->checkActiveAnswers($_POST['lesson'], $_POST['session']);
            
            if($this->m->answer){   //повторяем неотвеченное
                
                $this->m->_db->setQuery(
                            "SELECT * FROM `questions` WHERE `questions`.`lesson_id` = ".$_POST['lesson']
                            . " AND `questions`.`use` = 1"
                            . " AND `questions`.`status` = 1"
                            . " AND `questions`.`id` = ".$this->m->answer->item                            
                            . " LIMIT 1"
                        );
                
            }else{           //выбираем случайное
                $this->m->_db->setQuery(
                            "SELECT * FROM `questions` WHERE `questions`.`lesson_id` = ".$_POST['lesson']
                            . " AND `questions`.`use` = 1"
                            . " AND `questions`.`status` = 1"
                            . " ORDER BY RAND()"
                            . " LIMIT 1"
                        );                
            }
            $this->m->_db->loadObject($data);
            
            echo json_encode($data);
            
            if(!$this->m->answer){
                //сохраняем в ответы как неотвеченное
                $row->user_id = $this->m->_user->id;
                $row->lesson_id = $_POST['lesson'];
                $row->session = $_POST['session'];
                $row->date_ask = date("Y-m-d H:i:s");
                $row->item = $data->id;
                $row->status = 0;
                if(!$this->m->_db->insertObject('answers',$row)){
                    p($this->m->_db->_sql);
                }
            }
        }
        
        public function showAction(){
                xload('class.session');
                $session = new Session($this->m);                    
            
                if(!$this->m->_path[3]){    //создаем новую сессию                    
                    redirect('/lesson/show/'.$this->m->_path[2].'/'.$session->createNewSession());
                }else{  //проверяем или она дествует
                    xload('class.answers');
                    xload('class.questions');
                    xload('class.lessons');
                    $answers = new Answers($this->m);                    
                    $question = new Questions($this->m);
                    $lessons = new Lessons($this->m);

                    if(!$session->checkSession($this->m->_path[2], $this->m->_path[3])) return;
                    
                    $this->m->lesson = $lessons->getLesson($this->m->_path[2]);
                    //p($this->m->lesson);
                    $this->m->answer = $answers->checkActiveAnswers($this->m->_path[2], $this->m->_path[3]);
                    $this->m->data = $question->getElements($this->m->_path[2]);
                }
        }
    }
?>