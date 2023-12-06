<?php
require_once __DIR__ . '/../../repository/UserRepository.php';

class FuzzyFetchUserUseCase {
  public static function execute($keyword) {
    $repository = new UserRepository();
    $users = $repository->FuzzyFetchByName($keyword);
    return $users;
  }
}
?>
