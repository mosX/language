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
                    
                }else{  //проверяем или она дествует
                    $this->m->_db->setQuery();
                }
                
                //получаем елементы для уровня
                $this->m->_db->setQuery(
                            "SELECT `questions`.* "
                            . " FROM `questions` "
                            . " WHERE `questions`.`lesson_id` = 1"
                            . " AND `questions`.`status` = 1"

                        );
                $this->m->data = $this->m->_db->loadObjectList();                
            }
        }
    }
?>