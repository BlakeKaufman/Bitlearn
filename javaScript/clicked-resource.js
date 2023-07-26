"use strict";
const editor = document.querySelector(".ql-editor");
function removeEditAbility() {
  editor.contentEditable = false;
  getQuizQuestions();
}

window.addEventListener("load", removeEditAbility);

//  adding quiz funtionaltiy

const quizStartBtn = document.querySelector(".start-quiz-BTN");
const quizContainer = document.querySelector(".quiz");
let questions_dict;
let questionNum = 0;
let guessedAnswer = [];

function displayQuestion() {
  const questions = Object.keys(questions_dict);
  let finalQuestion;

  let html = `
  <div class="test-container">
    <span class="question">${questions[questionNum]}</span>
    <ul class="answer-list">
  `;
  Object.keys(questions_dict[questions[questionNum]]).forEach((answer) => {
    if (answer === "correct_answer") return;
    html += `<li class="answer">${
      questions_dict[questions[questionNum]][answer]
    }</li>`;
  });
  html += `</ul>`;
  if (questionNum + 1 === questions.length) {
    html += ` <span class="next_BTN"> Grade Test </span>`;
    finalQuestion = true;
  } else {
    html += ` <span class="next_BTN"> Next </span>`;
    finalQuestion = false;
  }
  html += `
  <span class="progression"> ${questionNum + 1}/${questions.length}</span>
  </div>
  `;
  quizContainer.innerHTML = "";
  quizContainer.insertAdjacentHTML("beforeend", html);
  answerSelector();
  nextQuestion(finalQuestion);
}

function answerSelector() {
  const answerList = document.querySelector(".answer-list");
  function addAnswer(event) {
    const targetEvent = event.target;

    if (!targetEvent.classList.contains("answer")) return;
    if (targetEvent.classList.contains("selected-answer")) return;
    [...answerList.children].forEach((child) => {
      child.classList.remove("selected-answer");
    });
    targetEvent.classList.add("selected-answer");
  }
  answerList.addEventListener("click", addAnswer);
}
function selectedAnswer() {
  const answerList = document.querySelector(".answer-list");
  let userSelectedAnswer;
  [...answerList.children].forEach((child) => {
    if (child.classList.contains("selected-answer")) {
      userSelectedAnswer = child.textContent;
      console.log(child.textContent);
    }
  });

  return userSelectedAnswer;
}

function nextQuestion(questionPosition) {
  const nextBTN = document.querySelector(".next_BTN");

  function moveToNextQuestion() {
    if (questionPosition) {
      if (!selectedAnswer()) {
        window.alert("please select an answer");
        return;
      }
      guessedAnswer.push(selectedAnswer());
      console.log(guessedAnswer);
      console.log(questions_dict);
      const score = gradeTest(guessedAnswer, questions_dict);
      quizContainer.innerHTML = "";
      let html = `
  <div class="test-container">
    <span class="summery">Your Score</span>
    <span class="score">${score * 100}%</span>
  </div>
  `;
      quizContainer.insertAdjacentHTML("beforeend", html);
    } else {
      if (!selectedAnswer()) {
        window.alert("please select an answer");
        return;
      }
      questionNum++;
      guessedAnswer.push(selectedAnswer());
      displayQuestion();
    }
  }

  nextBTN.addEventListener("click", moveToNextQuestion);
}

function getQuizQuestions() {
  const resourceId = window.location.href.split("id=")[1];
  console.log(resourceId);
  const xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      questions_dict = JSON.parse(this.responseText);
    }
  };
  xmlhttp.open(
    "GET",
    `./xml_pages/get-quiz-questions.php?id=${resourceId}`,
    true
  );
  xmlhttp.send();
}

function gradeTest(guessed_answers, provided_Q_A) {
  let questionNum = 0;
  let numCorrect = 0;

  Object.keys(provided_Q_A).forEach((question) => {
    const correctAnswer = provided_Q_A[question].correct_answer;
    if (guessed_answers[questionNum] === correctAnswer) numCorrect++;
    questionNum++;
  });

  // console.log((numCorrect / guessedAnswer.length).toFixed(2));
  return (numCorrect / guessedAnswer.length).toFixed(2);
}

quizStartBtn.addEventListener("click", displayQuestion);

// will use to check for input
// const badWords = ["bad", "offensive", "inappropriate"];
// const regex = new RegExp("\\b(" + badWords.join("|") + ")\\b", "gi");
// const userInput = "This is a bad example.";

// if (regex.test(userInput)) {
//   console.log("The input contains a bad word.");
// } else {
//   console.log("The input is clean.");
// }
