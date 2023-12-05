<?php
require_once dirname(__FILE__, 3) . "/repository/BookRepository.php";

class RenderCarouselUseCase {
  public static function execute($books) {
    $html = '<div class="carousel-container">';
    $html .= '<div class="swiper">';
    $html .= '<div class="swiper-wrapper">';
    $count = 0;
    foreach ($books as $book) {
      if ($count >= 10) {
        break;
      }
      $html .= self::createCarouselItem($book);
      $count++;
    }
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="swiper-pagination"></div>';
    $html .= '<div class="swiper-button-prev"></div>';
    $html .= '<div class="swiper-button-next"></div>';
    $html .= '</div>';
    return $html;
  }

  private static function createCarouselItem($book) {
    $thumbnailPath = $book->getThumbnailPath() ?? 'sample.png';
    $url = "/seiran/assets/img/book/" . $thumbnailPath;
    $html = '<div class="swiper-slide">';
    $html .= '<a href="/seiran/view/book/show.php?id=' . $book->getId() . '">';
    $html .= '<img src="' . $url . '">';
    $html .= '</a>';
    $html .= '</div>';
    return $html;
  }
}
?>
