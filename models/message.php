<?php
class Message extends Model{
    public function save($data, $id = null){
        if(!isset($data['name']) || !isset($data['email']) || !isset($data['message'])){
            return false;
        }

        /*$id = (int)$id;
        $name = $this->db->escape($data['name']);
        $email = $this->db->escape($data['email']);
        $message = $this->db->escape($data['message']);

        if(!$id){
            $sql = "insert into messages 
                    set NAME='{$name}', EMAIL='{$email}', MESSAGE='{$message}'";
        }
        else{
            $sql = "update messages
                    set NAME='{$name}', EMAIL='{$email}', MESSAGE='{$message}' 
                    where ID={$id}";
        }
        return $this->db->query($sql);*/
        return true;//commentlendigi icin eklendi
    }
}
?>