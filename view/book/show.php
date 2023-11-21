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
    <div class="left">
      <div class="book_thumbnail">
        <img src="https://via.placeholder.com/512x512" alt="book">
      </div>
      <p class="nedan">値段表示</p>
      <a href="#" class="button">読む</a>
    </div>
    <div class="right">
      <p class="toukou"><span class="has-text-weight-bold">初版投稿日</span>：20XX-XX-XX</p>
      <p class="kousin"><span class="has-text-weight-bold">更新日</span>：20XX-XX-XX</p>
      <p class="title">test_1</p>
      <p><img src="/seiran/assets/img/">テストユーザー（test）</p>
      <p class="text">これは概要です</p>
    </div>
  </main>
</body>

</html>
