<?php
require_once dirname(__FILE__, 2) . "/repository/BookRepository.php";
$repository = new BookRepository();

$book = $repository->findById($_POST['id']);
if (is_null($book)) {
  $repository->insert($_POST['title'], $_POST['id']);
  $book = $repository->findById($_POST['id']);
}
$book->setName($_POST['title']);
$book->setContext($_POST['context']);

$repository->upsert($book);
?>
