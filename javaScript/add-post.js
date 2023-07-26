"use strict";
// inputs
function addPostsINIT() {
  const question__title = document.getElementById("question-title");
  const question__description = document.getElementById("question-description");

  const questionINPTS = document.querySelectorAll(".question-input");

  const form = document.querySelector(".post-form");

  const titleCount = 100;
  const descriptionCount = 500;

  function addCharCount(event) {
    const targetEvent = event.target;
    const charCount = targetEvent.value.length;
    const targetCount = targetEvent.parentElement.children[3];
    const denominator = targetEvent.classList.contains("title")
      ? titleCount
      : descriptionCount;

    if (
      charCount > denominator ||
      (0 < charCount && charCount < 20 && denominator === 500)
    ) {
      targetEvent.classList.add("over-char-limit-input");
      targetCount.classList.add("over-char-limit-span");
    } else {
      targetEvent.classList.remove("over-char-limit-input");
      targetCount.classList.remove("over-char-limit-span");
    }
    targetCount.innerHTML = `${charCount}/${denominator}`;
  }

  questionINPTS.forEach((input) => {
    input.addEventListener("input", addCharCount);
  });
}

addPostsINIT();
