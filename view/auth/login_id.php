<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>検索 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/auth/login.css">
</head>

<body>
  <main class="section">
    <h1 class="mb-4">ログイン</h1>

    <form method="/seiran/src/usecase/LoginWithIdUseCase.php" action="post">
      <div class="field">
        <label for="user_id">ユーザーID</label>
        <input class="input" type="text" name="user_id">
        <div class="right">
          <a href="login_email.php">メールアドレスでログインする</a>
        </div>
      </div>


      <div class="field">
        <label for="password">パスワード</label>
        <input class="input" type="password" name="password">
      </div>

      <div class="field">
        <button type="submit" class="button is-primary">ログイン</button>
      </div>
    </form>

    <div class="pb-6">
      <button type="login" class="button-signin button is-link is-outlined is-pulled-right">
        <span class="is-size-7">もしくは</span>
        <span>新規登録</span>
      </button>
    </div>
  </main>
</body>

</html>
