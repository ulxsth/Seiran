<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <title>プロフィール編集 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main class="has-text-center">
    <div class="content">
      <form action="#" method="post" class="is-full">
        <div class="columns is-flex">
          <div class="column"><label>user_name</label></div>
          <div class="column"><input class="input" type="text" name="name"></div>
          <div class="column"><button class="button is-small is-primary is-rounded">変更</button></div>
        </div>
      </form>

      <form action="#" method="post" class="is-full">
        <div class="columns is-flex">
          <div class="column"><label>mail_address</lab>
          </div>
          <div class="column"><input class="input" type="text" name="address"></div>
          <div class="column"><button class="button is-small is-primary is-rounded">変更</button></div>
        </div>
      </form>

      <form action="#" method="post" class="is-full">
        <div class="columns is-flex">
          <div class="column"><label>password</label></div>
          <div class="column"><input class="input" type="password" name="password"></div>
          <div class="column"><button class="button is-small is-primary is-rounded">変更</button></div>
        </div>
      </form>

      <div class="is-flex is-justify-content-center mt-6">
        <a class="has-text-danger">退会する</a>
      </div>
    </div>
  </main>
</body>

</html>
