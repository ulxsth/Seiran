<?php
session_start();
require_once dirname(__DIR__, 2) . "/src/repository/BookRepository.php";

// 小説検索
$repository = new BookRepository();
$book = $repository->findById($_GET['id']);
if (is_null($book)) {
  header('Location: /seiran/view/error/404.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>非公開確認 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/user/unpublish_confirm.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main>
    <h1 class="mb-3">非公開前確認</h1>

    <div>
      <p>小説を非公開にします。よろしいですか？</p>
      <p class="has-text-grey mt-1">TIPS:非公開にした小説は、エディターの「下書き一覧」から再度投稿できます。</p>
    </div>

    <div class="my-6">
      <p>タイトル</p>
      <h2><?php echo $book->getName() ?></h2>
    </div>
    <div class="control">
      <button onclick="location.href='/seiran/src/usecase/book/UnpublishBookUseCase.php?id=<?php echo $_GET["id"] ?>'" class="button is-primary">非公開にする</button>
    </div>
  </main>
</body>

</html>
