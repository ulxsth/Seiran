<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <!-- TODO: ここに小説名を挿入 -->
  <title>小説詳細 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/book/show.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main>
    <div class="is-flex">
      <div class="left mr-6">
        <div class="book_thumbnail mb-6">
          <img src="https://via.placeholder.com/512x512" alt="book">
        </div>
        <h2 class="has-text-right">100000 円</h2>
        <a href="#" id="button_read" class="button is-primary">読む</a>
      </div>
      <div class="right">
        <p class="has-text-right">
          <span class="has-text-weight-bold">初版投稿日</span>：20XX-XX-XX
        </p>
        <p class="has-text-right">
          <span class="has-text-weight-bold">更新日</span>：20XX-XX-XX
        </p>
        <p class="title">test_1</p>
        <div class="user mb-3">
          <figure class="image mr-3">
            <img class="is-rounded" src="https://via.placeholder.com/32x32" alt="user icon">
          </figure>
          <span class="has-text-grey">テストユーザー（test）</span>
        </div>
        <p>これは概要です。これは概要です。これは概要です。これは概要です。これは概要です。これは概要です。これは概要です。これは概要です。これは概要です。これは概要です。これは概要です。これは概要です。これは概要です。これは概要です。これは概要です。</p>
      </div>
    </div>
  </main>
</body>

</html>
