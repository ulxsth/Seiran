<?php
class FetchAllUserUseCase {
  public static function execute() {
    require_once __DIR__ . '/../../repository/UserRepository.php';
    $userRepository = new UserRepository();
    $users = $userRepository->fetchAll();
    return $users;
  }
}
?>
