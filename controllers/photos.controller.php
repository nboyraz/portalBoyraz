<?php
class PhotosController extends Controller{
    public function __construct($data= array()){
        parent::__construct($data);
        $this->model = new Photo();
    }

    public function index(){
        
    }
}
?>