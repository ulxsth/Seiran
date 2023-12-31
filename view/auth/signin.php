<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規登録 | Seiran</title>
  <?php require_once '../component/head.php'; ?>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/auth/signin.css">
</head>

<body>
  <main>
    <!-- ここに内容 -->
    <form action="/seiran/src/usecase/auth/SignupUseCase.php" method="POST">
      <div class="mb-6">
        <h1>新規登録</h1>
      </div>

      <div class="field">
        <label for="id">ユーザーID</label>
        <input class="input" type="text" required name="id" id="id">
      </div>

      <div class="field">
        <label for="name">ユーザーネーム</label>
        <input class="input" type="text" required name="name" id="name">
      </div>

      <div class="field">
        <label for="email">メールアドレス</label>
        <input class="input" type="text" required name="email" id="email">
      </div>

      <div class="field">
    <label for="password">パスワード</label>
    <input class="input" type="password" required name="password" id="password" oninput="validatePassword()" />
    <span id="passwordError" style="color: red;"></span>
</div>

<div class="field">
    <label for="password_confirm">パスワード(確認)</label>
    <input class="input" type="password" required name="password_confirm" id="password_confirm" oninput="validatePasswordConfirm()" />
    <span id="passwordConfirmError" style="color: red;"></span>
</div>

      <div class="center">
        <button type="submit" class="button is-primary">新規登録</button>
      </div>
    </form>

    <div class="right">
      <button type="login" onclick="location.href='login_id.php'" class="button is-link is-outlined">ログイン画面へ</button>
    </div>
  </main>
  <script src="../../js/auth/signin.js"></script>
</body>

</html>
