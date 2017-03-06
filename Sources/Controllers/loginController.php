<?php
    class loginController extends Model {
        public function init(){
            $this->disableTemplate();
            $this->disableView();

            $this->m->_template = 'main';
        }

        public function indexAction(){
            if ($_SERVER['REQUEST_METHOD'] != 'POST') redirect('/?act=login');

            $_POST = json_decode(file_get_contents('php://input'), true);   //для Content-Type: application/json
            
            $this->m->_auth->ajaxLogin('/',$_POST['email'],$_POST['password']);
        }
    }
?>