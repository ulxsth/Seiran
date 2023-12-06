<?php
session_start();
require_once dirname(__DIR__, 3) . '/src/repository/FollowRepository.php';

$followerId = $_POST['follower_id'];
$followeeId = $_SESSION["user"]["id"];

$followRepository = new FollowRepository();
$followRepository->insert($followeeId, $followerId);
if(isset($_SERVER['HTTP_REFERER'])) {
  header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
  header('Location: /seiran/view/user/show.php?id=' . $followerId);
}
?>
