<?php
require_once __DIR__ . '/../../repository/BookRepository.php';

class FetchTimelineUseCase {
  public static function execute($userId) {
    $bookRepository = new BookRepository();
    $books = $bookRepository->fetchByFollowedUserId($userId);
    return $books;
  }
}
?>
