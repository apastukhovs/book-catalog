<?php
    require "../inc/lib.inc.php";
    require "../inc/config.inc.php";

    $bookObj = new Book($link);
    $books = $bookObj->getAllBooks();
?>
<!DOCTYPE HTML>
<html>
<head>  
	<title>Админка</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../styles/main.css">
</head>
<body>
    <div class="main-container">
        <header>
            <nav>
                <div class="main-menu">
                    <ol class="menu">
                        <li class="menu-item"><a href="index.php">Admin</a></li>
                        <li class="menu-item"><a href="../index.php">Home</a></li>
                    </ol>
                </div>
            </nav>
                <div class="header-title">
                    <h1>Book Catalog</h1>
                </div>
        </header>          
	     <p class="add"><a href='createBook.php'>Добавление книги</a></p>
	     
	     <ul class="edit"> <span>Для редактирование выберите книгу из списка :</span>
		    <?
                foreach($books as $book):
            ?>
		        <li ><a href='editBook.php?bookId=<?=$book['id']?>'><?=$book['title']?></a></li>
		    <?
                endforeach;
            ?>
	    </ul>
    </div>
</body>
</html>
