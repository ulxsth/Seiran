<?php
const PASSWORD = "seiran";

if(!isset($_POST["password"])) {
  header('Location: /seiran/view/admin/login.php');
  exit;
}

if($_POST["password"] != PASSWORD) {
  header('Location: /seiran/view/admin/login.php');
  exit;
}

session_start();
$_SESSION["user"]["isAdmin"] = true;
header('Location: /seiran/view/admin/dashboard.php');
?>
