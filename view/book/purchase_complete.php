<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require_once '../component/head.php'; ?>
  <title>小説購入完了 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/user/unpublish_completed.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main class="has-text-centered">
    <figure class="image is-256x256 mx-auto mb-6">
      <img src="/seiran/assets/img/MicrosoftTeams-image (1).png" alt="sendback_icon">
    </figure>

    <div class="control mb-6">
      <p>購入が完了しました！</p>
    </div>

    <div class="control">
      <button type="submit" class="button is-link is-outlined px-6">ホームへ</button>
      <button type="submit" class="button is-link is-outlined px-6">ホームへ</button>
    </div>
  </main>
</body>

</html>
