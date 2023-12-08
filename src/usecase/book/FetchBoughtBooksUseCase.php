<?php
require_once __DIR__ . '/../../repository/BookRepository.php';

class FetchBoughtBooksUseCase {
  public static function execute($userId) {
    $repository = new BookRepository();
    $books = $repository->fetchBoughtBooks($userId, $includePrivate=true);
    return $books;
  }
}
?>
