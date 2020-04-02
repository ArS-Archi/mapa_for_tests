<?php
class Database{
    private $db_server = 'localhost'; 
    private $db_user   = 'root';
    private $db_pass   = '';
    private $db_name    = 'map';
    public  $db_connect;
    public function getConnection(){
        $this->db_connect = null;
        try {
            $this->db_connect = new PDO("mysql:host=" . $this->db_server . ";dbname=" . $this->db_name, $this->db_user, $this->db_pass);
            $this->db_connect->exec("set names utf8");
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->db_connect;
    }
}
?>
