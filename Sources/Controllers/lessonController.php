<?php
    class lessonController extends Model {
        public function init() {            
        }

        public function indexAction(){
            $this->m->setTitle("Level1");

            $this->m->addJS("phaser.min");            
        }
        
        public function showAction(){
            //получаем уроки для уровня            
        }
    }
?>