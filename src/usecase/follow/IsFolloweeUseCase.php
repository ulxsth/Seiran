<?php
require_once dirname(__DIR__, 3) . '/src/repository/FollowRepository.php';
require_once dirname(__DIR__, 3) . '/src/dto/FollowDTO.php';

class IsFolloweeUseCase {
  public static function execute($followeeId, $followerId) {
    $followerRepository = new FollowRepository();
    return $followerRepository->isExist(new FollowDTO($followeeId, $followerId));
  }
}
?>
