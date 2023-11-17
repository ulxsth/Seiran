<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アカウント再公開 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
</head>

<body>
  <main class="has-text-centered">
    <div id="title"><h1>重要なお知らせ</h1></div>

    <div id="login-message"><p>あなたがログインしようとしているアカウントは、非公開になっています。</p></div>
    <div id="login-question"><p>再公開してログインしますか？</p></div>

    <figure class="image is-128x128 mx-auto mb-6">
        <img src="/seiran/assets/img/anonimous.svg" alt="user_icon">
    </figure>


	<div class="login">
	<button type="submit" class="button is-primary">再公開して<br>ログインする</button>
	</div>
	
    <div class="close">
	<button type="submit" class="button is-link">やめる</button>
	</div>
        

  </main>
</body>

</html>
