<?php
require_once dirname(__FILE__, 3) . "/repository/BookRepository.php";

$repository = new BookRepository();
$book = $repository->findById($_POST['id']);
if (!$book) {
    echo "Book not found";
    exit;
}

$book->setName($_POST['title']);
$book->setDescription($_POST['description']);
$book->setPrice($_POST['price']);
$book->setCategoryId($_POST['category']);
$book->setIsPublic(true);
$repository->update($book);

header("Location: /seiran/view/book/show.php?id=" . $book->getId());
?>
