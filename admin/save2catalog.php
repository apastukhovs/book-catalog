<?php
require "../inc/lib.inc.php";
require "../inc/config.inc.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookObj = new Book($link);
    $genreObj = new Genre($link);
    $authorObj = new Author($link);

    $title = clearStr($_POST["title"]);
    $price = clearInt($_POST["price"]);
    $description = clearStr($_POST["description"]);

    $bookId = $bookObj->addBook($title, $price, $description);

    $genres = explode(' ', $_POST["genre"]);
    foreach($genres as $genre) {
        $genreId = $genreObj->addGenre(clearStr($genre));
        
        if ($genreId > 0) {
            $genreObj->addGenreToBook($bookId, $genreId);
        }
    }

    $authors = explode (',', $_POST["author"]);
    foreach ($authors as $author) {
        $authorId = $authorObj->addAuthor(clearStr($author));
        
        if ($authorId > 0) {
            $authorObj->addAuthorToBook($bookId, $authorId );
        }
    }
}

header('Location: index.php');