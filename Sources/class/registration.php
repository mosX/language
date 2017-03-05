<?php
class Registration{
    protected $_table = 'users';
 
    public function __construct(mainframe & $mainframe){
        $this->m =  $mainframe;
    }
            
    /*public function changePassword($redirect='/account/personal/?act=success'){
        $this->passwordValidation();
        
        if (!$this->validation) {
            $this->error->message = _("Incorrectly filled fields!") ;
            return;
        }
        
        $newPassword = $_POST["newpassword"];

        $salt = makePassword(16);
        $crypt = md5(md5($newPassword).$salt);

        $row->password = $crypt . ':' . $salt;
        $row->id = $this->m->_user->id;

        if ($this->m->_db->updateObject('users',$row,'id')) {
            $this->m->add_to_history($this->m->_user->id, "account", "changedpassword");
            unset($_POST);
            $_POST['_password'] = array( 'ok' => true, 'message' => _("Password changed!"));
            redirect($redirect);
        } else {
            $_POST['_password'] = array( 'ok' => false, 'message' => _("An unexpected error occurred. Please try again later.") );
        }
        
    }*/
    
    private function passwordValidation($length=50){
        $this->validation = true;
        
        $password = $_POST['password'];
        $this->checkPasswordValidation($password);
        $newpassword = $_POST["newpassword"];
        $confirm = $_POST["confirm"];

        //check Password
        if(empty($newpassword)){
            $this->validation = false;
            $this->error->newpassword = _("You need to enter your new password!");
        }else if(strlen($newpassword) > 50){
            $this->validation = false;
            $this->error->newpassword = sprintf(_("Your new password has to be less then %s symbols!"),$length);;
        }

        //check Confirmation
        if(empty($confirm)){
            $this->validation = false;
            $this->error->confirm = _("Confirm entered password!");
        }else if($newpassword != $newpassword){
            $this->validation = false;
            $this->error->confirm = _("Passwords do not match!");
        }
    }
    
     //Валидация Даты Рождения
    private function checkBirthday($_day,$_month,$_year){
        $birthday = (empty($_year) ? '0000' : $_year) . "-" . (empty($_month) ? '00' : $_month) . "-" . (empty($_day) ? '00' : $_day);
        
        if(empty($_day) || empty($_month) || empty($_year)){
            $this->validation = false;
            $this->error->birthday = _("Incorect Birthday");

            return;
        }else if (empty($birthday) || strlen($birthday) > 10 || !checkdate($_month, $_day, $_year) || (date("Y") - $_year) <= 16) {
            $this->validation = false;
            $this->error->birthday = _("You can register only if you are 18 years old!");

            return;
        }
        $birthday = date('Y-m-d H:i:s',strtotime($birthday));
        
        return $birthday;
    }
    
    public function changePersonalInfo(){
        $this->validation = true;
        
        $row = new stdClass;
        $row->country = $this->checkCountry($_POST['country']);
        
        $email = $this->checkPersonalInfoEmail($_POST['email']);
        if($email) $row->email = $email;
        
        $row->phone = $this->checkPhoneRegistration($_POST['phone'],$_POST['country']);
                
        $this->checkPasswordValidation($_POST['password']);
        
        $row->last_modified = date('Y-m-d H:i:s');
        $row->id = $this->m->_user->id;
        
        if ($this->validation === false ) {
            $this->error->main = _("incorrectly filled");
            return $this->error;
        }

        makeHtmlSafe($row);
        if($this->m->_db->updateObject('users',$row,'id')){
            $to_hist["old"]["email"] = $row->email;
            $to_hist["new"]["email"] = $this->m->_user->email;
            
            $to_hist["old"]["firstname"] = $row->firstname;
            $to_hist["new"]["firstname"] = $this->m->_user->firstname;
            
            $to_hist["old"]["lastname"] = $row->country;
            $to_hist["new"]["lastname"] = $this->m->_user->country;
            
            $to_hist["old"]["country"] = $row->country;
            $to_hist["new"]["country"] = $this->m->_user->country;
            
            $to_hist["old"]["phone_prefix"] = $row->phone_prefix;
            $to_hist["new"]["phone_prefix"] = $this->m->_user->phone_prefix;
            
            $to_hist["old"]["phone_area"] = $row->phone_area;
            $to_hist["new"]["phone_area"] = $this->m->_user->phone_area;
            
            $to_hist["old"]["phone_phone"] = $row->phone;
            $to_hist["new"]["phone_phone"] = $this->m->_user->phone;
        
            $this->m->add_to_history($this->m->_user->id, "account", "changepersonalinfo",serialize($to_hist));
            
            redirect('/account/personal/');
        }
    }
    
