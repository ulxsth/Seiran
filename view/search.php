<?php /*session_start();
require_once dirname(__DIR__, 2) . '/seiran/src/usecase/book/SearchBookByNameUseCase.php';
require_once dirname(__DIR__, 2) . '/seiran/src/usecase/user/SearchUserByNameUseCase.php';

$name = $_POST['keyword'];
$bookDTOList = SearchBookByNameUseCase::execute($name);
$userDTOList = SearchUserByNameUseCase::execute($name); */
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
    <div class="mb-2">
      <h1>ユーザー</h1>
    </div>
  
		<div class="columns">

		<div class="column is-flex is-align-items-center">
        <figure class="image is-64x64 mr-2">
            <img class="is-rounded" src="../assets/img/anonimous.svg" alt="user icon">
        </figure>
        <div class="mt-4">
            <p>user_id</p>
            <p>introduce</p>
        </div>
        <button class="button is-primary px-6 ml-auto">フォロー</button>
    </div>
			
		<div class="column is-flex is-align-items-center">
        <figure class="image is-64x64 mr-2">
            <img class="is-rounded" src="../assets/img/anonimous.svg" alt="user icon">
        </figure>
        <div class="mt-4">
            <p>user_id</p>
            <p>introduce</p>
        </div>
        <button class="button is-primary px-6 ml-auto">フォロー</button>
    </div>

			</div>

			
		</div>

		<div class="columns">

		<div class="column is-flex is-align-items-center">
        <figure class="image is-64x64 mr-2">
            <img class="is-rounded" src="../assets/img/anonimous.svg" alt="user icon">
        </figure>
        <div class="mt-4">
            <p>user_id</p>
            <p>introduce</p>
        </div>
        <button class="button is-primary px-6 ml-auto">フォロー</button>
    </div>
			
		<div class="column is-flex is-align-items-center">
        <figure class="image is-64x64 mr-2">
            <img class="is-rounded" src="../assets/img/anonimous.svg" alt="user icon">
        </figure>
        <div class="mt-4">
            <p>user_id</p>
            <p>introduce</p>
        </div>
        <button class="button is-primary px-6 ml-auto">フォロー</button>
    </div>

			</div>

			
		</div>


		<div class="mt-4">
			<h1>小説</h1>
		</div>

		<div></div>

  </main>
</body>

</html>
