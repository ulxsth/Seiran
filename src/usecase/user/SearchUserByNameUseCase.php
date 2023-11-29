<?php
require_once dirname(__DIR__, 3) . '/src/repository/UserRepository.php';

class SearchUserByNameUseCase {
  public static function execute($name) {
    $userRepository = new UserRepository();
    $userDTOList = $userRepository->FuzzyFetchByName($name);
    return $userDTOList;
  }
}
