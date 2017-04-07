<?php
class MainsController extends Controller{
    public function __construct($data= array()){
        parent::__construct($data);
        $this->model = new Main();
    }

    public function index(){
        $this->data['testdata'] = $this->model->getTestData();
    }
}
?>