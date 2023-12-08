<?php
session_start();
require_once dirname(__DIR__, 2) . "/repository/UserRepository.php";

$icon = $_FILES['icon'];
if (!is_uploaded_file($icon['tmp_name'])) {
  $_SESSION['error_message'] = 'ファイルがアップロードされていません。';
  header('Location: /seiran/view/user/edit.php?id=' . $user->getId());
  exit;
}


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

$filename = uniqid() . '.' . pathinfo($icon['name'], PATHINFO_EXTENSION);
$path = '/assets/img/user/' . $filename;
move_uploaded_file($icon['tmp_name'], dirname(__DIR__, 3) . $path);
$user->setIconPath($filename);
$repository->update($user);

header('Location: /seiran/view/user/edit.php?id=' . $user->getId());
?>


