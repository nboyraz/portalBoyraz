<?php
class Main extends Model{
    public function getTestData(){
        $sql = "select * from `test` limit 1";
        $result = $this->db->query($sql);
        return $result[0]['column1'];
    }
}
?>