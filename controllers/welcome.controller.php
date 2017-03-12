<?php
class WelcomeController extends Controller{
    public function __construct($data= array()){
        parent::__construct($data);
        $this->model = new Greeting();
    }

    public function index(){
        
    }
}
?>