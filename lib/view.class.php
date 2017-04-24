<?php
    class View{
        protected  $data;
        protected  $path;
        protected  $viewMode;
        protected  $isContainer;

        protected static function getDefaultViewPath(){
            $router = App::getRouter();
            if(!$router){
                return false;
            }
            $controller_dir = $router->getController();
            $template_name = $router->getMethodPrefix().$router->getAction().'.html';
            return VIEWS_PATH.DS.$controller_dir.DS.$template_name;
        }

        public  function __construct($data = array(), $path = null, $viewMode = "standart", $isContainer = false){
            if(!$path){
                $path = self::getDefaultViewPath();
            }
            if(!file_exists($path)){
                throw new Exception('Template file is not found in path: '.$path);
            }
            $this->path = $path;
            $this->data = $data;
            $this->viewMode = $viewMode;
            $this->isContainer = $isContainer;
            $this->getContainerData();
        }

        public function getContainerData(){
            if($this->isContainer){
                $controllerTmp = new WebpartsController(null,$this->viewMode);
                $containerData = $controllerTmp->getContainerData();                                
                $this->data = array_merge($this->data,$containerData);
            }
        }

        public  function render(){
            $data = $this->data;
            $viewMode = $this->viewMode;
            ob_start();
            include($this->path);
            $content = ob_get_clean();
            return $content;
        }
    }
?>