    public function checkPasswordValidation($password){
        $this->m->_db->setQuery(
                    "SELECT `users`.`password` "
                    . " FROM `users` "
                    . " WHERE `users`.`id` = ". $this->m->_user->id." LIMIT 1" 
                );

        list($hash, $salt) = explode(':', $this->m->_db->loadResult());
        
        $cryptpass = md5(md5($password).$salt);

        if ($hash != $cryptpass) {
            $this->validation = false;
            $this->error->password = _("Wrong Password");
            return $this->error;
        }
    }
    
    private function checkTimezone($timezone){
        $timezone = (float)$timezone;
        
        if($timezone < -12 || $timezone > 14){
            $timezone = 0;
        }
        
        return $timezone;
    }
    
    public function registration(){
        if($_SERVER['REQUEST_METHOD'] !='POST') return;
        
        $this->validation = true;
                
        $row = new stdClass;
        
        $row->firstname = $this->checkFirstname($_POST['firstname']);
        $row->lastname = $this->checkLastname($_POST['lastname']);
        //$row->birthday = $this->checkBirthday($_POST['day'],$_POST['month'],$_POST['year']);
        
        $row->email = $this->checkEmail($_POST['email']);
        
        $row->password = $this->checkPassword($_POST['password']);
        
        $this->checkConfPassword($_POST['password'],$_POST['conf_password']);
        
        $row->date = date('Y-m-d H:i:s');
        
        if ($this->validation === false) {
            $this->error->main = _("Wrong filled fields");
            return $this->error;
        }

        makeHtmlSafe($row);
                        
        if (!$this->m->_db->insertObject($this->_table, $row, 'id')) {

            return false;
        }
                
        $_POST["email"] = $row->email;
        $_POST["password"] = $this->pswrd;
        
        $this->m->_auth->login('/');
    }

    public function activateFriendPromo($promo) {
        $promo = strip_tags(trim($promo));
        if(!$promo) return false;
        
        $this->m->_db->setQuery(
                    "SELECT `users`.`id` "
                    . " FROM `users`"
                    . " WHERE `users`.`email` = '".$promo."'"
                    . " LIMIT 1"
                );
        $id = $this->m->_db->loadResult();
        
        if(!$id) return false;
        
        return $id;
    }    

    public function addFriendPromoDeposit($user_id, $account_id, $amount){
        $deposit->user_id = $user_id;
        $deposit->account_id = $account_id;
        $deposit->amount = $amount;
        $deposit->start_balance = 0;
        $deposit->end_balance = $amount;
        $deposit->paysystem_id = 'FRIEND';
        $deposit->date = date('Y-m-d H:i:s');
        $deposit->status = 1;
        $this->m->_db->insertObject('deposits',$deposit);
        
    }

    private function checkAffiliate() {
        $this->partner = 0;
        $this->afftrack = 0;

        list($partner_id, $afftrack) = explode(' ', $_COOKIE['aff']);

        $partner_id = (int)$partner_id;
        if ($partner_id) {
            $this->m->_db->setQuery(
                "SELECT `id` "
                . " FROM `partners`"
                . " WHERE `id` = " . $partner_id
                . " LIMIT 1"
                );

            if ((int)$this->m->_db->loadResult()) {
                $this->partner = $partner_id;
            }
        }

        $afftrack = (int)$afftrack;
        if ($afftrack) {
            $this->m->_db->setQuery(
                "SELECT `id` "
                . " FROM `afftracks`"
                . " WHERE `id` = " . $afftrack
                . " AND `partner_id` = " . $this->partner
                . " LIMIT 1"
                );
            if ((int)$this->_db->loadResult()) {
                $this->afftrack = $afftrack;
            }
        }
    }
    
    private function checkCampaignCode($campaing_code){
      $campaign_code = trim($campaing_code);

        if ($campaign_code != "") {
            
            if (!preg_match('/^[a-zA-Z0-9@_*-]{3,10}$/', $campaign_code)) {
                $this->error["campaign_code"] = _("This username is not found in our system");
                $this->validation = false;
            } else {
                
                $this->m->_db->setQuery(
                        " SELECT `id` "
                        . " FROM `partners` "
                        . " WHERE `username` = " . $this->m->_db->Quote($campaign_code)
                        . " LIMIT 1;"
                    );
                $partner_id = intval($this->m->_db->loadResult());
                
                if (0 == $partner_id) {
                    $this->error["campaign_code"] = _("This username is not found in our system");
                    $this->validation = false;
                } else {
                    return $partner_id;
                }
            }
        }
        //"campaign_code_incorrect" => "Данное имя пользователя отсутствует в нашей системе!"
    }

