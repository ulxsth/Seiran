<?php
class GetFavoriteCountUseCase {
  public static function execute($id) {
    $repository = new FavoriteRepository();
    return $repository->getCount($id);
  }
}
?>
