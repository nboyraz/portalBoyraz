<?php
    require_once(ROOT.DS."entity".DS."PageMenuItem.php");

    class Webpart extends Model{
        public function getLeftMenu(){
            $leftSideMenu = array();
            $select = "select * from `page_menus` where MENU_TYPE = 'LEFT_NAVBAR' order by MENU_ORDER desc limit 5";
            $result = $this->db->query($select);
            if(count($result)>0){
                for($i=0;$i<count($result);$i++){
                    $pmi = new PageMenuItem();
                    $pmi->MenuType = $result[$i]["MENU_TYPE"];
                    $pmi->MenuOrder = $result[$i]["MENU_ORDER"];
                    $pmi->MenuContent = $result[$i]["MENU_CONTENT"];
                    $pmi->MenuLink = $result[$i]["MENU_LINK"];
                    $leftSideMenu[] = $pmi;
                }
            }
            return $leftSideMenu;
        }

        public function getRigthMenu(){
            $rightSideMenu = array();
            $select = "select * from `page_menus` where MENU_TYPE = 'RIGHT_NAVBAR' order by MENU_ORDER desc limit 5";
            $result = $this->db->query($select);
            if(count($result)>0){
                for($i=0;$i<count($result);$i++){
                    $pmi = new PageMenuItem();
                    $pmi->MenuType = $result[$i]["MENU_TYPE"];
                    $pmi->MenuOrder = $result[$i]["MENU_ORDER"];
                    $pmi->MenuContent = $result[$i]["MENU_CONTENT"];
                    $pmi->MenuLink = $result[$i]["MENU_LINK"];
                    $rightSideMenu[] = $pmi;
                }
            }
            return $rightSideMenu;
        }
    }
?>