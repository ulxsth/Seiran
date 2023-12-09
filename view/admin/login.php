<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理者ログイン | Seiran</title>
  <?php require_once '../component/head.php'; ?>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/book/confirm_publish.css">
</head>

<body>
  <main class="has-text-centered">
    <h1>管理者ログイン</h1>
    <form action="/seiran/src/usecase/admin/LoginAdminUseCase.php" method="POST">
      <div class="field">
        <label class="label">パスワード</label>
        <div class="control">
          <input name="password" class="input" type="password" placeholder="パスワードを入力">
        </div>
      </div>
      <div class="field">
        <div class="control">
          <button type="submit" class="button is-primary">ログイン</button>
        </div>
      </div>
  </main>
</body>

</html>
