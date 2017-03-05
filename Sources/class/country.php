<?php
class Country extends DBTable{
    protected $_table = 'country';
    
    public function __construct(mainframe & $mainframe){
        $this->m =  $mainframe;
        $this->DBTable('users', 'id', $this->m->_db);
    }
    
    public function get(){
        $lang = $this->m->_lang == 'ru' ? 'ru' : 'en';

        $this->m->_db->setQuery(
                "SELECT `".$this->_table."`.`name_".$lang."` as name"
                . " ,`".$this->_table."`.`id` "
                . " ,`".$this->_table."`.`prefix` "
                . " FROM `".$this->_table."` "
                . " WHERE `".$this->_table."`.`id` NOT IN (37) "
                . " ORDER BY name"
            );
        
        $this->data = $this->m->_db->loadObjectList();
        //p($this->data);
    }
       
}
?>
