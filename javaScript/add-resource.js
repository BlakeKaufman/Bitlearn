"use strict";

const annoymousSlector = document.querySelectorAll("#annoymous");
const questionINPTS = document.querySelectorAll(".input");

const allQuestionsContainer = document.querySelector(
  ".all-questions-container"
);
const addQuestionBTN = document.querySelector(".add-question");

function showName(event) {
  const targetEvent = event.target;
  let f_name_INPT;
  let l_name_INPT;
  console.log(targetEvent.parentElement);
  if (targetEvent.parentElement.classList.contains("name")) {
    f_name_INPT = targetEvent.parentElement.parentElement.children[1];
    l_name_INPT = targetEvent.parentElement.parentElement.children[2];
    if (targetEvent.checked) {
      f_name_INPT.style.visibility = "hidden";
      l_name_INPT.style.visibility = "hidden";
    } else {
      f_name_INPT.style.visibility = "visible";
      l_name_INPT.style.visibility = "visible";
    }
  } else if (targetEvent.parentElement.classList.contains("questions")) {
    if (targetEvent.checked) {
      allQuestionsContainer.style.display = "none";
      addQuestionBTN.style.display = "none";
      allQuestionsContainer.innerHTML = "";
    } else {
      const html = `
      <div class="question-container">
        <span class="close-img-span">Question 1 </span>
        <input type="text" class="resource-input question 1" name="question_1" id="question_1" placeholder="Question" value="">

        <div class="answers">
        </div>
        <span class="add-answer">Add Answers</span>
      </div>`;
      allQuestionsContainer.style.display = "flex";
      addQuestionBTN.style.display = "flex";
      allQuestionsContainer.innerHTML = html;
    }
  }
}
console.log(annoymousSlector);

annoymousSlector.forEach((selector) => {
  selector.addEventListener("change", showName);
});
// annoymousSlector.addEventListener("change", showName);

///////////////////////////
///////////////////////////
///////////////////////////
// inputs

const textAreaSubmit = document.getElementById("submittedData");
function addPostsINIT() {
  const titleCount = 100;
  const descriptionCount = 500;

  function addCharCount(event) {
    const targetEvent = event.target;
    let charCount;
    let denominator;
    let targetCount;

    if (targetEvent.classList.contains("title")) {
      denominator = titleCount;
      targetCount = targetEvent.parentElement.children[3];
      charCount = targetEvent.value.length;
    } else {
      denominator = descriptionCount;
      targetCount = targetEvent.parentElement.parentElement.children[4];
      charCount = targetEvent.textContent.length;
      // textAreaSubmit.value = targetEvent.innerHTML;
    }
    if (charCount === 0) {
      targetEvent.classList.remove("over-char-limit-input");
      targetCount.classList.remove("over-char-limit-span");
    } else if (
      (charCount > denominator || charCount < 20) &&
      denominator == titleCount
    ) {
      targetEvent.classList.add("over-char-limit-input");
      targetCount.classList.add("over-char-limit-span");
    } else if (charCount < denominator && denominator == descriptionCount) {
      targetCount.classList.add("over-char-limit-span");
    } else {
      targetEvent.classList.remove("over-char-limit-input");
      targetCount.classList.remove("over-char-limit-span");
    }
    targetCount.innerHTML = `${charCount}/${denominator}`;
  }

  questionINPTS.forEach((input) => {
    input.addEventListener("keyup", addCharCount);
  });
}

addPostsINIT();
//////////////////////////////////////
//////////////////////////////////////
//////////////////////////////////////
const toolbarOptions = [
  ["bold", "italic", "underline"],
  [{ list: "ordered" }, { list: "bullet" }],
  [{ align: [] }],
  [{ color: [] }],
  [{ script: "sub" }, { script: "super" }],
  [{ size: ["small", false, "large", "huge"] }],
  [{ header: [1, 2, 3, 4, 5, 6, false] }],
  ["link", "image", "video"],
  ["clean"],
];

const options = {
  modules: {
    toolbar: toolbarOptions,
  },
  theme: "snow",
};

const editor = new Quill("#editor", options);
const editorDiv = document.getElementById("editor");

// img preveiw station
const imgImporter = document.getElementById("preview-file");
const previewShowcase = document.querySelector(".preview-file-showcase");
const imgUploadInpt = document.getElementById("prev-file-inpt");
const showcaseOptionsContainer = document.querySelector(".preview-options");

function addPreviewImg() {
  if (imgImporter.value) {
    turningImgIntoURL();
    return;
  }
  const html = ` <span class="message">Please select an image to see preview</span>`;

  previewShowcase.innerHTML = html;
}

