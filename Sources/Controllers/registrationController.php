<?php
    class registrationController extends Model {
        public function init() {
            //if($this->m->isLogin()) redirect('/trade/');
        }

        public function indexAction(){
            $this->m->setTitle("Registration");
            $this->disableTemplate();
            $this->disableView();
            
            //$this->m->addCSS("bootstrap.min");
            //$this->m->addJS("bootstrap.min")->addJS("phaser.min");
            $this->m->addJS("phaser.min");
            
            $_POST = json_decode(file_get_contents('php://input'), true);   //для Content-Type: application/json
            
            xload('class.registration');
            $registration = new Registration($this->m);
            $registration->registration();
            if($registration->error){
                echo '{"status":"error","messages":'.json_encode($registration->error).'}';
            }else{
                echo '{"status":"success"}';
            }
        }
    }
?>