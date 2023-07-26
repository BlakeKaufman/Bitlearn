"use strict";
const optionsContainer = document.querySelector(".options");
const postContainer = document.querySelector(".posts-container");
const allPostsContainer = document.querySelector(".all-posts");

const form = document.querySelector(".filter-options");
let descriptions = {};
let prevEvent;
function chagnePostStyle() {
  let [orderBy] = [...optionsContainer.children[1].children[1].children].filter(
    (option) => option.selected
  );
  const postType = document.location.search.split("=")[1];

  //   [...optionsContainer.children[1].children[1].children].filter(
  //     (option) => option.selected
  //   )
  // );

  if (window.innerWidth <= 850) {
    populatePosts("bubble", postType, orderBy.value);
    return;
  }
  const viewOptions = document.querySelectorAll(".view-option");
  // const orderBy = document.getElementById("sort-by");
  let activeViewOption;

  viewOptions.forEach((option) => {
    if (option.checked) activeViewOption = option;
  });
  // console.log(orderBy.selected);

  populatePosts(activeViewOption.classList[1], postType, orderBy.value);

  // const xmlhttp = new XMLHttpRequest();
  // xmlhttp.onreadystatechange = function () {
  //   if (this.readyState == 4 && this.status == 200) {
  //     postContainer.innerHTML = this.responseText;
  //     if (activeViewOption.classList[1] === "list") {
  //       postContainer.style.flexDirection = "column";
  //       truncateDescrption();
  //     } else {
  //       postContainer.style.flexDirection = "row";
  //     }
  //   }
  // };
  // xmlhttp.open(
  //   "GET",
  //   `./xml_pages/get-resources-page.php?resource=${postType}&post_style=${activeViewOption.classList[1]}`,
  //   true
  // );
  // xmlhttp.send();
  // prevEvent = activeViewOption;
}

function populatePosts(postType, catagory, sort) {
  const xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      postContainer.innerHTML = this.responseText;
      if (window.innerWidth <= 850) return;
      if (postType === "list") {
        postContainer.style.flexDirection = "column";
        truncateDescrption();
      } else {
        postContainer.style.flexDirection = "row";
      }
    }
  };
  xmlhttp.open(
    "GET",
    `./xml_pages/get-resources-page.php?resource=${catagory}&post_style=${postType}&sortBy=${sort}`,
    true
  );
  xmlhttp.send();
  prevEvent = postType;
}

const filterBTNS = document.querySelector(".radio-container");
function forceBubbleStyle() {
  if (window.innerWidth >= 850) changeViewStyle(true);
  else changeViewStyle(false);
}

function changeViewStyle(widthPos) {
  if (widthPos) {
    filterBTNS.style.display = "flex";
    allPostsContainer.style.alignItems = "center";
    postContainer.style.flexDirection = "row";
  } else {
    filterBTNS.children[0].checked = true;
    filterBTNS.style.display = "none";
    const postType = document.location.search.split("=")[1];
    populatePosts("bubble", postType);
    postContainer.style.alignItems = "center";
    postContainer.style.flexDirection = "column";
    allPostsContainer.style.alignItems = "unset";
  }
}

function truncateDescrption() {
  const allDescriptions = document.querySelectorAll(".description-container");
  allDescriptions.forEach((description) => {
    // removing editable descriptoin

    if (!description.children[0].children[0]) return;
    // removing the Jquill editing functionality
    description.children[0].children[0].contentEditable = false;
    const resizeObserver = new ResizeObserver(changeDescriptionLen);
    resizeObserver.observe(description);

    descriptions[description.classList[1]] = description.textContent;
  });
}

function changeDescriptionLen(event) {
  const [entries] = event;
  const targetDescription = entries.target.children[0].children[0];
  const originalDescription = descriptions[entries.target.classList[1]];

  //   must be equal to the p font size in the description container | this number is in px
  const fontSize = 16 - 3;
  const divWidth = entries.contentRect.width * 2;
  const CharNum = Math.round(divWidth / fontSize) * 2;
  targetDescription.textContent = originalDescription.slice(0, CharNum) + "...";
}
chagnePostStyle();
forceBubbleStyle();
form.addEventListener("change", chagnePostStyle);

window.addEventListener("resize", forceBubbleStyle);
