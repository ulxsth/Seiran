<?php
require_once dirname(__DIR__, 2) . '/repository/PurchaseRepository.php';

class IsPurchasedBookUseCase {
  public static function execute() {
    $repository = new PurchaseRepository();
    return $repository->isPurchased($_SESSION['user']['id'], $_GET['id']);
  }
}
?>
