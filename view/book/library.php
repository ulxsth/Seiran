<?php
session_start();
require_once __DIR__ . '/../../usecase/book/FetchBoughtBooksUseCase.php';

$userId = $_SESSION['user_id'];
if (!$userId) {
  header('Location: /seiran/view/auth/login.php');
  exit;
}

$books = FetchBoughtBooksUseCase::execute($userId);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ライブラリ | Seiran</title>
  <?php require_once '../component/head.php'; ?>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/book/library.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <div class="library-wrapper">
    <?php $count = 0; ?>
    <?php foreach ($books as $book) : ?>
      <?php if ($count % 4 == 0) : ?>
        <?php if ($count != 0) : ?>
          </div>
        <?php endif; ?>
        <div class="library-row">
      <?php endif; ?>
      <div class="library-item">
        <img src="<?php echo $book->getThumbnailPath(); ?>" alt="thumbnail">
      </div>
      <?php $count++; ?>
      <?php if ($count % 4 == 0) : ?>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($count % 4 != 0) : ?>
      </div>
    <?php endif; ?>
  </div>

<?php require_once '../component/footer.php'; ?>
</body>

</html>

</div>
</div>
</div>
</body>

</html>
