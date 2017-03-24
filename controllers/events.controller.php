<?php
class EventsController extends Controller{
    public function __construct($data= array()){
        parent::__construct($data);
        $this->model = new Event();
    }

    public function index(){
        
    }

    public function getAjaxDenemeResult(){
        $resArray = array();
        $resArray += array("key1"=>"val1");
        $resArray += array("key2"=>"val2");
        $resArray += array("key3"=>"val3");
        return $resArray;
    }
}
?>