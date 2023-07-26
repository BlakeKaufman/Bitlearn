"use strict";

function initBackgroundChange() {
  const main_background_img = document.querySelector(".main-content-back");

  window.addEventListener("resize", function (e) {
    if (window.innerWidth <= 900) {
      console.log(main_background_img.style.src);
      main_background_img.src = "./assets/images/home-chart-mobile.svg";
    } else {
      main_background_img.src = "./assets/images/home-chart-desktop.svg";
    }
  });

  function initImg() {
    if (window.innerWidth <= 900) {
      main_background_img.src = "./assets/images/home-chart-mobile.svg";
    } else {
      main_background_img.src = "./assets/images/home-chart-desktop.svg";
    }
    main_background_img.style.filter = "blur(0)";
    main_background_img.style.webkitFilter = "blur(0)";
  }
  initImg();
}

initBackgroundChange();
