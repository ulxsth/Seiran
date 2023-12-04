<?php
require_once dirname(__FILE__, 3) . "/repository/BookRepository.php";

$repository = new BookRepository();
$book = $repository->findById($_POST['id'], true);
if (is_null($book)) {
    header("Location: /seiran/view/error/404.php");
    exit;
}

if (!empty($_FILES['thumbnail'])) {
    $filename = uniqid() . '.' . pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION);
    $thumbnailPath = dirname(__DIR__, 3) . '/assets/img/book/' . $filename;

    $book->setThumbnailPath($filename);
    move_uploaded_file($_FILES['thumbnail']['tmp_name'], $thumbnailPath);
}

$book->setName($_POST['title']);
$book->setDescription($_POST['description']);
$book->setPrice($_POST['price']);
$book->setCategoryId($_POST['category']);
$book->setIsPublic(true);
$repository->update($book);

header("Location: /seiran/view/book/show.php?id=" . $book->getId());
?>
