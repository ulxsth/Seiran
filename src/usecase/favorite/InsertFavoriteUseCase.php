<?php
session_start();
require_once dirname(__FILE__, 3) . '/repository/FavoriteRepository.php';

$user_id = $_SESSION['user']['id'];
$book_id = $_GET['id'];

$repository = new FavoriteRepository();
$repository->insert($user_id, $book_id);

header('Location: /seiran/view/book/show.php?id=' . $book_id);
?>
