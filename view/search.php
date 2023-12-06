<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>検索 | Seiran</title>
	<?php require_once 'component/head.php'; ?>
	<link rel="stylesheet" href="/seiran/css/app.css">
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

		<?php
		for ($i = 0; $i < 2; $i++) {
			echo '<div class="columns is-flex is-flex-direction-row is-justify-content-space-around">';
			for ($j = 0; $j < 4; $j++) {
				echo '<article class="column is-one-fifth is-flex is-flex-direction-column">';
				echo '<div class="image-container" style="position: relative;">';
				echo '<figure class="image is-4by5">';
				echo '<img src="../assets/img/book/sample.png" alt="book image">';
				echo '</figure>';
				echo '<button style="position: absolute; bottom: 0; right: 0; border:none">';
				echo '<img src="../assets/img/bookmark.svg" class="image is-32x32" alt="bookmark icon">';
				echo '</button>';
				echo '</div>';
				echo '<p class="is-size-5 is-italic">Book_name</p>';
				echo '<div class="mb-4 is-flex is-flex-direction-row">';
				echo '<figure class="image is-32x32">';
				echo '<img class="is-rounded" src="../assets/img/anonimous.svg" alt="user icon">  ';
				echo '</figure>';
				echo '<p class="mt-1">test_user</p>';
				echo '</div>';
				echo '</article>';
			}
			echo '</div>';
		}
		?>


	</main>
</body>

</html>
