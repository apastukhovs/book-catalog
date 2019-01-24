<?
function clearInt($num){
    return abs((int)$num);
}

function clearStr($str){
    return trim(strip_tags($str));

}

function getData($resource) {
    $arr = array();

    while($val = $resource->fetch_assoc()) {
        $arr[] = $val;
    }

    return $arr;
}

class Genre {
    private $link;

    public function __construct($link) {
        $this->link = $link;
    }
    
    public function getAllGenres() {
        $sql = "SELECT id, title FROM genre";
        $result  = $this->link->query($sql);

        return getData($result);
    }

    public function addGenre($title) {
        $sql = "SELECT id FROM Genre WHERE title = '$title' LIMIT 1";
        $result  = $this->link->query($sql);
        if ($result->num_rows > 0) {
            $book = getData($result);
            return $book[0]['id'];
        }
        
        $sql = "INSERT INTO Genre (title) VALUES ('$title') ";
        if ($this->link->query($sql) === TRUE) {
            return $this->link->insert_id;
        }
        else {
            return 0;
        }
    }

    public function  addGenreToBook($bookId, $genreId) {
        $sql = "INSERT INTO genrebook (genre_id, book_id) VALUES ($genreId, $bookId) ";
        return $this->link->query($sql);
    }

    public function getGenreByBookId($id) {
        $sql = "SELECT title FROM genre, genrebook WHERE book_id = $id AND genre_id=id";
        $result  = $this->link->query($sql);
        if ($result->num_rows > 0) {
            $genrestr = '';    
            while($genre = $result->fetch_assoc()) {
        
                $genrestr .= $genre['title'] . ' ';
            }
    
            return (trim($genrestr));
        }
    }

    public function  deleteGenreFromBook($bookId) {
         $sql = "DELETE FROM genrebook 
                WHERE book_id = $bookId";
        return $this->link->query($sql);
        
    }
    
}

class Book {
    private $link;

    public function __construct($link) {
        $this->link = $link;
    }

    public function getAllBooks($genreId = 0, $authorId = 0) {
        $addGenres = '';
        $addAuthors = '';
    
        if ($genreId > 0) {
            $addGenres = " ,genrebook gb WHERE b.id = gb.book_id AND gb.genre_id =  $genreId";
        }
        if ($authorId > 0) {
            $addAuthors = " ,authorbook ab WHERE b.id = ab.book_id AND ab.author_id =  $authorId";
        }
        $sql = "SELECT b.id, b.title, b.price, b.description FROM book b $addGenres $addAuthors";
        $result  = $this->link->query($sql);
        return getData($result);
    }

    public function getBookById($id) {
        $sql = "SELECT id, title, price, description FROM book WHERE id = $id";
        $result = $this->link->query($sql);
        if ($result->num_rows > 0) {
            $book = getData($result);
            return $book[0];
        }
    }

    public function addBook($title, $price, $description) {
         $sql = "INSERT INTO book (title, price, description) VALUES ('$title', '$price', '$description' )";
         if ($this->link->query($sql) === TRUE) {
            return $this->link->insert_id;
        }
        else {
            return 0;
        }
    }

    public function updateByBookId($id, $title, $description, $price) {      
        $sql = "UPDATE book
                SET title='$title', description='$description', price='$price'
                WHERE id = $id";    
        return $this->link->query($sql);        
    }

}

class Author {
    private $link;

    public function __construct($link) {
        $this->link = $link;
    }

    public function sum() {
        return $this->firstNumber + $this->secondNumber;
    }

    public function addAuthor($name) {
        $sql = "SELECT id FROM author WHERE name = '$name' LIMIT 1";
        $result  = $this->link->query($sql);
        if ($result->num_rows > 0) {
            $book = getData($result);
            return $book[0]['id'];
        }
        
        if(!trim($name)) {
            return 0;
        }
        $sql = "INSERT INTO author (name) VALUES ('$name') ";
        if ($this->link->query($sql) === TRUE) {
            return $this->link->insert_id;
        }
        else {
            return 0;
        }
    }
    
    public function  addAuthorToBook($bookId, $authorId) {
        $sql = "INSERT INTO authorbook (author_id, book_id) VALUES ($authorId, $bookId) ";
        return $this->link->query($sql);
    }
    
    public function getAllAuthors() {
        $sql = "SELECT id, name FROM author";
        $result  = $this->link->query($sql);
        return getData($result);
    }
    
    public function getAuthorByBookId($id) {
        $sql = "SELECT name FROM author, authorbook WHERE book_id = $id AND author_id=id";
        $result  = $this->link->query($sql);
        $numRows = $result->num_rows;
        
        if ($numRows > 0) {
            $authorstr = '';
    
            $authors = getData($result);
            foreach($authors as $key => $author) {
                $authorstr .= $author['name'];
                
                if ($key < $numRows - 1) {
                    $authorstr .= ', ';
                }
            }
    
            return ($authorstr);
        }
    }
        
    public function  deleteAuthorFromBook($bookId) {
         $sql = "DELETE FROM authorbook 
                WHERE book_id = $bookId";
        return $this->link->query($sql);
    }
}