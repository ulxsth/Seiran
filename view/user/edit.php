<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <title>プロフィール編集 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/user/edit.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
<main>
  <div>
  <p>user_name</p>
  <input class="text" type="text" name="" >
  <button class="button is-primary">変更</button>
  <p>mail_address</p>
  <input class="text" type="text" name="" >
  <button class="button is-primary">変更</button>
  <p>password</p>
  <input class="text" type="password" name="" >
  <button class="button is-primary">変更</button>
  </div>
</main>
</body>

</html>
