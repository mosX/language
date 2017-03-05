<?php
class psm_resultController extends Model {
    public function init(){
        $this->disableTemplate();
        $this->disableView();
    }
    public function indexAction(){
        xload('class.psm_result');
            
        $this->em_result = new Psm_result($this->m);  
        $this->em_result->HandleResultRequest();
    }
}
?>