<?php
session_start();
require_once dirname(__DIR__, 3) . '/src/repository/BookRepository.php';

$repository = new BookRepository();
$book = $repository->findById($_GET["id"]);

if(is_null($book)) {
  header('Location: /seiran/view/error/404.php');
  exit;
}

if($book->getUserId() != $_SESSION["user"]["id"]) {
  header('Location: /seiran/view/error/403.php');
  exit;
}

$book->setIsPublic(false);
$repository->update($book);

header('Location: /seiran/view/book/sendback_completed.php');
?>
