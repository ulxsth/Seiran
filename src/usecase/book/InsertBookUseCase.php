<?php
session_start();

require_once dirname(__FILE__, 3) . "/repository/BookRepository.php";
$repository = new BookRepository();

$book_id = $repository->insert('', $_SESSION["user"]["id"], 1);

header('Location: /seiran/view/book/editor.php?id=' . $book_id);
?>
