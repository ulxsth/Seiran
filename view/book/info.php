<?php
session_start();
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
      <div class="total-ranking__item is-flex mb-6">
        <figure class="thumbnail">
          <img src="https://via.placeholder.com/300x400">
        </figure>
        <div class="description has-text-left">
          <p class="title">ここにタイトル</p>
          <p class="text">これは物語の概要です</p>
        </div>
      </div>
      <div class="total-ranking__item is-flex mb-6">
        <figure class="thumbnail">
          <img src="https://via.placeholder.com/300x400">
        </figure>
        <div class="description has-text-left">
          <p class="title">ここにタイトル</p>
          <p class="text">これは物語の概要です</p>
        </div>
      </div>
      <div class="total-ranking__item is-flex mb-6">
        <figure class="thumbnail">
          <img src="https://via.placeholder.com/300x400">
        </figure>
        <div class="description has-text-left">
          <p class="title">ここにタイトル</p>
          <p class="text">これは物語の概要です</p>
        </div>
      </div>
    </div>
    <h1 class="mb-3">カテゴリ別ランキング</h1>
    <h2 class="mb-3">推理</h2>
    <h2 class="mb-3">恋愛</h2>
    <h2 class="mb-3">コメディ</h2>
    <h1 class="mb-3">新着投稿</h1>
  </main>
</body>

</html>
