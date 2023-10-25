<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>新規登録 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/auth/signin.css">
</head>

<body>
  <main>
    <!-- ここに内容 -->
    <h1>新規登録</h1>
    <p>ユーザーID</p>
    <input type="text" name="userID">

    <p>ユーザーネーム</p>
    <input type="text" name="username">

    <p>メールアドレス</p>
    <input type="text" name="mailaddress">

    <p>パスワード</p>
    <input type="text" name="password">

    <p>パスワード(確認)</p>
    <input type="text" name="password">

    <button type="submit">新規登録</button>
    <button type="login">もしくは<br>ログイン</button>
  </main>
</body>

</html>
