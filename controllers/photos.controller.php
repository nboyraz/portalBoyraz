<?php
class PhotosController extends Controller{
    public function __construct($data= array()){
        parent::__construct($data);
        $this->model = new Photo();
    }

    public function index(){
        $this->data['folder_list'] = $this->model->GetPhotoFolderList();
    }

    public function folder(){
        $PageParams = App::getRouter()->getParams();
        $folderId = "";
        if(isset($PageParams) && count($PageParams) > 0){
            $folderId = $PageParams[0];
        }
        $this->data['photo_list'] = $this->model->GetPhotoList($folderId);
    }
}
?>