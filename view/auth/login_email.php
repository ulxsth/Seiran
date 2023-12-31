<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/auth/login.css">
</head>

<body>
  <main class="section">
    <h1 class="title">ログイン</h1>

    <?php
  // エラーメッセージがセッションにあるか確認
  if (isset($_SESSION['error_message'])) {
    // エラーメッセージを表示
    echo '<p id="error">' . $_SESSION['error_message'] . '</p>';
    
    // エラーメッセージをセッションから削除
    unset($_SESSION['error_message']);
  }
  ?>

    <form action="../../src/usecase/auth/LoginWithEmailUseCase.php" method="post">
      <div class="field">
        <label class="label" for="email">メールアドレス</label>
        <input class="input" type="text" required name="email">
        <div class="right">
          <a href="login_id.php">IDでログインする</a>
        </div>
      </div>


      <div class="field">
        <label class="label" for="password">パスワード</label>
        <input class="input" type="password" required name="password">
      </div>

      <div class="field">
        <button type="submit" class="button is-primary">ログイン</button>
      </div>
    </form>


    <div class="pb-6">
      <button type="login" onclick="location.href='./signin.php'" class="button-signin button is-link is-outlined is-pulled-right">
        <span class="is-size-7">もしくは</span>
        <span>新規登録</span>
      </button>
    </div>
  </main>
</body>

</html>
