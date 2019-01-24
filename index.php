<?php
    require "inc/lib.inc.php";
    require "inc/config.inc.php";

    $bookId = clearInt($_GET['bookId']);
    $genreId = clearInt($_GET['genre']);
    $authorId = clearInt($_GET['author']);

    $bookObj = new Book($link);
    $genreObj = new Genre($link);
    $authorObj = new Author($link);

    $books = $bookObj->getAllBooks($genreId, $authorId);
    $genres = $genreObj->getAllGenres();
    $authors = $authorObj->getAllAuthors();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Catalog</title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>
    <div class="main-container">
            <!--HEADER-->
              <header>
                       <nav>
                            <div class="main-menu">
                                <ol class="menu">
                                    <li class="menu-item"><a href="admin/index.php">Admin</a></li>
                                    <li class="menu-item"><a href="index.php">Home</a></li>
                                </ol>
                            </div>
                        </nav>
                        <div class="header-title">
                            <h1>Book Catalog</h1>
                        </div>
                </header>        
            <!--END HEADER-->
            
            <!--ABOUT-->
            <section class="content">
                    <select name="genre">
                        <option value = "">Select Genre</option>
                        <?
                        foreach($genres as $genre):
                            $selectedGenre = '';
                            
                            if ($genre['id'] == $genreId) {
                                $selectedGenre = 'selected';
                            }
                        ?>
                            <option <?=$selectedGenre?> value="<?=$genre['id']?>"><?=$genre['title']?></option>
                         <?
                        endforeach;
                        ?>
                       
                    </select>
                    <select name="author">
                        <option value = "">Select Author</option>
                        <?
                        foreach($authors as $author):
                            $selectedAuthor = '';
                            
                            if ($author['id'] == $authorId) {
                                $selectedAuthor = 'selected';
                            }
                        ?>
                            <option <?=$selectedAuthor?> value="<?=$author['id']?>"><?=$author['name']?></option>
                         <?
                        endforeach;
                        ?>
                       
                    </select>    
                  <div class="book">
                     <div class="books-items">
                      <ul>
		                  <?
                            foreach($books as $book):
                          ?>
		                  	
		                    <li>
                                  <h2><a href='view/books.php?bookId=<?=$book['id']?>'><?=$book['title']?></a></h2>
                                  <span>Цена : <?=$book['price']?> .UAH</span>      
                                  <h3 class="genre">Жанр : <?=$genreObj->getGenreByBookId($book['id'])?></h3>
                                  <h3 class="genre">Автор : <?=$authorObj->getAuthorByBookId($book['id'])?></h3>                
                           </li>
                        <?
                        endforeach;
                        ?>
                                  
                                 
	                </ul>
	                </div>
                  </div>            
            </section>
              <footer>
                    <div class="footer-info">
                        	<p>&copy; Book Catalog by Olexander Pastukhov</p>
                    </div>
             </footer>
    </div>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>