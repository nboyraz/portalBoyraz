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
        $PageParams = App::getRouter()->getParams();
        $eventId = 0;
        if(isset($PageParams) && count($PageParams) > 0){
            $eventId = $PageParams[0];
        }
        $this->data['event_content'] = $this->model->GetEventContent($eventId);
    }
}
?>