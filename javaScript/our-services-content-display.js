"use strict";

function contentDisplayInit() {
  const allDropdownContent = document.querySelectorAll(".drop-info");

  function addDropdown(event) {
    const targetEvent = event.target;
    const infoContainer = targetEvent.parentElement.parentElement.children;
    const dropContent = targetEvent.parentElement.children[1];

    [...infoContainer].forEach((dropdown) => {
      if (dropdown === targetEvent.parentElement) return;
      dropdown.children[1].style.display = "none";
    });
    console.log(dropContent.style.display === "block");
    if (dropContent.style.display === "block") {
      dropContent.style.display = "none";
      return;
    }

    dropContent.style.display = "block";
  }

  allDropdownContent.forEach((dropdown) => {
    dropdown.addEventListener("click", addDropdown);
  });
}

contentDisplayInit();
