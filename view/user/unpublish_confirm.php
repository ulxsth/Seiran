<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>非公開確認 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main>
    <h1 class="mb-3">非公開前確認</h1>

    <div>
      <p>ユーザーを非公開にします。よろしいですか？</p>
      <p class="has-text-danger mt-1">WARNING: 非公開にしたアカウントの小説は、サービス上から表示できなくなります！！</p>
    </div>
    <div class="control">
      <a href="/seiran/src/usecase/user/UnpublishUserUseCase.php?id=<?php echo $_SESSION["user"]["id"] ?>" type="submit" class="button is-primary">非公開にする</a>
    </div>
  </main>
</body>

</html>
