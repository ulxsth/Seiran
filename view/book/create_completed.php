<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <title>小説登録完了 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main>
  <div class="back">
    <section class="container">
    <img src="../../assets/img/done.svg"  alt="done logo">
    </section>
    <div class="is-size-2 has-text-link-dark mb-4">
      DONE!
    </div>
    <div class="is-size-2 mb-4">
    小説が投稿されました。
    </div>
    <div class="is-justify-content-space-evenly mb-4" style="display: flex; justify-content: space-between;">
  <button class="button is-info is-outlined is-medium" type="submit">詳細ページへ</button>
  <button class="button is-info is-outlined is-medium" type="submit">ホームへ</button>
</div>

  </main>
</body>

</html>
