<?php
session_start();
require_once dirname(__DIR__, 2) . '/repository/FavoriteRepository.php';

$user_id = $_SESSION['user']['id'];
$book_id = $_GET['id'];

$repository = new FavoriteRepository();
$count = $repository->delete(new FavoriteDTO($book_id, $user_id));

if($count === 0) {
  echo "お気に入りの解除に失敗しました";
  return;
}

header('Location: /seiran/view/book/show.php?id=' . $book_id);
?>
