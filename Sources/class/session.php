<?php
class Session{
    protected $_table = 'session';
    
    public function __construct(mainframe & $mainframe){
        $this->m =  $mainframe;
    }
    
    public function createNewSession(){
        $row->user_id = $this->m->_user->id;
        $row->lesson_id = $this->m->_path[2];
        $row->uuid = md5(time());
        $row->date = date("Y-m-d H:i:s");
        $row->status = 1;
        if($this->m->_db->insertObject('sessions',$row)){
            return $row->uuid;
            
        }
    }
    
    public function checkSession($lesson,$session){
        $this->m->_db->setQuery(
                    "SELECT COUNT(*) as cnt "
                    . " FROM `sessions` WHERE `sessions`.`lesson_id` = ".(int)$lesson
                    . " AND `sessions`.`user_id` = ".$this->m->_user->id
                    . " AND `sessions`.`uuid` = '".$session."'"
                    . " LIMIT 1"
                );
        $session = $this->m->_db->loadResult();
        
        return  $session ? true:false;
        
    }
       
}
?>
