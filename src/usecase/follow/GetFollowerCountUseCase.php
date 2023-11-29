<?php
require_once dirname(__DIR__, 3) . '/src/repository/FollowRepository.php';

class GetFollowerCountUseCase
{
  public static function execute($userId)
  {
    $followRepository = new FollowRepository();
    return $followRepository->getFollowerCount($userId);
  }
}
