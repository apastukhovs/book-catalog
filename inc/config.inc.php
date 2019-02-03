<?php
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'BookCatalog');


class DB {
    protected $link;
    public function __construct($connect) {
        $this->link = $connect;            
    }

    public function select ($query) {
        $result  = $this->link->query($query);
        return $this->getData($result);
    }

    private function getData($resource) {
        $arr = array();
            while($val = $resource->fetch_assoc()) {
            $arr[] = $val;
        }
        return $arr;
    }
    
    public function query($sql) {
        $this->link->query($sql);
        return $this->link;
    }
}


$connect = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
$link = new DB ($connect);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);