<?php
require_once(ROOT.DS."entity".DS."FolderItem.php");
require_once(ROOT.DS."entity".DS."PhotoItem.php");

class Photo extends Model{
    public function GetPhotoFolderList(){
        $res = [];
        $select = "select * from `photo_folders` order by LAST_UPDATE_DATE desc";
        $result = $this->db->query($select);
        if(count($result)>0){
            for($i=0;$i<count($result);$i++){
                $fi = new FolderItem();
                $fi->FolderName = $result[$i]['FOLDER_NAME'];
                $fi->FolderOwner = $result[$i]['FOLDER_OWNER'];
                $fi->FolderCreators = $result[$i]['FOLDER_CREATORS'];
                $fi->CreatedDate = $result[$i]['CREATED_DATE'];
                $fi->LastUpdateDate = $result[$i]['LAST_UPDATE_DATE'];
                $fi->FolderId = $result[$i]['FOLDER_ID'];
                $res[] = $fi;
            }
        }
        return $res;
    }

    public function GetPhotoList($folderId){
        $res = [];
        $select = "select * from `photos` where FOLDER_ID = '".$folderId."' order by CREATE_DATE desc";
        $result = $this->db->query($select);
        if(count($result)>0){
            for($i=0;$i<count($result);$i++){
                $pi = new PhotoItem();
                $pi->FolderId = $result[$i]['FOLDER_ID'];
                $pi->Link = $result[$i]['LINK'];
                $pi->PreviewLink = $result[$i]['PREVIEW_LINK'];
                $pi->Description = $result[$i]['DESCRIPTION'];
                $pi->CreateDate = $result[$i]['CREATE_DATE'];
                $res[] = $pi;
            }
        }
        return $res;
    }
}
?>