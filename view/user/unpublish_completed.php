<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン | Seiran</title>
  <?php require_once '../component/head.php'; ?>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/user/unpublish_completed.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main class="has-text-centered">
  <figure class="image is-256x256 mx-auto mb-6">
      <img src="/seiran/assets/img/farewell.png" alt="sendback_icon">
    </figure>

    <div class="control mb-6">
      <h2>非公開にしました。</h2>
      <p>非公開になった小説はいつでも「下書き一覧」から再投稿できます。</p>
    </div>

    <div class="control">
      <button type="submit" class="button is-link is-outlined px-6">ログイン画面へ</button>
    </div>
  </main>

</html>
