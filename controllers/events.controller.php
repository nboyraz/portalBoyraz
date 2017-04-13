<?php
class EventsController extends Controller{
    public function __construct($data= array()){
        parent::__construct($data);
        $this->model = new Event();
    }

    public function index(){
        $PageParams = App::getRouter()->getParams();
        $pageNum = 1;
        if(isset($PageParams) && count($PageParams) > 0){
            $pageNum = $PageParams[0];
        }
        $pageSize = Config::get('event_page_size');
        $this->data['last_events'] = $this->model->GetLatestEvents($pageNum,$pageSize);
        $this->data['pageNumber'] = $pageNum;
    }

    public function content(){
        
    }
}
?>