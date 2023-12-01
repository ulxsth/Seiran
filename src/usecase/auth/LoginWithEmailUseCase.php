<?php
session_start();

const ERR_FAILED = "メールアドレスまたはパスワードが間違っています。";

require_once dirname(__FILE__, 3) . "/repository/UserRepository.php";

$repository = new UserRepository();

// ユーザーが存在するか検索
$user = $repository->findById($_POST['id']);
if ($user == null || !password_verify($_POST['password'], $user->getPasswordHash())) {
  // TODO: エラーメッセージを表示
  header("Location: /seiran/view/auth/login_id.php");
}

// ログイン処理
$user->setPasswordHash($_POST["password"]);
$_SESSION["user"] = [
  "id" => $user->getId(),
  "name" => $user->getName(),
  "email" => $user->getEmail(),
  "password_hash" => $user->getPasswordHash(),
  "registered_at" => $user->getRegisteredAt(),
  "is_public" => $user->getIsPublic(),
  "description" => $user->getDescription()
];

// ホーム画面に遷移
header("Location: /seiran/view/book/info.php");
?>
