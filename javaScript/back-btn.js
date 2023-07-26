"use strict";

function backBTNINIT() {
  const backBTN = document.querySelector(".go-back-BTN");

  function goBack() {
    window.open("./fourm-page.php", "_self");
  }

  backBTN.addEventListener("click", goBack);
}

backBTNINIT();
