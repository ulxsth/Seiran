<?php
require_once dirname(__DIR__, 3) . '/src/repository/BookRepository.php';

class SearchBookByNameUseCase {
  public static function execute($name) {
    $bookRepository = new BookRepository();
    $bookDTOList = $bookRepository->FuzzyFetchByName($name);
    return $bookDTOList;
  }
}
?>
