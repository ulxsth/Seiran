<?php
require_once __DIR__ . '/../../repository/CategoryRepository.php';

class FetchAllCategoryUseCase {
  public static function execute() {
    $categoryRepository = new CategoryRepository();
    $categories = $categoryRepository->fetchAll();
    return $categories;
  }
}
?>
