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
        <figure class="image is-128x128">
          <img src="https://via.placeholder.com/132x118" alt="user icon" class="image is-rounded is-132x118 ml-6">
        </figure>
        <div class="">
          user_name
        </div>
        <div class="">
          @user_id
        </div>
        <div class="">
          ここに自己紹介を書きます
        </div>
        <a href="/seiran/assets/img/gire.svg" target="_blank" rel="noopener noreferrer" class="is-flex is-align-items-center ml-6" style="text-decoration: none;">
          <img src="/seiran/assets/img/gire.svg" alt="user icon" class="image is-50x50 mr-2">
          <div class="has-text-grey is-size-5">編集する</div>
        </a>
        <a href="/seiran/assets/img/gire.svg" target="_blank" rel="noopener noreferrer" class="is-flex is-align-items-center ml-6" style="text-decoration: none;">
          <img src="/seiran/assets/img/logout.svg" alt="user icon" class="image is-50x50 mr-2">
          <div class="has-text-danger is-size-5">ログアウト</div>
        </a>
      </div>
      <div class="column is-one-third ml-6">
        <h1 class="has-text-centered">books</h1>
      <?php require_once '../component/carousel.php'; ?>
      </div>
    </div>

  </main>
  <?php require_once '../component/footer.php';?>
</body>

</html>