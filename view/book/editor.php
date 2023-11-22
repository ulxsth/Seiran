<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <title>編集中 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/editor.css">
</head>

<body>
  <div class="columns">
    <div class="column is-one-fifth">
      <aside class="menu">
      </aside>
    </div>
    <div class="column">
      <div class="content">
        <input class="input" type="text" placeholder="タイトルを入力">
        <textarea class="textarea" placeholder="本文を入力..."></textarea>
      </div>
    </div>
  </div>
</body>

</html>
