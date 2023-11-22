<?php session_start(); ?>

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
        <form action="/seiran/src/usecase/UpsertBookUseCase.php" method="POST">
          <div class="content-top pr-3">
            <input class="input-title input" type="text" placeholder="タイトルを入力">
            <div class="buttons">
              <button type="submit" class="button is-link is-outlined">保存</button>
              <button onclick="location.href='#'" class="button is-primary">公開設定</button>
            </div>
          </div>
          <textarea class="input-content textarea" placeholder="本文を入力..."></textarea>
          <input type="hidden" name="id" value="<?php echo $_SESSION['user']['id']; ?>">
          <div class="toolbar">

            </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>
