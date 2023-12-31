<?php
session_start();

const ERR_FAILED = "ユーザーIDまたはパスワードが間違っています。";

require_once dirname(__FILE__, 3) . "/repository/UserRepository.php";

$repository = new UserRepository();

// ユーザーが存在するか検索
$user = $repository->findById($_POST['id'], true);
if ($user == null || !password_verify($_POST['password'], $user->getPasswordHash())) {
  // TODO: エラーメッセージを表示
  $_SESSION['error_message'] = ERR_FAILED;
  header("Location: /seiran/view/auth/login_id.php");
  exit;
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
  "description" => $user->getDescription(),
  "icon_path" => $user->getIconPath(),
];

// 非公開アカウントの場合は公開画面へ
if (!$user->getIsPublic()) {
  header("Location: /seiran/view/user/republish_confirm.php?id=" . $user->getId());
  return;
}

// ホーム画面に遷移
header("Location: /seiran/view/book/info.php");
?>
