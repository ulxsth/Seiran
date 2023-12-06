<?php
require_once __DIR__ . '/../../repository/BookRepository.php';

class FuzzyFetchBookUseCase {
  public static function execute($keyword) {
    $repository = new BookRepository();
    $books = $repository->FuzzyFetchByName($keyword);
    return $books;
  }
}
?>
