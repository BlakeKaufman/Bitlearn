"use strict";
function submitMessageINIT() {
  const submitContainer = document.querySelector(".submit-container");

  function styleSubmitContiner() {
    if (submitContainer.children.length === 0) {
      submitContainer.style.display = "none";
      document.body.style.overflow = "auto";
    } else {
      submitContainer.style.display = "flex";
      document.body.style.overflow = "hidden";
    }
  }

  window.addEventListener("load", styleSubmitContiner);
}

submitMessageINIT();
