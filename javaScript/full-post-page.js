"use strict";

// inputs
const subCommentPopup = document.querySelector(".popup-container");
///////////////////////
// adding form validation for coment
///////////////////////
const commentINPT = document.getElementById("comment");
const allComments = document.querySelectorAll(".comment-post");

const commentLimit = 500;
let trackCommentPosition = [];

function addCharCount(event) {
  const targetEvent = event.target;
  const charCount = targetEvent.value.length;
  const targetCount = targetEvent.parentElement.children[2];

  if (charCount > commentLimit || 3 > charCount) {
    targetEvent.classList.add("over-char-limit-input");
    targetCount.classList.add("over-char-limit-span");
  } else {
    targetEvent.classList.remove("over-char-limit-input");
    targetCount.classList.remove("over-char-limit-span");
  }
  targetCount.innerHTML = `${charCount}/${commentLimit}`;
}

///////////////////////
// adding form validation for coment
///////////////////////
///////////////////////
// adding secondary comment abiility
///////////////////////

function updateSubComments(commentId) {
  const url = window.location.href;
  const originalPostId = url.split("?")[1].split("=")[1];

  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      subCommentPopup.innerHTML = "";
      subCommentPopup.innerHTML = this.responseText;
      popupFunctionality();
      strikeAPIINIT();
    }
  };
  xmlhttp.open(
    "GET",
    "./xml_pages/get-commnets-page.php?commentId=" +
      commentId +
      "&originalId=" +
      originalPostId,
    true
  );
  xmlhttp.send();
}

function testBrowser() {
  const userAgent = window.navigator.userAgent;
  const isChrome =
    /Chrome/.test(userAgent) && /Google Inc/.test(navigator.vendor);
  const isFirefox = /Firefox/.test(userAgent);
  const isSafari =
    /Safari/.test(userAgent) && /Apple Computer/.test(navigator.vendor);

  if (isChrome) {
    return "Chrome";
  } else if (isFirefox) {
    return "FireFox";
  } else if (isSafari) {
    return "safari";
  } else {
    return "other";
  }
}

function commentPopup(event) {
  const targetElement = event.target;

  if (!targetElement.classList.contains("clickable")) return;
  // /////////
  const commentContainer = targetElement.classList.contains("screen")
    ? targetElement.parentElement.parentElement
    : targetElement.parentElement;
  const commentID = commentContainer.classList[1].split("-")[2];
  subCommentPopup.style.display = "flex";
  window.scrollTo({
    top: 0,
    left: 0,
  });
  if (window.innerWidth > 600) {
    subCommentPopup.style.top = `${window.pageYOffset + 80}px`;
    document.body.style.overflow = "hidden";
  } else {
    subCommentPopup.style.position = "sticky";
    subCommentPopup.style.top = `70px`;

    document.body.style.overflow = "auto";
  }
  trackCommentPosition.push(commentID);
  updateSubComments(commentID);

  // //////////
}

// adding functionality to popup

function popupFunctionality() {
  const closePopupBTN = document.querySelector(".close-sub-comments-BTN");
  const backBTN = document.querySelector(".backBTN");
  const sub_comments = document.querySelectorAll(".comments");

  function resetPopup() {
    subCommentPopup.style.display = "none";
    document.body.style.overflow = "auto";
    trackCommentPosition = [];
  }

  function goBackToPrevComment() {
    if (
      trackCommentPosition.length === 0 ||
      trackCommentPosition.length === 1
    ) {
      resetPopup();
      return;
    }

    const lastComment = trackCommentPosition[trackCommentPosition.length - 2];
    updateSubComments(Number(lastComment));
    trackCommentPosition.pop();
  }

  closePopupBTN.addEventListener("click", resetPopup);
  backBTN.addEventListener("click", goBackToPrevComment);

  sub_comments.forEach((comment) => {
    comment.addEventListener("click", commentPopup);
  });
}

///////////////////////
// adding secondary comment abiility
///////////////////////

allComments.forEach((comment) => {
  comment.addEventListener("click", commentPopup);
});
commentINPT.addEventListener("input", addCharCount);

///////////////////////
// adding back btn
///////////////////////

///////////////////////
// adding back btn
///////////////////////
