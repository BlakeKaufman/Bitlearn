"use strict";

function whatWeBeliveInit() {
  const optionsContainer = document.querySelector(".what-we-believe-container")
    .children[1];

  function addHoverEffect(event) {
    const targetElement = event.target;
    [...optionsContainer.children].forEach((option) => {
      if (option === targetElement) return;
      option.classList.add("non-active");
    });
  }
  function removeHoverEffect() {
    [...optionsContainer.children].forEach((option) => {
      option.classList.remove("non-active");
    });
  }

  [...optionsContainer.children].forEach((option) => {
    option.addEventListener("mouseenter", addHoverEffect);
  });

  optionsContainer.addEventListener("mouseout", removeHoverEffect);

  window.addEventListener("resize", function () {
    if (window.innerWidth > 900) {
      [...optionsContainer.children].forEach((option) => {
        option.addEventListener("mouseenter", addHoverEffect);
      });

      optionsContainer.addEventListener("mouseout", removeHoverEffect);
    } else {
      optionsContainer.removeEventListener("mouseout", removeHoverEffect);
      [...optionsContainer.children].forEach((option) => {
        option.removeEventListener("mouseenter", addHoverEffect);
      });
    }
  });
}

whatWeBeliveInit();
