<?php
require_once __DIR__ . '/../../repository/BookRepository.php';

class FetchCategoryRankingUseCase
{
  public static function execute($categoryId) {
    $bookRepository = new BookRepository();
    $books = $bookRepository->fetchByCategoryId($categoryId, $limit = 1, $sortedBy = 'favCount_desc');
    return $books;
  }
}
?>
