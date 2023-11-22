<?php
require_once dirname(__FILE__, 2) . "/repository/BookRepository.php";
$repository = new BookRepository();

$book = $repository->findById($POST['id']);
$book->setName($POST['name']);
$book->setContext($POST['context']);

$repository->upsert($book);
?>
