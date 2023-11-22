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
        <input class="input-title input" type="text" placeholder="タイトルを入力">
        <textarea class="input-content textarea" placeholder="本文を入力..."></textarea>
        <div class="toolbar">

        </div>
      </div>
    </div>
  </div>
</body>

</html>
