<?php
    class indexController extends Model {
        public function init() {
            //if($this->m->isLogin()) redirect('/trade/');
        }

        public function indexAction(){
            $this->m->setTitle("Concert UA");
            $this->m->addCSS('jquery.fancybox.min')->addCSS("jquery.fancybox-buttons.min")->addCSS("main.min")->addCSS('fonts.min')->addCSS("jquery.selectbox.min");
            $this->m->addCSS("jquery.autocomplete.min")->addCSS('modal.min')->addCSS("jquery.formstyler.min")->addCSS("jquery.jscrollpane")->addCSS("owl.carousel")->addCSS("owl.transitions")->addCSS("megabanner");
            
            $this->m->addJS("jquery-1.7.2")->addJS("plugins.min")->addJS("jquery-ui")->addJS("search.min")->addJS("concert.modal.min")->addJS("details_slider.min")->addJS("phone-panel.min");
            $this->m->addJS("concert.common.min")->addJS("user.min")->addJS("modernizr-2.6.2-respond-1.1.0.min")->addJS("jquery.jscrollpane")->addJS("jquery.fancybox")->addJS("jquery.fancybox-buttons");
            $this->m->addJS("jquery.mousewheel-3.0.6.pack")->addJS("jquery.formstyler")->addJS("jquery.selectbox.min")->addJS("checkboxes.min")->addJS("main.min")->addJS("rubricfilters")->addJS("owl.carousel.min")->addJS("megabanner");
        }
    }
?>