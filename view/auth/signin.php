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
    <form action="#" method="POST">
      <div id="title">
        <h1>新規登録</h1>
      </div>

      <div class="control">
        <label for="id">ユーザーID</label>
        <input type="text" name="id" id="id">
      </div>

      <div class="control">
        <label for="name">ユーザーネーム</label>
        <input type="text" name="name" id="name">
      </div>

      <div class="control">
        <label for="email">メールアドレス</label>
        <input type="text" name="email" id="email">
      </div>

      <div class="control">
        <label for="password">パスワード</label>
        <input type="password" name="password" id="password">
      </div>

      <div class="control">
        <label for="password_confirm">パスワード(確認)</label>
        <input type="text" name="password_confirm" id="password_confirm">
      </div>

      <div class="control center">
        <button type="submit" id="btn-submit" class="btn button-submit">新規登録</button>
      </div>
      <div class="control right">
        <button type="login" id="btn-move_login" class="btn button-reset">ログイン画面へ</button>
      </div>
    </form>
  </main>
</body>

</html>
