<?php
class Answers{
    protected $_table = 'answers';
    
    public function __construct(mainframe & $mainframe){
        $this->m =  $mainframe;
    }
    
    public function checkActiveAnswers($lesson,$session){
        //проверим или нету неотвеченных вопрсов
        $this->m->_db->setQuery(
                    "SELECT * "
                    . " , `questions`.`element`"
                    . " FROM `answers` "
                    . " LEFT JOIN `questions` ON `questions`.`id` = `answers`.`item`"
                    . " WHERE `answers`.`lesson_id` = ".$lesson
                    . " AND `answers`.`session` = '".$session."'"
                    . " AND `answers`.`user_id` = ".$this->m->_user->id
                    . " AND `answers`.`status` = 0"
                    . " LIMIT 1"
                );
        $this->m->_db->loadObject($answer);
        return $answer;
    }
       
}
?>
