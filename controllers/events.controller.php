<?php
class EventsController extends Controller{
    public function __construct($data= array()){
        parent::__construct($data);
        $this->model = new Event();
    }

    public function index(){
        
    }
}
?>