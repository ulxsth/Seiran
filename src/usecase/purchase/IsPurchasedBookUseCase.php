<?php
require_once dirname(__DIR__, 2) . '/repository/PurchaseRepository.php';

class IsPurchasedBookUseCase {
  public static function execute($userId, $bookId) {
    $repository = new PurchaseRepository();
    return $repository->isPurchased($userId, $bookId);
  }
}
?>
