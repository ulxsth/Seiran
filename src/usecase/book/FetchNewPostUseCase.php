<?php
require_once __DIR__ . '/../../repository/BookRepository.php';

class FetchNewPostUseCase{
  public static function execute() {
    $bookRepository = new BookRepository();
    $books = $bookRepository->fetchAll($sortedBy = 'registeredAt_desc');
    return $books;
  }
}
?>
