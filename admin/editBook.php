<?
    require "../inc/lib.inc.php";
    require "../inc/config.inc.php";

    $bookObj = new Book($link);
    $genreObj = new Genre($link);
    $authorObj = new Author ($link);
    
    $bookId = clearInt($_GET['bookId']);
    $book = $bookObj->getBookById($bookId);
    $genres = $genreObj->getGenreByBookId($bookId);
    $authors = $authorObj->getAuthorByBookId($bookId);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../styles/main.css">
	<title>Форма редактирования данных о книге</title>
</head>
<body>
    <div class="main-container">
	    <form action="update2catalog.php" method="POST">
            <fieldset class="edit-book">
                <label>
                    Название книги
                    <input type="text" name="title" value="<?=$book['title']?>">
                </label>
                <label>
                Жанр
                    <input type="text" name="genre" value="<?=$genres?>">
                </label>
                <label>
                Автор
                    <input type="text" name="author" value="<?=$authors?>">
                </label>
                <label>
                Цена
                    <input type="text" name="price" value="<?=$book['price']?>"> 
                </label>
                <label>
                    Краткое описание
                    <textarea name="description"><?=$book['description']?></textarea>
                </label>
            </fieldset>
            <input type="hidden" name="book_id" value="<?=$bookId?>">
            <input class="btn btn-default" type="submit" name="UPDATE" value="UPDATE">
	    </form>
    </div>
</body>
</html>