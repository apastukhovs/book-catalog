<?php
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'BookCatalog');


class DB {
    protected $link;
    protected $db;
    public function __construct($connect) {
        $this->link = $connect;    
        if(is_a($this->link, PDO)) {
            $this->db = 'pdo';
                    } 
        else if (is_a($this->link, mysqli)) {
            $this->db = 'mysqli';
            }      
    }

    public function select ($query) {
        switch($this->db) {
            case 'pdo' :
                $result = $this->link->query($query);
                return $result->fetchAll(PDO::FETCH_ASSOC);  

            case 'mysqli' :
                $result  = $this->link->query($query);
                return $this->getData($result);
        }
    }

    private function getData($resource) {
        $arr = array();
            while($val = $resource->fetch_assoc()) {
            $arr[] = $val;
        }
        return $arr;
    }
    
    public function insert($sql, $data) {
        switch($this->db) {
            case 'pdo' :
                $result = $this->link->prepare($sql); 
                $result->execute($data);
                return $this->link->lastInsertId();
            case 'mysqli' :
                foreach ($data as $key => $value) {
                    $sql = str_replace($key, "'$value'", $sql);
                }
                $this->link->query($sql);
                return $this->link->insert_id;
        }
    }

    public function query($sql, $data) {
        switch($this->db) {
            case 'pdo' :
                $result = $this->link->prepare($sql); 
                $result->execute($data);
                return $this->link;
            case 'mysqli' :           
                foreach ($data as $key => $value) {
                    $sql = str_replace($key, "'$value'", $sql);
                }
                $this->link->query($sql);
                return $this->link;
        }
    }    
}
   


$mysqli = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
$dsn = "mysql:host=localhost;port=3306;dbname=".DB_NAME.";charset=utf8";
$pdo = new PDO($dsn, DB_LOGIN, DB_PASSWORD);
$link = new DB ($mysqli);