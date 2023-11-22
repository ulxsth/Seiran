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
      <aside class="menu">
      </aside>
    </div>
    <div class="column">
      <div class="content">
        <form action="#" method="POST">
          <div class="content-top pr-3">
            <input class="input" type="text" placeholder="タイトルを入力">
            <button class="button is-primary">公開設定</button>
          </div>
          <textarea class="input-content textarea" placeholder="本文を入力..."></textarea>
          <div class="toolbar">

          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
