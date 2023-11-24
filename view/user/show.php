<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <title>プロフィール | Seiran</title>
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main class="has-text-centered">
    <!-- ここに内容 -->
    <div class="columns is-multiline ml-6">
      <div class="column is-one-third">
        <figure class="image is-128x128 mb-5">
          <img src="https://via.placeholder.com/120x120" alt="user icon" class="image is-rounded is-132x118 ml-6">
        </figure>
        <div class="has-text-right mb-3">
          <h1>user_name</h1>
          <p class="has-text-right">@user_id</p>
        </div>
        <div class="has-text-left mb-3">ここに自己紹介ここに自己紹介ここに自己紹介ここに自己紹介ここに自己紹介ここに自己紹介ここに自己紹介ここに自己紹介ここに自己紹介ここに自己紹介ここに自己紹介ここに自己紹介ここに自己紹介</div>
        <div class="has-text-left mb-3">
          <form action="#" method="get" class="has-text-grey is-size-5">
            <i class="fa-solid fa-gear"></i>
            <span>編集する</span>
          </form>
          <form action="#" method="post" class="has-text-danger is-size-5">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>ログアウト</span>
          </form>
        </div>
        <button type="submit" class="button is-primary px-6 is-rounded">フォロー</button>
      </div>
      <div class="column is-one-third ml-6">
        <h1 class="has-text-centered">books</h1>
        <?php require_once '../component/carousel.php'; ?>
      </div>
    </div>

  </main>
  <?php require_once '../component/footer.php'; ?>
</body>

</html>
