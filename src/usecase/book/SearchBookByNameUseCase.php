<?php
class SearchBookByNameUseCase {
  public static function execute($name) {
    $bookRepository = new BookRepository();
    $bookDTOList = $bookRepository->FuzzyFetchByName($name);
    return $bookDTOList;
  }
}
?>
