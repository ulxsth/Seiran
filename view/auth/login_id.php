<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>検索 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/auth/login_id.css">
  <style>
    .right-align{
      margin-left: auto;
    }
  </style>
</head>

<body>
  <div class="gray-box">
      <div class="blue-box">
        <!-- ここにコンテンツを追加 -->
        <main>
          <!-- ここに内容 -->
          <h1>ログイン</h1>
          <p>ユーザーID</p>
          <input type="text" name="userID" id="">
          <p>パスワード</p>
          <input type="text" name="password" id="">
          <button type="submit">ログイン</button>
          <button type="login">もしくは<br>新規登録</button>
          <a href="login_email.php" class="right-align">メールアドレスでログインする</a>
        </main>
      </div>
    </div>
</body>

</html>
