<?php
class GetFavoriteCountUseCase {
  public static function execute() {
    $repository = new FavoriteRepository();
    return $repository->getCount($_GET['id']);
  }
}
?>
