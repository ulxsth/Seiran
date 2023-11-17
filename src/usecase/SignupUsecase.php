<?php
require_once dirname(__FILE__, 2) . "/repository/UserRepository.php";
$repository = new UserRepository();

// バリデーション
// ユーザーIDが既に存在するか
$user = $repository->findById($id);
if($user != null) {
  // TODO: エラーメッセージを表示
  header("Location: /seiran/view/auth/signup.php");
}

// メールアドレスが既に存在するか
$user = $repository->findByEmail($email);
if ($user != null) {
  // TODO: エラーメッセージを表示
  header("Location: /seiran/view/auth/signup.php");
}

// 登録処理
$repository->insert($id, $name, $email, $password);

// ホーム画面に遷移
header("Location: /seiran/view/book/info.php");
?>
