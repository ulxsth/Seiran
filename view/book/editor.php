<?php
session_start();
require_once __DIR__ . '/../../src/usecase/book/FindBookByIdUseCase.php';
$book = findBookById($_GET['id'], true);
if (is_null($book)) {
  header('Location: /seiran/view/error/404.php');
  exit;
}
if($book->getUserId() != $_SESSION["user"]["id"]) {
  header('Location: /seiran/view/error/403.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <title>編集中 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/book/editor.css">
</head>

<body>
  <div class="columns">
    <div class="sidebar column is-one-fifth">
      <aside class="menu pl-6 pt-2">
        <div class="menu-list">
          <i class="fa-solid fa-house"></i>
          <h1>ホーム</h1>
        </div>
        <div class="menu-list">
          <h2>エディタ</h2>
        </div>
        <div class="menu-list">
          <h2>下書き一覧</h2>
        </div>
      </aside>
    </div>
    <div class="column">
      <div class="content">
        <form action="/seiran/src/usecase/book/UpdateBookUseCase.php" method="POST">
          <div class="content-top pr-3">
            <input name="title" class="input-title input" type="text" placeholder="タイトルを入力" value="<?php echo $book->getName(); ?>">
            <div class="buttons">
              <button type="submit" class="button is-link is-outlined">保存</button>
              <a onclick="location.href='/seiran/view/book/input_detail.php?id=<?php echo $_GET['id'] ?>'" class="button is-primary">公開設定</a>
            </div>
          </div>
          <textarea name="context" class="input-content textarea" placeholder="本文を入力..." value="<?php echo $book->getContext(); ?>"></textarea>
          <div class="toolbar">

          </div>
          <input type="hidden" name="book_id" value="<?php echo $_GET["id"] ?>">
        </form>
      </div>
    </div>
  </div>

</body>

</html>
