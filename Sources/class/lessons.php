<?php
class Lessons{
    protected $_table = 'lessons';
    
    public function __construct(mainframe & $mainframe){
        $this->m =  $mainframe;
    }
    
    public function getLesson($lesson){
        $this->m->_db->setQuery(
                    "SELECT * FROM `lessons` WHERE `lessons`.`id` = ".$lesson
                    . " LIMIT 1"
                );
        $this->m->_db->loadObject($data);
        return $data;
        
    }
       
}
?>
