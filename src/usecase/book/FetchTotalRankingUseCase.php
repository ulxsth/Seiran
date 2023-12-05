<?php
require_once __DIR__ . '/../../repository/BookRepository.php';

class FetchTotalRankingUseCase
{
  public static function execute() {
    $bookRepository = new BookRepository();
    $books = $bookRepository->fetchAll($limit = 3, $sortedBy = 'favCount_desc');
    return $books;
  }
}
?>
