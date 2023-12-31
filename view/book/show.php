<?php
session_start();
require_once __DIR__ . '/../../src/usecase/book/FindBookByIdUseCase.php';
require_once __DIR__ . '/../../src/usecase/user/FindUserByIdUseCase.php';
require_once __DIR__ . '/../../src/usecase/purchase/IsPurchasedBookUseCase.php';
require_once __DIR__ . '/../../src/usecase/favorite/IsFavoriteBookUseCase.php';
require_once __DIR__ . '/../../src/usecase/favorite/GetFavoriteCountUseCase.php';

$book = findBookById($_GET['id']);
if (is_null($book)) {
  header('Location: /seiran/view/error/404.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <title><?php echo $book->getName() ?> | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/book/show.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main>
    <?php if (is_null($book)) : ?>
      <h1>404</h1>
      <p>お探しのページは見つかりませんでした。</p>
    <?php else : ?>
      <?php
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

      $isPurchased = isPurchasedBookUsecase::execute($_SESSION["user"]["id"], $_GET["id"]);
      $isFavorite = isFavoriteBookUsecase::execute();
      $favoriteCount = getFavoriteCountUsecase::execute($_GET["id"]);
      ?>

      <div class="is-flex">
        <div class="left mr-6">
          <div class="book_thumbnail mb-6">
            <img src="<?php echo $thumbnail ?>" alt="book_thumbnail">
          </div>
          <h2 class="has-text-right"><?php echo $price ?> 円</h2>
          <?php if ($isPurchased) : ?>
            <a href="/seiran/view/book/reader.php?id=<?php echo $book->getId() ?>" id="button_read" class="button is-primary">読む</a>
          <?php elseif ($book->getUserId() == $_SESSION["user"]["id"]) : ?>
            <a href="/seiran/view/book/edit_detail.php?id=<?php echo $_GET["id"] ?>">編集する</a>
          <?php else : ?>
            <form action="/seiran/src/usecase/purchase/PurchaseBookUseCase.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $book->getId() ?>">
              <input type="submit" value="購入する" class="button is-primary">
            </form>
          <?php endif; ?>

          <div class="favorite">
            <?php if ($isFavorite) : ?>
              <a href="/seiran/src/usecase/favorite/DeleteFavoriteUseCase.php?id=<?php echo $book->getId() ?>">♥ <?php echo $favoriteCount ?></a>
            <?php else : ?>
              <a href="/seiran/src/usecase/favorite/InsertFavoriteUseCase.php?id=<?php echo $book->getId() ?>">♡ <?php echo $favoriteCount ?></a>
            <?php endif; ?>
          </div>
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
            <figure class="image is-32x32 mr-3">
              <img src="/seiran/assets/img/user/<?php echo $user->getIconPath() ?>" alt="user_icon" class="is-rounded">
            </figure>
            <a class="author-name" href="/seiran/view/user/show.php?id=<?php echo $user->getId() ?>">
              <?php echo $user->getName() ?>
              <span class="has-text-grey">
                （@<?php echo $user->getId() ?>）
              </span>
            </a>
          </div>
          <p><?php echo $book->getDescription() ?></p>
        </div>
      </div>
    <?php endif; ?>
  </main>
</body>

</html>
