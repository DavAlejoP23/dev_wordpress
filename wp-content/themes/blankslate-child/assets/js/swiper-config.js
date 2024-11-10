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

  function initSwiper() {
    // Destruir cualquier instancia anterior de Swiper si existe
    if (window.mySwiper) {
      window.mySwiper.destroy(true, true);
    }

    // Seleccionar el contenedor principal de Swiper
    const swiperContainer = document.querySelector(".swiper-container");

    // Configuración de Swiper
    window.mySwiper = new Swiper(swiperContainer, {
      direction: "horizontal",
      loop: false, // Sin bucle
      slidesPerView: slidesPerViewConfig.mobile, // Valor inicial en móvil
      spaceBetween: spaceBetweenConfig.mobile, // Espacio inicial en móvil
      pagination: {
        clickable: true,
      },
      allowTouchMove: true, // Desactivar swipe si hay 3 o menos en desktop
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
            const slideCount = $(swiperContainer).find(".swiper-slide").length;
            return slideCount <= 3 ? slideCount : slidesPerViewConfig.desktop;
          })(),
          spaceBetween: spaceBetweenConfig.desktop,
          allowTouchMove: (function () {
            const slideCount = $(swiperContainer).find(".swiper-slide").length;
            return slideCount > 3; // Desactiva swipe si hay 3 o menos
          })(),
        },
      },
    });
  }

  // Ejecutar la función en el load inicial y en cada resize
  $(window).on("load resize", function () {
    initSwiper();
  });
})(jQuery);
