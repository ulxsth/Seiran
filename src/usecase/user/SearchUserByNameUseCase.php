<?php
class SearchUserByNameUseCase {
  public static function execute($name) {
    $userRepository = new UserRepository();
    $userDTOList = $userRepository->FuzzyFetchByName($name);
    return $userDTOList;
  }
}
