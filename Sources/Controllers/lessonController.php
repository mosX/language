<?php
    class lessonController extends Model {
        public function init() {            
        }

        public function indexAction(){
            $this->m->setTitle("Level1");

            $this->m->addJS("phaser.min");            
        }
        
        public function showAction(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $this->disableTemplate();
                $this->disableView();
                $this->m->_db->setQuery(
                            "SELECT * FROM `questions` WHERE `questions`.`lesson_id` = 1"
                            . " AND `questions`.`use` = 1"
                            . " AND `questions`.`status` = 1"
                            . " ORDER BY RAND()"
                            . " LIMIT 1"
                        );
                $this->m->_db->loadObject($data);
                echo json_encode($data);
            }else{
                if(!$this->m->_path[3]){    //создаем новую сессию
                    $row->user_id = $this->m->_user->id;
                    $row->lesson_id = $this->m->_path[2];
                    $row->uuid = md5(time());
                    $row->date = date("Y-m-d H:i:s");
                    $row->status = 1;
                    if($this->m->_db->insertObject('sessions',$row)){
                        
                        redirect('/lesson/show/'.$this->m->_path[2].'/'.$row->uuid);
                    }
                }else{  //проверяем или она дествует
                    $this->m->_db->setQuery(
                                "SELECT COUNT(*) as cnt "
                                . " FROM `sessions` WHERE `sessions`.`lesson_id` = ".(int)$this->m->_path[2]
                                . " AND `sessions`.`user_id` = ".$this->m->_user->id
                                . " AND `sessions`.`uuid` = '".$this->m->_path[3]."'"
                                . " LIMIT 1"
                            );
                    $session = $this->m->_db->loadResult();
                    
                    if($session){
                        //получаем елементы для уровня
                        $this->m->_db->setQuery(
                                    "SELECT `questions`.* "
                                    . " FROM `questions` "
                                    . " WHERE `questions`.`lesson_id` = 1"
                                    . " AND `questions`.`status` = 1"

                                );
                        $this->m->data = $this->m->_db->loadObjectList();                                        
                        
                    }else{
                        //redirect('/level/');
                    }
                }
                
                
            }
        }
    }
?>