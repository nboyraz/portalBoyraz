<?php
require_once(ROOT.DS."entity".DS."FtreeItem.php");

class Ftree extends Model{    
    private function GetChildren($parent_id){
        $res = [];
        $select = "SELECT ft.*,p.NAME,p.SURNAME FROM `family_tree` ft,`person` p where ft.PERSON_ID=p.ID and (ft.FATHER=".$parent_id." or ft.MOTHER=".$parent_id.")";
        $result = $this->db->query($select);
        if(count($result)>0){
            for($i=0;$i<count($result);$i++){
                $child = new FtreeItem();
                $child->name = $result[$i]['NAME'].' '.$result[$i]['SURNAME'];
                $child->children = $this->GetChildren($result[$i]['PERSON_ID']);
                $res[]=$child;
            }
            return $res;
        }
        return null;
    }

    public function GetFtreeByRoot(){  
        $root = new FtreeItem();          
        $root->name = 'Kok';
        try{
            $select_root = "SELECT ft.*,p.NAME,p.SURNAME FROM `family_tree` ft,`person` p where ft.IS_ROOT='Y' and ft.PERSON_ID=p.ID limit 1";
            $result = $this->db->query($select_root);
            $root->name = $result[0]['NAME'].' '.$result[0]['SURNAME'];
            $root->children = $this->GetChildren($result[0]['PERSON_ID']);
            return $root;
        }
        catch(Exception $e){
            return $root;
        }                
    }   
}
?>