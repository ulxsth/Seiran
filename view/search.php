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
  
		<?php
for ($i = 0; $i < 2; $i++) {
    echo '<div class="columns">';
    for ($j = 0; $j < 2; $j++) {
        echo '<div class="column is-flex is-align-items-center">';
        echo '    <figure class="image is-64x64 mr-2">';
        echo '        <img class="is-rounded" src="../assets/img/anonimous.svg" alt="user icon">';
        echo '    </figure>';
        echo '    <div class="mt-4">';
        echo '        <p>user_id</p>';
        echo '        <p>introduce</p>';
        echo '    </div>';
        echo '    <button class="button is-primary px-6 ml-auto">フォロー</button>';
        echo '</div>';
    }
    echo '</div>';
}
?>


		<div class="mt-4">
			<h1>小説</h1>
		</div>

		<div class="columns is-flex-direction-row">
			<div class="column is-flex is-flex-direction-column">
					<figure class="image is-128x128">
							<img src="../assets/img/book/sample.png" alt="book image">
					</figure>
					<p>Book_name</p>
					<div class="mb-4">
						<figure class="image is-32x32">
							<img class="is-rounded" src="../assets/img/anonimous.svg" alt="user icon">	
						</figure>
						<p>test_user</p>
					</div>
					
					</div>
				</div>




  </main>
</body>

</html>
