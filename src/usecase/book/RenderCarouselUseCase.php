<?php
require_once dirname(__FILE__, 3) . "/repository/BookRepository.php";

class RenderCarouselUseCase {
  public function execute($books) {
    $html = '<div class="carousel-container">';
    $html .= '<div class="swiper">';
    $html .= '<div class="swiper-wrapper">';
    foreach ($books as $book) {
      $html .= $this->createCarouselItem($book);
    }
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="swiper-pagination"></div>';
    $html .= '<div class="swiper-button-prev"></div>';
    $html .= '<div class="swiper-button-next"></div>';
    $html .= '</div>';
    return $html;
  }

  private function createCarouselItem($book) {
    $url = dirname(__DIR__, 4) . "/assets/img/book/" . $book->getThumbnailPath();
    $html = '<div class="swiper-slide">';
    $html = '<img src="' . $url . '">';
    $html .= '</div>';
    return $html;
  }
}
?>
