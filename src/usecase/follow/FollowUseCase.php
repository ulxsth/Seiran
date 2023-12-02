<?php
session_start();
require_once dirname(__DIR__, 3) . '/src/repository/FollowRepository.php';

$followerId = $_POST['follower_id'];
$followeeId = $_SESSION["user"]["id"];

$followRepository = new FollowRepository();
$followRepository->insert($followeeId, $followerId);
header('Location: /seiran/view/user/show.php?id=' . $followerId);
?>
