<?php
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'BookCatalog');

$link = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);

if($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}
