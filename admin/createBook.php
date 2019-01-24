<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="../styles/main.css">
	<title>Форма добавления товара в каталог</title>
</head>
<body>
    <div class="main-container">
        <h1>Страница добавление книги</h1>
            <form action="save2catalog.php" method="post">
                  <fieldset class="edit-book">
                        <label>
                              Название книги
                              <input type="text" name="title">
                        </label>
                        <label>
                              Жанр
                              <input type="text" name="genre">
                        </label>
                        <label>
                              Автор
                              <input type="text" name="author">
                        </label>
                        <label>
                              Цена
                              <input type="text" name="price"> 
                        </label>
                        <label>
                              Краткое описание
                              <textarea name="description"></textarea>
                        </label>
                  </fieldset>
                  <input class="btn btn-default" type="submit" value="Create">
            </form>
    </div>	    
</body>
</html>