    private function checkTAC($tac){
        if(!isset($tac)){
            $this->validation = false;
            $this->error->tac = _("Read the terms and conditions");
            return $this->error;
        }
    }
    
    /*private function checkCurrency($currency){
        
    }*/
    
    private function checkCountry($country){
        $country = (int)$country;
        if(!$country){
            $this->validation = false;
            $this->error->country = _("You must choose a country");
            return ;
        }
        
        return $country;
    }
    
    private function checkConfPassword($password,$password2){
        $password = trim($password);
        if($password != $password2 || strlen($password2) == 0){
            $this->error->password2 = _("Passwords do not match");
            $this->validation = false;
            return false;
        }
    }
    private function checkPassword($password){
        $password = trim($password);
        
        if (empty($password) || strlen($password) < 4 || strlen($password) > 40) {
            $this->error->password = _("You have used incorrect symbols, or incorrect length");
            $this->validation = false;
            return false;
        }else if(!preg_match('/^([a-z0-9])+$/i',$password)){
            $this->error->password = _("You have used incorrect symbols, or incorrect length");
            $this->validation = false;
            return false;
        }
        $this->pswrd = $password;
        $salt   = makePassword(16);
        $crypt  = md5(md5($password) . $salt);
        $password  = $crypt . ':' . $salt;

        return $password;
    }
    
    public function checkPersonalInfoEmail($email){
        $demo = $this->m->_user->demo;
        $email = strtolower(trim($email));
        
        if (empty($email) || !is_email($email) || strlen($email) > 140 ) {
            $this->error->email = _("You did not enter the e-mail, or incorrect length");
            $this->json = '{"status":"error","message":_("You did not enter the e-mail, or incorrect length")}';
            $this->validation = false;
            return false;
        }else {
            $this->m->_db->setQuery( "SELECT `id`"
                        . " FROM `users` "
                        . " WHERE `users`.`email` = '".$email."'"  
                        //. " AND `users`.`demo` = ".(int)$demo
                        . " LIMIT 1;"
                    );
            $result = $this->m->_db->loadObjectList();  
            
            
            if(!empty($result)){
                if($result[0]->id == $this->m->_user->id){
                    return false;
                }else if($demo){
                    $this->error->email = _("This user is already registred in demo mode");   
                }else{
                    $this->error->email = _("This user is already registred");
                }
                
                $this->json = '{"status":"error","message":'._("This user is already registred").'}';
                $this->validation = false;
                return false;
            }
        }

        return $email;
    }
    
    
    public function checkEmail($email){
        $email = strtolower(trim($email));
        
        if (empty($email) || !is_email($email) || strlen($email) > 140 ) {
            $this->error->email = _("You did not enter e-mail, or incorrect length");
            $this->json = '{"status":"error","message":"'._("You did not enter e-mail, or incorrect length").'"}';
            $this->validation = false;
            return false;
        }else {
            $this->m->_db->setQuery( "SELECT `id`"
                        . " FROM `users` "
                        . " WHERE `users`.`email` = '".$email."'"  
                        //. " AND `users`.`demo` = ".(int)$demo
                        . " LIMIT 1;"
                    );
            $result = $this->m->_db->loadObjectList();  
            
            if(!empty($result)){
                if($demo){
                    $this->error->email = _("This e-mail is already registred in demo account");   
                }else{
                    $this->error->email = _("This e-mail is already registred");
                }
                
                $this->json = '{"status":"error","message":"'._("This e-mail is already registred").'"}';
                $this->validation = false;
                return false;
            }
        }
        $this->json = '{"status":"success"}';

        return $email;
    }
    
    private function checkLastname($lastname){
        $lastname = strip_tags(trim($lastname));
        
        if(!$lastname || strlen($lastname) > 40 || strlen($lastname) < 4){
            $this->error->lastname = _("You did not enter the name, or incorrect length");
            $this->validation = false;
            return false;
        }
        return $lastname;
    }
    private function checkFirstname($name){
        $name = strip_tags(trim($name));
        
        if(!$name || strlen($name) > 40 || strlen($name) < 2){
            $this->error->firstname = _("You did not enter the name, or incorrect length");
            $this->validation = false;
            return false;
        }
        return $name;
    }
      
