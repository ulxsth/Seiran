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
    <h1 class="mb-3">重要なお知らせ</h1>

    <p class="mb-3">あなたがログインしようとしているアカウントは、非公開になっています。</p>
    

    <figure class="image is-128x128 mx-auto mb-6">
        <img src="/seiran/assets/img/anonimous.svg" alt="user_icon">
    </figure>

    <p class="my-6">再公開してログインしますか？</p>

	<div class="control">
	<button type="submit" class="button is-primary">再公開して<br>ログインする</button>
	</div>
	
    <div class="control">
	<button type="submit" class="button is-link">やめる</button>
	</div>
        

  </main>
</body>

</html>
