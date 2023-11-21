<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <title>小説登録完了 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/book/create_completed.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main class="has-text-centered">
    <img src="/seiran/assets/img/done.png" class="success_image" alt="done logo">
    <p class="has-text-weight-bold is-size-5 my-4">小説を投稿しました。</p>
    <div class="is-justify-content-space-evenly" style="display: flex; justify-content: space-between;">
      <!-- TODO: リンク指定 -->
      <button onclick="location.href='#'" class="button is-link is-outlined">詳細ページへ</button>
      <button onclick="location.href='#'" class="button is-link is-outlined">ホームへ</button>
    </div>
  </main>
</body>

</html>
