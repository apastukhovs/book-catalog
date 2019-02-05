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
        return $this->link->select($sql);
       }

    public function addGenre($title) {
        $sql = "SELECT id FROM Genre WHERE title = '$title' LIMIT 1";
        $result  = $this->link->select($sql);
           if (count($result) > 0) {
            
            return $result[0]['id'];
        }
        
        $sql = "INSERT INTO Genre (title) VALUES (:title) ";
        return $this->link->insert($sql, array(
            ':title' => $title
        ));
    }

    public function  addGenreToBook($bookId, $genreId) {
        $sql = "INSERT INTO genrebook (genre_id, book_id) VALUES (:genreId, :bookId) ";
        return $this->link->insert($sql, array (
            ':genreId' => $genreId, 
            ':bookId' => $bookId
        ));
    }

    public function getGenreByBookId($id) {
        $sql = "SELECT title FROM genre, genrebook WHERE book_id = $id AND genre_id=id";
        $result  = $this->link->select($sql);
        if ( count($result) > 0) {
            $genrestr = '';    
            foreach($result as $genre) {
        
                $genrestr .= $genre['title'] . ' ';
            }
    
            return (trim($genrestr));
        }
    }

    public function  deleteGenreFromBook($bookId) {
         $sql = "DELETE FROM genrebook 
                WHERE book_id = :bookId";
        return $this->link->query($sql, array (
               ':bookId' => $bookId
        ));
        
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
        return $this->link->select($sql);
        }

    public function getBookById($id) {
        $sql = "SELECT id, title, price, description FROM book WHERE id = $id";
        $result = $this->link->select($sql);
        return $result[0];
    }

    public function addBook($title, $price, $description) {
         $sql = "INSERT INTO book (title, price, description) VALUES (:title, :price, :description)";
         return $this->link->insert($sql, array(
             ':title' => $title,
             ':price' => $price,
             ':description' => $description
         )) ;
    }

    public function updateByBookId($id, $title, $description, $price) {      
        $sql = "UPDATE book
                SET title=:title, description=:description, price=:price
                WHERE id = :id";    
        return $this->link->query($sql, array (
            ':title' => $title, 
            ':description' => $description,
            ':price' => $price,
            ':id' => $id
        ));        
    }

}

class Author {
    private $link;

    public function __construct($link) {
        $this->link = $link;
    }

    public function addAuthor($name) {
        $sql = "SELECT id FROM author WHERE name = '$name' LIMIT 1";
        $result  = $this->link->select($sql);
        if (count($result) > 0) {
            return $result[0]['id'];
        }
        
        if(!trim($name)) {
            return 0;
        }
        $sql = "INSERT INTO author (name) VALUES (:name) ";
        return $this->link->insert($sql, array(
            ':name' => $name
        ));
    }
    
    public function  addAuthorToBook($bookId, $authorId) {
        $sql = "INSERT INTO authorbook (author_id, book_id) VALUES (:authorId, :bookId) ";
        return $this->link->insert($sql, array (
            ':authorId' => $authorId, 
            ':bookId' => $bookId,
            ));
    }
    
    public function getAllAuthors() {
        $sql = "SELECT id, name FROM author";
        return $this->link->select($sql);
    }
    
    public function getAuthorByBookId($id) {
        $sql = "SELECT name FROM author, authorbook WHERE book_id = $id AND author_id=id";
        $result  = $this->link->select($sql);
        
        
        if (count($result) > 0) {
            $authorstr = '';
                foreach($result as $key => $author) {
                $authorstr .= $author['name'];
                
                if ($key < count($result) - 1) {
                    $authorstr .= ', ';
                }
            }
    
            return ($authorstr);
        }
    }
        
    public function  deleteAuthorFromBook($bookId) {
         $sql = "DELETE FROM authorbook 
                WHERE book_id = :bookId";
        return $this->link->query($sql, array (
            ':bookId' => $bookId
            ));
    }
}