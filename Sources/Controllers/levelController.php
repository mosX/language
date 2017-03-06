<?php
    class levelController extends Model {
        public function init() {            
        }

        public function indexAction(){
            $this->m->setTitle("Level1");

            $this->m->addJS("phaser.min");            
            
            $this->m->_db->setQuery(
                        "SELECT * FROM `levels` WHERE `levels`.`status` = 1 "
                        . " ORDER BY `order`"
                    );
            $this->m->data = $this->m->_db->loadObjectList();
        }
        
        public function showAction(){
            //получаем уроки для уровня
            $this->m->_db->setQuery(
                        "SELECT * "
                        . " FROM `lessons` "
                        . " WHERE `lessons`.`level` = ".$this->m->_path[2]
                    );
            $this->m->data = $this->m->_db->loadObjectList();            
        }
    }
?>