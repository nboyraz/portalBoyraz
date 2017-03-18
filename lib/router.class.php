<?php
    class Router{
        protected $uri;

        protected $controller;

        protected $action;

        protected $params;

        protected $route;
        protected $method_prefix;
        protected $language;
        protected $view_mode;

        public function getUri(){
            return $this->uri;
        }

        public function getController(){
            return $this->controller;
        }

        public function getAction(){
            return $this->action;
        }

        public function getParams(){
            return $this->params;
        }

        public function getRoute(){
            return $this->route;
        }

        public function getMethodPrefix(){
            return $this->method_prefix;
        }

        public function getLanguage(){
            return $this->language;
        }

        public function getViewMode(){
            return $this->view_mode;
        }

        public function GetUsableUri($uri){
            $pre_folder = Config::get('site_prefix_folder');
            $occurance=1;
            $res = str_replace($pre_folder,'',$uri,$occurance);
            $res = urldecode(trim($res,'/'));
            return $res;
        }

        public function __construct($uri){
            $this->uri = $this->GetUsableUri($uri);
            $routes = Config::get('routes');
            $this->route = Config::get('default_route');
            $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
            $this->language = Config::get('default_language');
            $this->controller = Config::get('default_controller');
            $this->action = Config::get('default_action');

            $uri_parts = explode('?',$this->uri);
            $path = $uri_parts[0];
            $path_parts = explode('/',$path);
            
            //echo "<pre>";print_r($path_parts);

            if(count($path_parts)){
                //get route or language in first element
                if(in_array(strtolower(current($path_parts)), array_keys($routes))){
                    $this->route = strtolower(current($path_parts));
                    $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
                    array_shift($path_parts);
                }
                elseif(in_array(strtolower(current($path_parts)), Config::get('languages'))){
                    $this->language = strtolower(current($path_parts));
                    array_shift($path_parts);
                }
                //get controller-next element
                if(current($path_parts)){
                    $this->controller = strtolower(current($path_parts));
                    array_shift($path_parts);
                }
                //get action
                if(current($path_parts)){
                    $this->action = strtolower(current($path_parts));
                    array_shift($path_parts);
                }

                //get getParams - all the rest
                $this->params = $path_parts;
            }
            //ek goruntuleme modlari uride ? sonraki kisim
            if(count($uri_parts) > 1){
                $modes = explode('&',$uri_parts[1]);
                for($i=0;$i<count($modes);$i++){
                    $values = explode('=',$modes[$i]);
                    if(count($values)>1 && $values[0] == 'vmod' && in_array($this->controller,Config::get('view_mode_pages'))){
                        $this->view_mode = $values[1];
                        break;
                    }
                }
            }
        }
    }
?>