<?php
class Message extends Model{
    public function save($data, $id = null){
        if(!isset($data['name']) || !isset($data['email']) || !isset($data['message'])){
            return false;
        }

        $client_ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : "";

        $id = (int)$id;
        $name = $this->db->escape($data['name']);
        $email = $this->db->escape($data['email']);
        $message = $this->db->escape($data['message']);

        if(!$id){
            $sql = "insert into messages 
                    set NAME='{$name}', EMAIL='{$email}', MESSAGE='{$message}', IP='{$client_ip}'";
        }
        else{
            $sql = "update messages
                    set NAME='{$name}', EMAIL='{$email}', MESSAGE='{$message}' 
                    where ID={$id}";
        }
        return $this->db->query($sql);
    }
}
?>