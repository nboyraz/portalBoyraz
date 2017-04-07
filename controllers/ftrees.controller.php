<?php
class FtreesController extends Controller{
    public function __construct($data= array()){
        parent::__construct($data);
        $this->model = new Ftree();
    }

    public function index(){

    }

    public function GetFtreeByRoot(){
        $res = $this->model->GetFtreeByRoot();
        return $res;
    }
}
?>