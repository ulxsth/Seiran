<?php
session_start();

require_once __DIR__ . '/../repository/BookRepository.php';
require_once __DIR__ . '/../dto/BookDTO.php';

$bookRepository = new BookRepository();
$book = $bookRepository->findById($_POST['book_id']);

if (is_null($book)) {
  echo "指定された作品は存在しません！";
  return;
}

if ($book->getUserId() !== $_SESSION['user']['id']) {
  echo "あなたはこの作品の作者ではありません！";
  return;
}

$book->setName($_POST['title']);
$book->setContext($_POST['context']);
$bookRepository->update($book);

header('Location: /seiran/view/book/editor.php?id=' . $_POST['book_id']);
?>
