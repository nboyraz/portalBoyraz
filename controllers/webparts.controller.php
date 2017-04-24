<?php
    class WebpartsController extends Controller{
        protected $viewMode;

        public function __construct($data= array(), $viewMode = 'standart'){
            parent::__construct($data);
            $this->model = new WebPart();
            $this->viewMode = $viewMode;
        }

        public function getContainerData(){
            $containerData = array();
            if($this->viewMode == 'standart'){
                $containerData['leftMenu'] = $this->model->getLeftMenu();
                $containerData['rightMenu'] = $this->model->getRigthMenu();
            }
            return $containerData;
        }        
    }
?>