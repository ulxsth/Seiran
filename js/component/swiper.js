const swiper = new Swiper(".swiper", {

  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },

  navigation: {
    prevEl: '.swiper-button-prev',
    nextEl: '.swiper-button-next',
  },

  slidesPerView: 3,
  loop: true,
  centeredSlides: true,
  spaceBetween: 10,
});
