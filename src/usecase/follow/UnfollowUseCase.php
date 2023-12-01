<?php
session_start();
require_once dirname(__DIR__, 3) . '/src/repository/FollowRepository.php';
require_once dirname(__DIR__, 3) . '/src/dto/FollowDTO.php';

$followerId = $_POST['follower_id'];
$followeeId = $_SESSION["user"]["id"];

$followRepository = new FollowRepository();
$followRepository->delete(new FollowDTO($followeeId, $followerId));
header('Location: /seiran/view/user/show.php?id=' . $followerId);
?>
