<?php
require_once __DIR__ . '/../../repository/FavoriteRepository.php';

class GetFavoriteCountUseCase {
  public static function execute($id) {
    $repository = new FavoriteRepository();
    return $repository->getCount($id);
  }
}
?>
