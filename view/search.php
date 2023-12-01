<?php session_start();
require_once dirname(__DIR__, 2) . '/seiran/src/usecase/book/SearchBookByNameUseCase.php';
require_once dirname(__DIR__, 2) . '/seiran/src/usecase/user/SearchUserByNameUseCase.php';

$name = $_POST['keyword'];
$bookDTOList = SearchBookByNameUseCase::execute($name);
$userDTOList = SearchUserByNameUseCase::execute($name);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require('component/head.php'); ?>
  <title>検索 | Seiran</title>
</head>

<body>
  <?php require_once 'component/header.php'; ?>
  <main>
    <div class="">
      <h1>ユーザー</h1>
    </div>
  
		<div class="mx-2">

			<img src="../assets/img/anonimous.svg" alt="user icon">
			<p>user_id</p>
			<p>introduce</p>
			<div class="container has-text-right">フォロー</div>
		</div>


		<div class="mt-4">
			<h1>小説</h1>
		</div>

		<div></div>

  </main>
</body>

</html>
