<?php
session_start();

require_once dirname(__FILE__, 3) . "/src/repository/UserRepository.php";
$repository = new UserRepository();
$user = $repository->findById($_GET['id']);
?>

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

    <figure class="image is-128x128 mx-auto mb-1">
      <img class="is-rounded" src="/seiran/assets/img/anonimous.svg" alt="user_icon">
    </figure>

    <p class="has-text-weight-bold"><?php echo $user->getName() ?></p>
    <p class="has-text-grey">@<?php echo $user->getId() ?></p>

    <p class="my-5">再公開してログインしますか？</p>


    <button onclick="" type="submit" class="button is-primary">再公開してログインする</button>


    <button onclick="location.href = '/seiran/view/auth/login_id.php'" class="button is-link is-outlined ml-6">やめる</button>
    </div>


  </main>
</body>

</html>
