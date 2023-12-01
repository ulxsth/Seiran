<?php
session_start();
require_once dirname(__DIR__, 2) . "/src/repository/UserRepository.php";

$repository = new UserRepository();
$user = $repository->findById($_GET['id']);
if (is_null($user)) {
  header('Location: /seiran/view/error/404.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once '../component/head.php'; ?>
  <title>プロフィール編集 | Seiran</title>
  <link rel="stylesheet" href="/seiran/css/app.css">
</head>

<body>
  <?php require_once '../component/header.php'; ?>
  <main class="has-text-center">
    <div class="content">
      <form action="/seiran/src/usecase/user/UpdateUserNameUseCase.php" method="post" class="is-full">
        <div class="columns is-flex">
          <div class="column"><label>ユーザー名</label></div>
          <div class="column"><input class="input" type="text" name="name" value="<?php echo $user->getName(); ?>"></div>
          <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
          <div class="column"><button class="button is-small is-primary is-rounded">変更</button></div>
        </div>
      </form>

      <form action="/seiran/src/usecase/user/UpdateUserEmailUseCase.php" method="post" class="is-full">
        <div class="columns is-flex">
          <div class="column"><label>メールアドレス</label></div>
          <div class="column"><input class="input" type="text" name="address" value="<?php echo $user->getEmail(); ?>"></div>
          <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
          <div class="column"><button class="button is-small is-primary is-rounded">変更</button></div>
        </div>
      </form>

      <form action="/seiran/src/usecase/user/UpdateUserPasswordUseCase.php" method="post" class="is-full">
        <div class="columns is-flex">
          <div class="column"><label>パスワード</label></div>
          <div class="column"><input class="input" type="password" name="password"></div>
          <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
          <div class="column"><button class="button is-small is-primary is-rounded">変更</button></div>
        </div>
      </form>

      <div class="is-flex is-justify-content-center mt-6">
        <a class="has-text-danger">退会する</a>
      </div>
    </div>
  </main>
</body>

</html>
