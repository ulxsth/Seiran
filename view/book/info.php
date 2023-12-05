<?php
session_start();
require_once __DIR__ . '/../../src/usecase/book/FetchTotalRankingUseCase.php';
require_once __DIR__ . '/../../src/usecase/book/FetchCategoryRankingUseCase.php';
require_once __DIR__ . '/../../src/usecase/book/FetchNewPostUseCase.php';

require_once __DIR__ . '/../../src/usecase/category/FetchAllCategoryUseCase.php';
require_once __DIR__ . '/../../src/usecase/book/RenderCarouselUseCase.php';

$categories = FetchAllCategoryUseCase::execute();
$totalRankingBooks = FetchTotalRankingUseCase::execute();
$newPostBooks = FetchNewPostUseCase::execute();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ホーム | Seiran</title>
  <?php require_once '../component/head.php'; ?>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/book/info.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main class="has-text-centered">
    <h1>タイムライン</h1>


    <div class="total-ranking">
      <h1 class="mb-3">総合ランキング</h1>
      <?php $rank = 1; ?>
      <?php foreach ($totalRankingBooks as $book) : ?>
        <div class="ranking__item is-flex mb-6">
          <p class="rank"><?php echo $rank; ?></p>
          <figure class="thumbnail">
            <a href="/seiran/view/book/show.php?id=<?php echo $book->getId() ?>">
              <img src="/seiran/assets/img/book/<?php echo $book->getThumbnailPath(); ?>">
            </a>
          </figure>

          <div class="description has-text-left">
            <a href="/seiran/view/book/show.php?id=<?php echo $book->getId() ?>">
              <p class="title"><?php echo $book->getName(); ?></p>
            </a>
            <p class="text"><?php echo $book->getDescription(); ?></p>
          </div>
        </div>
        <?php $rank++; ?>
      <?php endforeach; ?>
    </div>
    <h1 class="mb-3">カテゴリ別ランキング</h1>
    <div class="category-ranking">
      <?php foreach ($categories as $category) : ?>
        <div class="ranking__item mb-6">
          <h2 class="ranking__title"><?php echo $category->getName(); ?></h2>
          <?php $categoryRankingBooks = FetchCategoryRankingUseCase::execute($category->getId()); ?>
          <?php $rank = 1; ?>
          <?php foreach ($categoryRankingBooks as $book) : ?>
            <div class="ranking__item is-flex mb-6">
              <p class="rank"><?php echo $rank; ?></p>
              <figure class="thumbnail">
                <a href="/seiran/view/book/show.php?id=<?php echo $book->getId() ?>">
                  <img src="/seiran/assets/img/book/<?php echo $book->getThumbnailPath(); ?>">
                </a>
              </figure>

              <div class="description has-text-left">
                <a href="/seiran/view/book/show.php?id=<?php echo $book->getId() ?>">
                  <p class="title"><?php echo $book->getName(); ?></p>
                </a>
                <p class="text"><?php echo $book->getDescription(); ?></p>
              </div>
            </div>
            <?php $rank++; ?>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="new-post">
      <h1 class="mb-3">新着投稿</h1>
        <?php echo RenderCarouselUseCase::execute($newPostBooks); ?>
    </div>
  </main>
</body>

</html>
