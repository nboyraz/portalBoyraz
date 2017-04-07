<?php
    class App{
        protected static $router;
        public static $db;

        public static function getRouter(){
            return self::$router;
        }

        public static function run($uri){
            self::$router = new Router($uri);
	    try{
            	self::$db = DB::getInstance();//test icin commentlendi tekrar acilacak
	    }
	    catch(Exception $e){
	        echo "<p/><p/><p/>";
	        print_r($e);
	    }
            Lang::load(self::$router->getLanguage());

            $controller_class = ucfirst(self::$router->getController()).'Controller';
            $controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction());

            //calling controller
            $controller_object = new $controller_class();
            if(method_exists($controller_object, $controller_method)){
                //controller action may return a view path
                $view_path = $controller_object->$controller_method();
                $view_object = new View($controller_object->getData(), $view_path);
                $content = $view_object->render();
            }else{
                throw new Exception('Method '.$controller_method.' of class '.$controller_class.' does not exists');
            }

            $layout = self::$router->getRoute();
            $layout_path = VIEWS_PATH.DS.$layout.'.html';
            $layout_view_object = new View(compact('content'),$layout_path);
            echo $layout_view_object->render();
        }

        public static function routeAjaxCall($uri){
            self::$router = new Router($uri);
            //self::$db = DB::getInstance();//test icin commentlendi tekrar acilacak
            Lang::load(self::$router->getLanguage());

            $controller_class = ucfirst(self::$router->getController()).'Controller';
            $controller_method = strtolower(self::$router->getMethodPrefix().self::$router->getAction()); 

            //calling controller
            $controller_object = new $controller_class();
            if(method_exists($controller_object, $controller_method)){
                $resValue = $controller_object->$controller_method();
                if($resValue){
                    return $resValue;
                }
            }
        }
    }
?>