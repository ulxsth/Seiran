<?php
require_once dirname(__FILE__, 2) . "/repository/UserRepository.php";
$repository = new UserRepository();

// バリデーション
// ユーザーIDが既に存在するか
$user = $repository->findById($_POST['id']);
if($user != null) {
  // TODO: エラーメッセージを表示
  header("Location: /seiran/view/auth/signup.php");
}

// メールアドレスが既に存在するか
$user = $repository->findByEmail($_POST['email']);
if ($user != null) {
  // TODO: エラーメッセージを表示
  header("Location: /seiran/view/auth/signup.php");
}

// 登録処理
$repository->insert($_POST['id'], $_POST['name'], $_POST['email'], $_POST['password']);

// ログイン処理
// TODO: LoginUseCaseに移譲

// ホーム画面に遷移
header("Location: /seiran/view/book/info.php");
?>
