<?php
session_start();
require_once dirname(__DIR__, 2) . "/src/repository/UserRepository.php";
require_once dirname(__DIR__, 2) . "/src/usecase/book/RenderCarouselUseCase.php";
require_once dirname(__DIR__, 2) . "/src/usecase/follow/IsFolloweeUseCase.php";
require_once dirname(__DIR__, 2) . "/src/usecase/follow/GetFolloweeCountUseCase.php";
require_once dirname(__DIR__, 2) . "/src/usecase/follow/GetFollowerCountUseCase.php";


// ユーザ検索
$repository = new UserRepository();
$user = $repository->findById($_GET['id']);
if (is_null($user)) {
  header('Location: /seiran/view/error/404.php');
  exit;
}

// カルーセルのレンダリング
$repository = new BookRepository();
$books = $repository->fetchByUserId($user->getId());
$carousel = RenderCarouselUseCase::execute($books);

// フォローしているかどうか
$isFollowee = false;
if ($_SESSION["user"]["id"] != $_GET["id"]) {
  $isFollowee = IsFolloweeUseCase::execute($_SESSION["user"]["id"], $user->getId());
}

// フォロー数の取得
$followeeCount = GetFolloweeCountUseCase::execute($user->getId());
$followerCount = GetFollowerCountUseCase::execute($user->getId());
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <title>プロフィール | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/user/show.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main class="has-text-centered">
    <div class="columns is-4">
      <div class="left column has-text-left is-one-third">
        <figure class="image is-128x128 mb-5">
          <img class="is-rounded" src="/seiran/assets/img/user/<?php echo $user->getIconPath() ?>" alt="user-icon">
        </figure>
        <div class="mb-3">
          <h1><?php echo $user->getName() ?></h1>
          <p><?php echo '@' . $user->getId() ?></p>
        </div>
        <div class="mb-3"><?php echo $user->getDescription() ?></div>
        <p><span class="has-text-weight-bold">フォロー数:</span> <?php echo $followeeCount ?></p>
        <p><span class="has-text-weight-bold">フォロワー数:</span> <?php echo $followerCount ?></p>
        <?php if ($user->getId() == $_SESSION["user"]["id"]) : ?>
          <div class="mb-3">
            <a href="/seiran/view/user/edit.php?id=<?php echo $_SESSION["user"]["id"] ?>" class="has-text-grey is-size-5">
              <i class="fa-solid fa-gear"></i>
              <span>編集する</span>
            </a>
            <a class="has-text-danger" href="/seiran/src/usecase/user/LogOutUseCase.php">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
              <span>ログアウト</span>
            </a>
          </div>
        <?php else : ?>
          <?php if ($isFollowee) : ?>
            <form action="/seiran/src/usecase/follow/UnfollowUseCase.php" method="post">
              <input type="hidden" name="follower_id" value="<?php echo $_GET["id"] ?>">
              <button type="submit" class="button is-link is-outlined px-6 is-rounded">フォロー中</button>
            </form>
          <?php else : ?>
            <form action="/seiran/src/usecase/follow/FollowUseCase.php" method="post">
              <input type="hidden" name="follower_id" value="<?php echo $_GET["id"] ?>">
              <button type="submit" class="button is-primary px-6 is-rounded">フォロー</button>
            </form>
          <?php endif; ?>
        <?php endif; ?>
      </div>
      <div class="column is-8">
        <h1 class="has-text-centered">books</h1>
        <?php echo $carousel ?>
      </div>
    </div>
  </main>
  <?php require_once '../component/footer.php'; ?>
</body>

</html>
