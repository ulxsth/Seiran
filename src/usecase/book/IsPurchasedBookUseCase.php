<?php
session_start();
require_once dirname(__DIR__, 3) . '/repository/PurchaseRepository.php';

class IsPurchasedBookUseCase {
  public static function execute() {
    $repository = new PurchaseRepository();
    return $repository->isPurchased($_SESSION['user_id'], $_GET['id']);
  }
}
?>
