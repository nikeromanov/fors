(function () {
  function initVideoReviews() {
    if (typeof window.Swiper !== 'function') return;
    document.querySelectorAll('.js-reviews-video-slider').forEach(function (root) {
      const viewport = root.querySelector('.reviews-video-slider__viewport');
      if (!viewport || viewport.swiper) return;
      const controls = root.querySelector('.reviews-video-slider__controls');
      const prev = root.querySelector('.reviews-video-slider__prev');
      const next = root.querySelector('.reviews-video-slider__next');
      const counter = root.querySelector('.reviews-video-slider__counter');
      const slides = Array.from(viewport.querySelectorAll('.swiper-slide'));
      function update(swiper) {
        counter.textContent = (swiper.activeIndex + 1) + ' / ' + slides.length;
        slides.forEach(function (slide, index) {
          const active = index === swiper.activeIndex;
          slide.setAttribute('aria-hidden', String(!active));
          slide.querySelectorAll('a').forEach(function (link) { link.tabIndex = active ? 0 : -1; });
        });
      }
      new window.Swiper(viewport, {
        slidesPerView: 1,
        spaceBetween: 24,
        watchOverflow: true,
        speed: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 0 : 300,
        navigation: { prevEl: prev, nextEl: next },
        keyboard: { enabled: true, onlyInViewport: true },
        a11y: {
          prevSlideMessage: prev.getAttribute('aria-label'),
          nextSlideMessage: next.getAttribute('aria-label'),
          slideLabelMessage: '{{index}} / {{slidesLength}}',
        },
        on: { init: update, slideChange: update },
      });
      controls.hidden = slides.length < 2;
    });
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initVideoReviews);
  } else {
    initVideoReviews();
  }
  if (window.BX && typeof window.BX.addCustomEvent === 'function') {
    window.BX.addCustomEvent('onFrameDataReceived', initVideoReviews);
  }
})();
