<?php
session_start();
require_once dirname(__FILE__, 3) . "/repository/UserRepository.php";

$current_user = $_SESSION["user"]["id"];
if($current_user == null || $current_user != $_GET["id"]){
  header("Location: /seiran/view/error/403.php");
  return;
}

$repository = new UserRepository();
$user = $repository->findById($_GET["id"]);
$user->setIsPublic(true);
$repository->update($user);

header("Location: /seiran/view/book/info.php");
?>
