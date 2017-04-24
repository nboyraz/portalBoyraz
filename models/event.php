<?php
require_once(ROOT.DS."entity".DS."EventItem.php");

class Event extends Model{
    public function GetLatestEvents($pagenum,$pageSize){
        $res = [];
        $select = "select * from 
        (select @rownum:=@rownum+1 'rank', p.* from `events` p, (SELECT @rownum:=0) r order by ID desc limit ".($pagenum*$pageSize+1).") as T 
        where rank between ".(($pagenum-1)*$pageSize+1)." and ".($pagenum*$pageSize+1);
        $result = $this->db->query($select);
        if(count($result)>0){
            for($i=0;$i<count($result);$i++){
                $ei = new EventItem();
                $ei->EventId = $result[$i]["ID"];
                $ei->EventType = $result[$i]["EVENT_TYPE"];
                $ei->CreatorUser = $result[$i]["CREATOR_USER"];
                $ei->PublisherInfo = $result[$i]["PUBLISHER_INFO"];
                $ei->PublishDate = $result[$i]["PUBLISH_DATE"];
                $ei->Content = $result[$i]["CONTENT"];
                $ei->FullContent = $result[$i]["FULL_CONTENT"];
                $res[] = $ei;
            }
        }
        return $res;
    }

    public function GetEventContent($eventId){
        $event = new EventItem();
        $select = "select * from `events` where ID = ".$eventId." limit 1";
        $result = $this->db->query($select);
        if(count($result)>0){
            $event->EventId = $result[0]["ID"];
            $event->EventType = $result[0]["EVENT_TYPE"];
            $event->CreatorUser = $result[0]["CREATOR_USER"];
            $event->PublisherInfo = $result[0]["PUBLISHER_INFO"];
            $event->PublishDate = $result[0]["PUBLISH_DATE"];
            $event->Content = $result[0]["CONTENT"];
            $event->FullContent = $result[0]["FULL_CONTENT"];
        }
        return $event;
    }
}
?>