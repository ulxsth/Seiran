<?php
session_start();
require_once 'FindBookByIdUseCase.php';
require_once dirname(__DIR__, 3) . '/src/repository/BookRepository.php';

$book = findBookById($_GET['id']);
if (is_null($book)) {
  header('Location: /seiran/view/error/404.php');
  exit;
}
if ($book->getUserId() != $_SESSION["user"]["id"]) {
  header('Location: /seiran/view/error/403.php');
  exit;
}

$bookRepository = new BookRepository();
$book->setName($_POST['title']);
$book->setDescription($_POST['description']);
$book->setPrice($_POST['price']);
$book->setCategoryId($_POST['category']);
$bookRepository->update($book);

header('Location: /seiran/view/book/show.php?id=' . $_GET['id']);
?>
