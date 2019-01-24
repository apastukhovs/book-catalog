<?php
require "../inc/lib.inc.php";
require "../inc/config.inc.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookObj = new Book($link);
    $genreObj = new Genre($link);
    $authorObj = new Author($link);

    $bookId = clearInt($_POST['book_id']);  
    $title = clearStr($_POST['title']);
    $price = clearInt($_POST['price']);
    $description = clearStr($_POST['description']);

    $upd = $bookObj->updateByBookId($bookId, $title, $description, $price);
    $deleteAuthor = $authorObj->deleteAuthorFromBook($bookId);
    $deleteGenre = $genreObj->deleteGenreFromBook($bookId);

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