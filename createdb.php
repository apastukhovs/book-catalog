<?
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'BookCatalog');

$link = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD);
if($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$sql = "CREATE DATABASE BookCatalog";
if ($link->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $link->error;
}

$link->close();

$link = new mysqli(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME);
if($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
}

$sqlBook = 'CREATE TABLE Book (
id int NOT NULL auto_increment,
title varchar(255) NOT NULL default "",
price int NOT NULL default 0,
description text,
PRIMARY KEY(id)
)';

if ($link->query($sqlBook) === TRUE) {
    echo "Table Book created successfully";
} else {
    echo "Error creating table: " . $link->error;
}

$sqlGenre = 'CREATE TABLE Genre (
id int NOT NULL auto_increment,
title varchar(50) NOT NULL default "",
PRIMARY KEY(id)
)';

if ($link->query($sqlGenre) === TRUE) {
    echo "Table Genre created successfully";
} else {
    echo "Error creating table: " . $link->error;
}

$sqlAuthor = 'CREATE TABLE Author (
id int NOT NULL auto_increment,
name varchar(255) NOT NULL default "",
PRIMARY KEY(id)
)';

if ($link->query($sqlAuthor) === TRUE) {
    echo "Table Author created successfully";
} else {
    echo "Error creating table: " . $link->error;
}

$sqlGenreBook = 'CREATE TABLE GenreBook (
genre_id int NOT NULL default 0,
book_id int NOT NULL default 0
)';

if ($link->query($sqlGenreBook) === TRUE) {
    echo "Table GenreBook created successfully";
} else {
    echo "Error creating table: " . $link->error;
}


$sqlAuthorBook = 'CREATE TABLE AuthorBook (
author_id int NOT NULL default 0,
book_id int NOT NULL default 0
)';

if ($link->query($sqlAuthorBook) === TRUE) {
    echo "Table AuthorBook created successfully";
} else {
    echo "Error creating table: " . $link->error;
}

$link->close();

?>