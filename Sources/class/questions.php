<?php
class Questions{
    protected $_table = 'questions';
    
    public function __construct(mainframe & $mainframe){
        $this->m =  $mainframe;
    }
    
    public function getElements($lesson){
        
        //получаем елементы для уровня
        $this->m->_db->setQuery(
                    "SELECT `questions`.* "
                    . " FROM `questions` "
                    . " WHERE `questions`.`lesson_id` = ".$lesson
                    . " AND `questions`.`status` = 1"

                );
        $data = $this->m->_db->loadObjectList();    
        return $data;
    }
       
}
?>
