"use strict";
// filter containers
const filterContainer = document.querySelector(".date-filter");
const searchContainer = document.querySelector(".search");
const searchINPT = document.getElementById("search");
const basicOptionsContainer = document.querySelector(".basic-options");
let active_option = "bitcoin";
// ////////

// output containrs
const blobContainer = document.querySelector(".blob-container");

// start date and end date options
const startDate = document.getElementById("start-date");
const endDate = document.getElementById("end-date");
const milisecondsInDay = 1000 * 60 * 60 * 24;

let currentDate;
// ///////////// total results tag

const totalRelustsSpan = document.querySelector(".total-results-span");

// seeting up pagination bins
let paginationBins = [];

// pagination buttons
const paginationContainer = document.querySelector(".pagination");
const scrollContainer = document.querySelector(".scroll-pagination-container");

// functions

function setStardingDates() {
  const dateOBJ = new Date();
  const day =
    `${dateOBJ.getDate() + 1}`.length === 1
      ? "0" + `${dateOBJ.getDate()}`
      : dateOBJ.getDate();
  const month =
    `${dateOBJ.getMonth() + 1}`.length === 1
      ? "0" + `${dateOBJ.getMonth() + 1}`
      : dateOBJ.getMonth() + 1;
  const year = dateOBJ.getFullYear();
  currentDate = `${year}-${month}-${day}`;
  // //////////////////////////

  const utcOtherDate = new Date(Date.parse(currentDate) - milisecondsInDay * 7);

  const dayOther =
    `${utcOtherDate.getUTCDate() + 1}`.length === 1
      ? "0" + `${utcOtherDate.getUTCDate()}`
      : utcOtherDate.getUTCDate();
  const monthOther =
    `${utcOtherDate.getUTCMonth() + 1}`.length === 1
      ? "0" + `${utcOtherDate.getUTCMonth() + 1}`
      : utcOtherDate.getUTCMonth() + 1;
  const yearOther = utcOtherDate.getUTCFullYear();

  const otherDate = `${yearOther}-${monthOther}-${dayOther}`;

  endDate.value = currentDate;
  startDate.value = otherDate;
}
setStardingDates();

function APICall() {
  paginationBins = [];
  const request = new XMLHttpRequest();
  //news API.org
  const URL =
    "https://newsapi.org/v2/everything?" +
    `qInTitle=+${active_option}  + "${searchINPT.value}" -crypto&` +
    `qInContent= -crypto -ethereum&` +
    `from=${startDate.value}&to=${endDate.value}&` +
    "sortBy=popularity&" +
    "language=en&" +
    "apiKey=7d6c5d7eaa4e4a17b39e888cce689bf6";

  //   console.log(URL);
  request.open("GET", URL);
  request.send();
  request.addEventListener("load", function () {
    const data = JSON.parse(this.responseText);
    console.log(data);
    totalRelustsSpan.innerHTML = data.totalResults;
    blobContainer.innerHTML = "";
    let count = 0;
    let tempBin = [];
    data.articles.forEach((article) => {
      if (Number.isInteger(count / 9) && count != 0) {
        paginationBins.push(tempBin);
        tempBin = [];
      }
      if (!article.urlToImage) return;
      let html = `<!-- ///////// -->
    <a href="${article.url}" target="_blank">
      <div class="blob">
        <div class="img">
          <img src="${article.urlToImage}" alt="" srcset="" />
        </div>
        <div class="text">
          <span>${article.title}</span>
        </div>
      </div>
    </a>
    <!-- ///////// -->`;
      tempBin.push(html);

      count++;
    });
    pageNum = 1;
    pagePagination();
  });
}

filterContainer.addEventListener("change", function () {
  if (startDate.value > endDate.value) return;
  if (endDate.value > currentDate) return;
  APICall();
});

searchContainer.addEventListener("click", function (e) {
  if (!e.target.classList.contains("search-BTN")) return;
  if (searchINPT.value.length === 0) return;
  APICall();
});

basicOptionsContainer.addEventListener("click", function (e) {
  const targetElement = e.target;
  if (targetElement.classList.contains("clear-options-BTN")) {
    active_option = "";
    [...basicOptionsContainer.children].forEach((child) => {
      if (child.classList.contains("clear-options-BTN")) return;
      child.classList.remove("active-option");

      child.children[1].checked = false;
    });
    return;
  }
  if (targetElement.name != "search-options") return;
  active_option = targetElement.value;
  [...basicOptionsContainer.children].forEach((child) => {
    child.classList.remove("active-option");
  });
  targetElement.parentElement.classList.add("active-option");

  APICall();
});
APICall();
let pageNum = 1;

function pagePagination() {
  const blobContainer = document.querySelector(".blob-container");
  blobContainer.innerHTML = "";

  paginationBins[pageNum - 1].forEach((post) => {
    blobContainer.insertAdjacentHTML("beforeend", post);
  });
  currentPage();
}

function currentPage() {
  scrollContainer.innerHTML = "";
  for (let index = 1; index < paginationBins.length + 1; index++) {
    let html = `<div class="number ${
      index === pageNum ? "active-page" : ""
    }">${index}</div>`;
    scrollContainer.insertAdjacentHTML("beforeend", html);
  }
}

function changePageNumber(event) {
  const targetElement = event.target;
  const numPages = paginationBins.length;

  if (!targetElement.classList.contains("btn-container")) return;
  if (targetElement.classList.contains("left") && pageNum > 1) pageNum--;
  else if (targetElement.classList.contains("right") && pageNum < numPages)
    pageNum++;
  pagePagination();
}

paginationContainer.addEventListener("click", changePageNumber);
