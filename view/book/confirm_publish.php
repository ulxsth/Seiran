<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>公開前確認 | Seiran</title>
  <?php require_once '../component/head.php'; ?>
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main class="has-text-centered">
    <div class="container">
      <h1>投稿前確認</h1>
      <p>以下の内容で投稿します。よろしいですか？</p>
    </div>

    <div class="box p-5 my-5">
      <div class="container">
        <div class="field">
          <h2>タイトル</h2>
          <p>ここにタイトル</p>
        </div>
        <div class="field">
          <h2>概要</h2>
          <p>これはテストデータの説明です。</p>
        </div>
      </div>
    </div>

    <div class="container">
      <button onclick="location.href='#'" class="button is-primary">投稿</button>
      <button onclick="location.href='#'" class="button is-link is-outlined">書き直す</button>
    </div>
  </main>
</body>

</html>
