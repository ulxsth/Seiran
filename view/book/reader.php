<?php
session_start();
require_once __DIR__ . '/../../src/usecase/book/FindBookByIdUseCase.php';
require_once __DIR__ . '/../../src/usecase/purchase/IsPurchasedBookUseCase.php';

$bookId = $_GET["id"];
$book = findBookById($bookId, $includePrivate = true);
if (is_null($book)) {
  header('Location: /seiran/view/error/404.php');
  exit;
}

$isPurchased = IsPurchasedBookUseCase::execute($_SESSION["user"]["id"], $bookId);
if (!$isPurchased) {
  header('Location: /seiran/view/error/404.php');
  exit;
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ここにタイトル | Seiran</title>
  <?php require_once '../component/head.php'; ?>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/book/confirm_publish.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main>
    <div class="content">
      <h1><?php echo $book->getName() ?></h1>
      <p><?php echo $book->getContext() ?></p>
    </div>
  </main>
</body>

</html>