function turningImgIntoURL() {
  const imgImporter = document.getElementById("preview-file");
  const [file] = imgImporter.files;
  console.log(imgImporter.files[0]);
  // need to find a way to store this in database
  // imgUploadInpt.value = imgImporter.files[0];
  displayFileObject(imgImporter.files[0]);
}

function displayFileObject(fileobj) {
  new Compressor(fileobj, {
    quality: 1,
    maxWidth: 500,
    maxHeight: 500,
    success(result) {
      // read the contents of the compressed file
      const reader = new FileReader();
      reader.readAsDataURL(result);
      reader.onload = () => {
        const subString = reader.result.substring(0, 100000);
        previewShowcase.innerHTML = `<img src="${subString}" alt="previwed img">`;
        imgUploadInpt.value = subString;
      };
    },
    error(err) {
      console.error(err.message);
    },
  });
}

function changeOption(event) {
  const targetEvent = event.target;
  if (!targetEvent.classList.contains("clickable")) return;
  [...showcaseOptionsContainer.children].forEach((child) => {
    child.classList.remove("active-option");
  });
  targetEvent.classList.add("active-option");
  if (targetEvent.classList.contains("list-style")) {
    previewShowcase.style.height = "120px";
    previewShowcase.style.width = "200px";
  } else {
    previewShowcase.style.height = "240px";
    previewShowcase.style.width = "350px";
  }
}
addPreviewImg();

imgImporter.addEventListener("change", addPreviewImg);
showcaseOptionsContainer.addEventListener("click", changeOption);
// /////////////////// /////////////////
// /////////////////// /////////////////
// /////////////////// /////////////////
// /////////////////// /////////////////
// /////////////////// /////////////////
// /////////////////// /////////////////

function addAnswer(event) {
  const targetEvent = event.target;

  if (
    targetEvent.classList.contains("remove-question") &&
    !targetEvent.parentElement.parentElement.children[1].classList.contains("1")
  ) {
    targetEvent.parentElement.parentElement.remove();
    return;
  }
  if (!targetEvent.classList.contains("add-answer")) return;
  const asnwersContainer = targetEvent.parentElement.children[2];
  const numAnswers = asnwersContainer.children.length;
  console.log(numAnswers);
  if (numAnswers > 5) {
    window.alert("You can only have 6 answers per question");
    return;
  }
  let html = `
  <div class="answer-container">
  <input
    type="text"
    class="resource-input answer"
    name="answer_${numAnswers + 1}"
    id="answer_${numAnswers + 1}"
    placeholder="answer"
    value="">
    <div class="options-container">
      <span class="correct_answer_BTN clickable">Click to make Correct Answer</span>
      <span class="remove_answer_BTN clickable"> Remove Answer</span>
    </div>
  </div>
  `;

  asnwersContainer.insertAdjacentHTML("beforeend", html);

  // correct_remove_answer();
}

function correct_remove_answer() {
  const fullQuestionsContainer = document.querySelector(
    ".all-questions-container"
  );

  function addAction(event) {
    const targetEvent = event.target;

    if (!targetEvent.parentElement.classList.contains("options-container"))
      return;
    if (!targetEvent.classList.contains("clickable")) return;

    const targetEventAnswer = targetEvent.parentElement.parentElement;

    if (targetEvent.classList.contains("remove_answer_BTN")) {
      targetEventAnswer.remove();
      optionsContainer_inaction.style.display = "none";
    } else if (targetEvent.classList.contains("correct_answer_BTN")) {
      [
        ...targetEvent.parentElement.parentElement.parentElement.children,
      ].forEach((answer_container) => {
        answer_container.children[0].classList.remove("correct-answer");
      });
      targetEventAnswer.children[0].classList.add("correct-answer");
    }
  }

  fullQuestionsContainer.addEventListener("click", addAction);
}
correct_remove_answer();

function addQuestion(event) {
  const targetEvent = event.target;

  if (!targetEvent.classList.contains("add-question")) return;

  const questionsContainer = targetEvent.parentElement.children[1];

  const numQuestions = questionsContainer.children.length;
  console.log(numQuestions);

  if (numQuestions > 9) {
    window.alert("You can only have 10 questions per resource");
    return;
  }
  let html = `
  <div class="question-container">
      <span class="close-img-span">Question ${
        numQuestions + 1
      } <img src="./assets/images/remove.png" alt="" class="remove-question"></span>
      <input
        type="text"
        class="resource-input question ${numQuestions + 1}"
        name="question_${numQuestions + 1}"
        id="question_${numQuestions + 1}"
        placeholder="question"
        value="">
      <div class="answers">
      </div>
      <span class="add-answer">Add Answers</span>
    </div>
  `;

  questionsContainer.insertAdjacentHTML("beforeend", html);
}

allQuestionsContainer.addEventListener("click", addAnswer);
addQuestionBTN.addEventListener("click", addQuestion);
