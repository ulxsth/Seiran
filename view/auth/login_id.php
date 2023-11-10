<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>検索 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/auth/login_id.css">
</head>

<body>
  <main>
    <h1>ログイン</h1>

    <form method="#" action="post">
      <div class="control">
        <label for="user_id">ユーザーID</label>
        <input type="text" name="user_id">
        <div class="right">
          <a href="login_email.php">メールアドレスでログインする</a>
        </div>
      </div>


      <div class="control">
        <label for="password">パスワード</label>
        <input type="password" name="password">
      </div>
    </form>

    <div class="control">
      <button type="submit" class="btn button-submit">ログイン</button>
    </div>

    <div class="control right">
      <button type="login" class="btn button-reset">もしくは<br>新規登録</button>
    </div>
  </main>
</body>

</html>
