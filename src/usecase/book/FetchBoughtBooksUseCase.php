<?php
require_once __DIR__ . '/../../repository/BookRepository.php';

class FetchBoughtBooksUseCase {
  private $bookRepository;

  public function __construct() {
    $this->bookRepository = new BookRepository();
  }

  public function execute($userId) {
    $books = $this->bookRepository->fetchBoughtBooks($userId, $includePrivate=true);
    return $books;
  }
}
?>
