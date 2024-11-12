(function ($) {
  // Definir variables para los puntos de quiebre (breakpoints) y configuraciones
  const breakpoints = {
    mobile: 640,
    tablet: 768,
    desktop: 1024,
  };

  const slidesPerViewConfig = {
    mobile: 1.1, // Mostrar una tarjeta completa y parte de la siguiente en móvil
    tablet: 2.2,
    desktop: 3,
  };

  const spaceBetweenConfig = {
    mobile: 16,
    tablet: 24,
    desktop: 32,
  };

  // Inicializar el slider de Blog
  function initSliderSwiper() {
    const sliderSwiperContainer = document.querySelector(
      ".swiper-container-slider"
    );

    if (sliderSwiperContainer) {
      // Destruir cualquier instancia anterior de Swiper si existe
      if (window.sliderSwiper) {
        window.sliderSwiper.destroy(true, true);
      }

      // Configuración del slider de Blog
      window.sliderSwiper = new Swiper(sliderSwiperContainer, {
        direction: "horizontal",
        loop: false,
        slidesPerView: slidesPerViewConfig.mobile,
        spaceBetween: spaceBetweenConfig.mobile,
        pagination: {
          el: ".swiper-pagination-slider",
          clickable: true,
        },
        allowTouchMove: true,
        breakpoints: {
          [breakpoints.mobile]: {
            slidesPerView: slidesPerViewConfig.mobile,
            spaceBetween: spaceBetweenConfig.mobile,
          },
          [breakpoints.tablet]: {
            slidesPerView: slidesPerViewConfig.tablet,
            spaceBetween: spaceBetweenConfig.tablet,
          },
          [breakpoints.desktop]: {
            slidesPerView: (function () {
              const slideCount = $(sliderSwiperContainer).find(
                ".swiper-slide"
              ).length;
              return slideCount <= 3 ? slideCount : slidesPerViewConfig.desktop;
            })(),
            spaceBetween: spaceBetweenConfig.desktop,
            allowTouchMove: (function () {
              const slideCount = $(sliderSwiperContainer).find(
                ".swiper-slide"
              ).length;
              return slideCount > 3; // Desactiva swipe si hay 3 o menos
            })(),
          },
        },
      });
    }
  }

  // Inicializar el slider de Hero
  function initHeroSwiper() {
    const heroSwiperContainer = document.querySelector(
      ".swiper-container-hero"
    );

    if (heroSwiperContainer) {
      // Destruir cualquier instancia anterior de Swiper si existe
      if (window.heroSwiper) {
        window.heroSwiper.destroy(true, true);
      }

      // Configuración del slider de Hero
      window.heroSwiper = new Swiper(heroSwiperContainer, {
        direction: "horizontal",
        loop: true,
        slidesPerView: 1,
        spaceBetween: 0,
        pagination: {
          el: ".swiper-pagination-hero",
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    }
  }

  // Ejecutar ambas funciones al cargar y redimensionar la página
  $(window).on("load resize", function () {
    initSliderSwiper();
    initHeroSwiper();
  });
})(jQuery);
