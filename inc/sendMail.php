<?

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = $_POST['book_id'];
    $adress = $_POST['adress'];
    $customer = $_POST['customer'];
    $bookTitle = $_POST['book_title'];
    $bookPrice = $_POST['book_price'];

    $body = "Customer: $customer\nAdress: $adress\nBook Id: $bookId\nBook Title: $bookTitle\nBook Price: $bookPrice";

    mail('a.pastukhov.s@gmail.com', 'Order book', $body);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);