    public function checkAjaxPhone($phone,$country){
        $phone = preg_replace("/(\D+)/",'',$phone);
        
        switch($country){
            case 112:
                $search_phone = substr($phone,-9);
                $preg = preg_match("/^[^0]{1}\d{8}$/",$phone);
                break;
            case 20:
                $search_phone = substr($phone,-10);
                $preg = preg_match("/^9\d{9}$/",$phone);
                break;
            default:
                $search_phone = $phone;
                $preg = preg_match("/^(\d+)$/",$phone);
        }
        
        //if(!$phone){
        if(!$preg){
            $this->json = '{"status":"error","message":"'._("You did not enter phone, or incorrect length").'"}';
            $this->validation = false;
            
            return false;
        }
        
        //проверяем или такой телефон уже был добавлен
        $this->m->_db->setQuery(
                    "SELECT `users`.`phone` FROM `users` WHERE `users`.`phone` LIKE " . $this->m->_db->Quote("%" . $search_phone)
                    . " AND `users`.`country` = ".(int)$country
                    . " LIMIT 1"
                );
        $res = $this->m->_db->loadObjectList();
        
        if($res){
            $this->json = '{"status":"error","message":"'._("This phone has already been added previously.").'"}';
            $this->validation = false;
            
            return false;
        }
        $this->json = '{"status":"success"}';        
    }
    
    private function checkPhoneRegistration($phone,$country){
        $phone = preg_replace("/(\D+)/",'',$phone);
        
        switch($country){
            case 112:
                $search_phone = substr($phone,-9);
                $preg = preg_match("/^[^0]{1}\d{8}$/",$phone);
                break;
            case 20:
                $search_phone = substr($phone,-10);
                $preg = preg_match("/^9\d{9}$/",$phone);
                break;
            default:
                $search_phone = $phone;
                $preg = preg_match("/^(\d+)$/",$phone);
        }
        
        if(!$preg){
            $this->error->phone = _("You did not enter a phone number");
            $this->validation = false;
            return false;
        }else if(strlen($phone) < 8 || strlen($phone) > 14 ){
            $this->error->phone = _("You have entered incorrect phone number length");
            $this->validation = false;
            
            return false;
        }else if(!preg_match('/^[0-9]{8,14}$/',$phone)){
            $this->error->phone = _("You have entered incorrect phone number");
            $this->validation = false;
            
            return false;
        }
        
        //получаем код страны
        $this->m->_db->setQuery(
                    "SELECT `country`.`prefix` FROM `country` WHERE `country`.`id`= ".(int)$country
                    . " LIMIT 1" 
                );
        $country_code = $this->m->_db->loadResult();
        
        //проверяем или такой телефон уже был добавлен
        $this->m->_db->setQuery(
                    //"SELECT `users`.`phone` FROM `users` WHERE `users`.`phone` = '".($country_code.$phone)."'"
                    "SELECT `users`.`phone` FROM `users` WHERE `users`.`phone` LIKE " . $this->m->_db->Quote("%" . $search_phone)
                    . " AND `users`.`country` = ".(int)$country
                    . ($this->m->_user->id ? " AND `users`.`id` != " . $this->m->_user->id : "")
                    . " LIMIT 1"
                );
        $res = $this->m->_db->loadObjectList();
        if($res){
            $this->error->phone = _("This phone has already been added previously.");
            $this->validation = false;
            
            return false;
        }
        
        return $country_code.$phone;
    }
    
  
    
    private function checkPhone($phone){
        if(!$phone){
            $this->error->phone = _("You did not enter a phone number");
            $this->validation = false;
            
            return false;
        }else if(strlen($phone) >= 20 || strlen($phone) <= 4){
            $this->error->phone = _("You have entered incorrect phone number length");
            $this->validation = false;
            
            return false;
        }else if(!preg_match('/^([\+]{1})?[0-9]{1}([0-9 \-\(\)]){4,20}$/',$phone)){
            
            $this->error->phone = _("You have entered incorrect phone number");
            $this->validation = false;
            
            return false;
        }
        
        $phone = preg_replace("/(\D+)/",'',$phone);
        return $phone;
    }
    
    /*private function checkPhone($prefix,$area,$phone){
        $prefix = preg_replace("/(\D+)/",'',$prefix);
        $area = preg_replace("/(\D+)/",'',$area);
        $phone = preg_replace("/(\D+)/",'',$phone);
        
        
        return array('prefix'=>$prefix,'area'=>$area,'phone'=>$phone);
    }*/
}
?>
