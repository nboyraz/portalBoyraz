<?php
class DB{
    protected $connection;
    private static $_instance; //The single instance

    public function __construct($host,$user,$password,$db_name){
        $this->connection = new mysqli($host,$user,$password,$db_name);
        if(mysqli_connect_error()){
            //trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(),E_USER_ERROR);
            echo mysqli_connect_error();
        }
    }

    public static function getInstance() {
            if(!self::$_instance) { // If no instance then make one
                self::$_instance = new self(Config::get('db.host'),
                                            Config::get('db.user'),
                                            Config::get('db.password'),
                                            Config::get('db.db_name'));
            }
            return self::$_instance;
        }

    private function __clone() { }

    private function logMysqlQueryErrors($error){
        //TO DO
    }

    public function getConnection() {
            return $this->connection;
    }

    public function query($sql){
        if(!$this->connection){
            return false;
        }
        $result = $this->connection->query($sql);
        if(mysqli_error($this->connection)){
            logMysqlQueryErrors(mysqli_error($this->connection));
        }
        if(is_bool($result)){
            return $result;
        }
        $data = array();
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        return $data;
    }

    public  function escape($str){
        return mysqli_escape_string($this->connection, $str);
    }
    /*
    //execute non queries
    public function executeNonQuery($query){
        $res = 0;
        $mysqli = $this->getConnection();
        $mysqli->query($query);
        $res = $mysqli->affected_rows;
        return $res;
    }

    //execute executeNonQuery
    public function executeQuery($query){
        $res = array();
        $mysqli = $this->getConnection();
        if($mysqli->multi_query($query)){
            do {
                $res[] = $mysqli->store_result();
            } while ($mysqli->more_results() && $mysqli->next_result());
        }
        return $res;
    }*/
}   
?>