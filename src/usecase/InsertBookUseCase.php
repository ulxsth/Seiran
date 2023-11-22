<?php
session_start();

require_once dirname(__FILE__, 2) . "/repository/BookRepository.php";
$repository = new BookRepository();

$repository->insert('', $_SESSION["user"]["id"], 1);

header('Location: /seiran/view/book/editor.php?id=1');
?>
