<?php
session_start();
require_once __DIR__ . '/../../src/usecase/book/FindBookByIdUseCase.php';
require_once __DIR__ . '/../../src/usecase/user/FindUserByIdUseCase.php';

$book = findBookById($_GET['id']);

if (is_null($book)) {
  return;
}

// 空文字だと検査に引っかからないので、存在しない場合は適当な文字列を入れておく
$thumbnailImageName = $book->getThumbnailPath() == "" ? "hoge" : $book->getThumbnailPath();
if (file_exists("../../assets/img/book/" . $thumbnailImageName)) {
  $thumbnail = "/seiran/assets/img/book/" . $book->getThumbnailPath();
} else {
  $thumbnail = "https://via.placeholder.com/400x500/?text=Sample";
}
$title = $book->getName();
$user = findUserById($book->getUserId());
$price = number_format($book->getPrice());
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <!-- TODO: ここに小説名を挿入 -->
  <title><?php echo $title ?> | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/book/show.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main>
    <?php if (!is_null($book)) : ?>
      <div class="is-flex">
        <div class="left mr-6">
          <div class="book_thumbnail mb-6">
            <img src="<?php echo $thumbnail ?>" alt="book_thumbnail">
          </div>
          <h2 class="has-text-right"><?php echo $price ?> 円</h2>
          <a href="#" id="button_read" class="button is-primary">読む</a>
        </div>
        <div class="right">
          <p class="has-text-right">
            <span class="has-text-weight-bold">初版投稿日</span>：<?php echo $book->getRegisteredAt() ?>
          </p>
          <p class="has-text-right">
            <span class="has-text-weight-bold">更新日</span>：<?php echo $book->getRegisteredAt() ?>
          </p>
          <h2 class="title"><?php echo $title ?></h2>
          <div class="user mb-3">
            <figure class="image mr-3">
              <img class="is-rounded" src="https://via.placeholder.com/32x32" alt="user icon">
            </figure>
            <span class="has-text-grey">テストユーザー（test）</span>
          </div>
          <p><?php echo $book->getDescription() ?></p>
        </div>
      </div>
    <?php else : ?>
      <h1>404</h1>
      <p>お探しのページは見つかりませんでした。</p>
    <?php endif; ?>
  </main>
</body>

</html>
