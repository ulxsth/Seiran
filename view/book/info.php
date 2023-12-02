<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ホーム | Seiran</title>
  <?php require_once '../component/head.php'; ?>
  <link rel="stylesheet" href="/seiran/css/app.css">
  <link rel="stylesheet" href="/seiran/css/book/info.css">
</head>

<body>
<?php require_once '../component/header.php'; ?>
  <main>
    <p class="dai">タイムライン</p>
    <p class="dai">総合ランキング</p>
    <div class="flex">
    <figure class="image"><img src="" alt=""></figure>
    <div class="right">
    <p class="title">ここにタイトル</p>
    <p class="subtitle">これはサブタイトルです</p>
    <p class="text">これは物語の概要です。</p>
    </div>
    </div>
    <p class="dai">カテゴリ別ランキング</p>
    <p class="">推理</p>
    <p class="">恋愛</p>
    <p class="">コメディ</p>
    <p class="dai">新着投稿</p>
  </main>
</body>

</html>