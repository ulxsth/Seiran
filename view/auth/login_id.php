<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>検索 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/auth/login_id.css">
</head>

<body>
  <div class="gray-box">
    <div class="blue-box">
    <!-- ここにコンテンツを追加 -->
      <main>
        <!-- ここに内容 -->
        <h1>ログイン</h1>
        <form action="post">
          <p>ユーザーID</p>
          <input type="text" name="userID" id="">
          <div class="right-align">
            <a href="login_email.php">メールアドレスでログインする</a>
          </div>
          <p>パスワード</p>
          <input type="text" name="password" id="">
        </form>
        <button type="submit">ログイン</button>
        <button type="login">もしくは<br>新規登録</button>
        
      </main>
    </div>
  </div>
</body>

</html>
