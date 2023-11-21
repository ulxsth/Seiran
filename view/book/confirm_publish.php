<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>公開前確認 | Seiran</title>
  <?php require_once '../component/head.php'; ?>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/book/confirm_publish.css">
</head>

<body>
<?php require_once '../component/header.php'; ?>
<main>
    <p class="title1">投稿前確認</p>
    <p>以下の内容で投稿します。よろしいですか？</p>
<div class="box">
    <p class="title2">タイトル</p>
    <p>ここにタイトル</p>
    <p class="title3">概要</p>
    <p>これはテストデータの説明です。</p>
</div>
    <a href="#" class="button is-primary">投稿</a> &emsp;
    <a href="#" class="button is-link is-outlined">書き直す</a>
</main>
</body>

</html>