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

// メールアドレスの更新
$user->setEmail($_POST["address"]);
$repository->update($user);

// リダイレクト
header('Location: /seiran/view/user/edit.php?id=' . $user->getId());
?>
