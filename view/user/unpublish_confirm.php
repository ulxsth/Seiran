<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>非公開確認 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/user/unpublish_confirm.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main>
    <h1>非公開前確認</h1>

    <div class="control">
      <p>小説を非公開にします。よろしいですか？</p>
      <p class="tips">TIPS:非公開にした小説は、エディターの「下書き一覧」から再度投稿できます。</p>
    </div>

    <p>タイトル</p>
    <h2>ここにタイトル</h2>
    <div class="control">
      <button type="submit" class="button is-primary">非公開にする</button>
    </div>
  </main>
</body>

</html>
