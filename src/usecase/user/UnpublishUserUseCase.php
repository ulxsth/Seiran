<?php
session_start();

require_once dirname(__DIR__, 3) . '/src/repository/UserRepository.php';

if ($_SESSION["user"]["id"] != $_GET["id"]) {
  header('Location: /seiran/view/error/403.php');
  exit;
}

$userRepository = new UserRepository();
$user = $userRepository->findById($_GET["id"]);
if (!$user) {
  header('Location: /seiran/view/error/404.php');
  exit;
}
$user->setIsPublic(false);
$userRepository->update($user);
header('Location: /seiran/view/user/unpublish_completed.php');
?>
