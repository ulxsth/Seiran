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
  <input class="text" type="text" name="name" >
  <button class="button is-small is-primary is-rounded">変更</button>
  <p>mail_address</p>
  <input class="text" type="text" name="address" >
  <button class="button is-small is-primary is-rounded">変更</button>
  <p>password</p>
  <input class="text" type="password" name="password" >
  <button class="button is-small is-primary is-rounded">変更</button>
  <br>
  <a href="#" class="taikai">退会する</a>
  </div>
</main>
</body>

</html>
