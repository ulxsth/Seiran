<?php
session_start();
require_once dirname(__DIR__, 2) . "/repository/UserRepository.php";

// ユーザ検索
$repository = new UserRepository();
$user = $repository->findById($_POST['id']);
if (is_null($user)) {
  header('Location: /seiran/view/error/404.php');
  exit;
}
if ($user->getId() != $_SESSION["user"]["id"]) {
  header('Location: /seiran/view/error/403.php');
  exit;
}

// パスワードの更新
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$user->setPasswordHash($password_hash);
$repository->update($user);

// リダイレクト
header('Location: /seiran/view/user/edit.php?id=' . $user->getId());
?>
