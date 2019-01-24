<?php
    require "../inc/lib.inc.php";
    require "../inc/config.inc.php";

    $bookObj = new Book($link);
    $genreObj = new Genre($link);
    $authorObj = new Author($link);

    $bookId = clearInt($_GET['bookId']);
    $book = $bookObj->getBookById($bookId);
    $genres = $genreObj->getGenreByBookId($bookId);
    $authors = $authorObj->getAuthorByBookId($bookId);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book - <?=$book['title']?></title>
    <link rel="stylesheet" href="../styles/main.css">
</head>    
<body>
    <div class="main-container">
      <header>
            <nav>
                <div class="main-menu">
                    <ol class="menu">
                        <li class="menu-item"><a href="../admin/index.php">Admin</a></li>
                        <li class="menu-item"><a href="../index.php">Home</a></li>
                    </ol>
                </div>
            </nav>
       </header>        
       <div class="book-information">
            <h2 class="title_book"><?=$book['title']?></h2>
            <p class="title_descr"><?=$book['description']?></p>
            <h3 class="genre">Жанр : <?=$genres?></h3>
            <h3 class="genre">Автор : <?=$authors?></h3>
            <span>Цена : <?=$book['price']?> .UAH</span>
        </div>

        <div id="order">
            <form action="../inc/sendMail.php" method="post">
                <fieldset class="edit-book">
                    <label>
                        Имя Фамилия
                        <input type="text" placeholder="Имя Фамилия" name="customer">
                    </label>
                    <label>
                      Адрес доставки
                        <input type="text" placeholder="Адрес доставки" name="adress">
                    </label>
                    </fieldset>
                 <input type="hidden" value="<?=$book['id']?>" name="book_id">
                 <input type="hidden" value="<?=$book['title']?>" name="book_title">
                 <input type="hidden" value="<?=$book['price']?>" name="book_price">
                 <input class="btn btn-default" type="submit" name="Send" value="Send order">
	        </form>
        </div>
    </div>    
</body>
</html>    