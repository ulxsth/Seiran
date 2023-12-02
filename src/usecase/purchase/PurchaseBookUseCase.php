<?php
session_start();

require_once dirname(__DIR__, 2) . '/repository/BookRepository.php';
require_once dirname(__DIR__, 2) . '/dto/PurchaseDTO.php';
require_once dirname(__DIR__, 2) . '/repository/PurchaseRepository.php';

$bookRepository = new BookRepository();
$purchaseRepository = new PurchaseRepository();

$bookId = $_POST['id'];
$book = $bookRepository->findById($bookId);
if(is_null($book)) {
  echo "本が見つかりませんでした";
  return;
}

$userId = $_SESSION['user']['id'];
$purchaseRepository->insert($userId, $bookId, $book->getPrice());
echo "購入しました";
header("Location: /seiran/view/book/show.php?id=" . $bookId);
?>
