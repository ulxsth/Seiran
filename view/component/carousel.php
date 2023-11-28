<div class="carousel-container">
  <div class="swiper">
    <div class="swiper-wrapper">
      <?php
      for ($i = 0; $i < 9; $i++) {
        require __DIR__ . '/carousel_item.php';
      }
      ?>
    </div>
  </div>
  <div class="swiper-pagination"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
</div>
