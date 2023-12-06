<?php
session_start();
require_once '../src/usecase/book/FuzzyFetchBookUseCase.php';
require_once '../src/usecase/user/FuzzyFetchUserUseCase.php';
require_once '../src/usecase/favorite/GetFavoriteCountUseCase.php';

$keyword = $_POST['keyword'];
$books = FuzzyFetchBookUseCase::execute($keyword);
$users = FuzzyFetchUserUseCase::execute($keyword);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>検索 | Seiran</title>
	<?php require_once 'component/head.php'; ?>
	<link rel="stylesheet" href="/seiran/css/app.css">
	<link rel="stylesheet" href="/seiran/css/search.css">
</head>

<body>
	<?php require_once 'component/header.php'; ?>
	<main>
		<div class="searched-user">
			<div class="mb-2">
				<h1>ユーザー</h1>
			</div>
			<?php foreach ($users as $user) : ?>
				<div class="columns">
					<div class="column is-flex is-align-items-center">
						<figure class="image is-64x64 mr-2">
							<img class="is-rounded" src="../assets/img/user/<?php echo $user->getIconPath() ?>" alt="user icon">
						</figure>
						<div class="mt-4">
							<p>
								<?php echo $user->getName(); ?>
								<span class="ml-2 has-text-grey-light">（@<?php echo $user->getId(); ?>）</span>
							</p>
							<p><?php echo $user->getDescription(); ?></p>
						</div>
						<button class="button is-primary px-6 ml-auto">フォロー</button>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<div class="searched-books">
			<div class="mt-4">
				<h1>小説</h1>
			</div>
			<?php if (count($books) === 0) : ?>
				<p>見つかりませんでした</p>
			<?php endif; ?>
			<?php for ($i = 0; $i < count($books); $i++) : ?>
				<?php if ($i % 4 === 0) : ?>
					<div class="columns is-flex is-flex-direction-row">
					<?php endif; ?>

					<article class="searched-book column is-one-fifth is-flex is-flex-direction-column">
						<div class="searched-book__display">
							<figure class="image searched-book__thumbnail is-3by4">
								<a href="/seiran/view/book/show.php?id=<?php echo $books[$i]->getId() ?>">
									<img src="../assets/img/book/<?php echo $books[$i]->getThumbnailPath() ?>" alt="book image">
								</a>
							</figure>
							<div class="searched-book__favorite-display">
								<i class="fa-solid fa-heart has-text-danger"></i>
								<span><?php echo GetFavoriteCountUseCase::execute($books[$i]->getId()); ?></span>
							</div>
						</div>
						<a href="/seiran/view/book/show.php?id=<?php echo $books[$i]->getId() ?>" class="has-text-black is-size-5 is-italic">
							<?php echo $books[$i]->getName(); ?>
						</a>
						<div class="mb-4 is-flex is-flex-direction-row">
							<figure class="image is-32x32">
								<img class="is-rounded" src="../assets/img/user/anonymous.svg" alt="user icon">
							</figure>
							<p class="ml-2"><?php echo $books[$i]->getUserId(); ?></p>
						</div>
					</article>

					<?php if (($i + 1) % 4 === 0 || $i === count($books) - 1) : ?>
					</div>
				<?php endif; ?>
			<?php endfor; ?>
		</div>
	</main>
</body>

</html>
