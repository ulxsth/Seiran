<?php
require_once dirname(__DIR__, 2) . '/repository/FavoriteRepository.php';

class IsFavoriteBookUseCase {
  public static function execute() {
    $repository = new FavoriteRepository();
    return $repository->isExist($_SESSION['user']['id'], $_GET['id']);
  }
}
?>
