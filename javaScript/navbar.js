"use strict";

/////////////////////////////
// mobile nav
/////////////////////////////

function initNavBar() {
  const mobileNavContainer = document.querySelector(".nav-container-mobile");
  const mobileDropdownNav = document.querySelector(".mobile-nav-dropdown");

  let dropdown_displayed = false;

  function mobileDropdown(event) {
    const targetElement = event.target;

    if (!targetElement.classList.contains("dropdown-BTN")) return;

    if (!dropdown_displayed) {
      mobileDropdownNav.style.display = "flex";
      document.body.style.overflow = "hidden";
    } else {
      mobileDropdownNav.style.display = "none";
      document.body.style.overflow = "auto";
    }
    dropdown_displayed = !dropdown_displayed;
  }

  mobileNavContainer.addEventListener("click", mobileDropdown.bind(event));
}

initNavBar();

// ////////////////////////////////
// ////////////////////////////////
// ////////////////////////////////
// ////////////////////////////////
// ////////////////////////////////

const statsContainer = document.querySelector(".stats-container");

let blockHeight;
let hashRate;
let infoInterval;
let networkStats;
// let lastHash;
let BitcoinPrice;
let dayPriceChangePercent;
let marketCap;
let volume;
let bitcoinDATA = {};
const blockHeightFunction = async () => {
  const {
    bitcoin: { blocks },
  } = mempoolJS({
    hostname: "mempool.space",
  });

  blockHeight = await blocks.getBlocksTipHeight();
};

const getHashRate = async () => {
  const url = "https://mempool.space/api/v1/mining/hashrate/1m";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    hashRate = await response.json();

    // return data;
  } catch (error) {
    console.log(error);
  }
};
const getNetworkStats = async () => {
  const url = "https://mempool.space/api/v1/lightning/statistics/latest";
  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    networkStats = await response.json();

    // return data;
  } catch (error) {
    console.log(error);
  }
};
// const getLastHash = async () => {
//   const {
//     bitcoin: { blocks },
//   } = mempoolJS({
//     hostname: "mempool.space",
//   });

//   lastHash = await blocks.getBlocksTipHash();
// };
// const getBitcoinPriceData = async () => {
//   const {
//     bitcoin: { blocks },
//   } = mempoolJS({
//     hostname: "mempool.space",
//   });

//   lastHash = await blocks.getBlocksTipHash();

// };
const getBitcoinPriceData = async () => {
  try {
    const response = await fetch("https://api.coincap.io/v2/assets/bitcoin");
    const { data } = await response.json();

    BitcoinPrice = Number(data.priceUsd).toFixed(2);
    dayPriceChangePercent = Number(data.changePercent24Hr).toFixed(2) + "%";
    marketCap = new Intl.NumberFormat("en-US", {
      notation: "compact",
      compactDisplay: "short",
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    }).format(data.marketCapUsd);
    volume = new Intl.NumberFormat("en-US", {
      notation: "compact",
      compactDisplay: "short",
      minimumFractionDigits: 2,
      maximumFractionDigits: 2,
    }).format(data.volumeUsd24Hr);

    // console.log(data);
  } catch (error) {
    console.log(error);
  }
};

function gettingInfo() {
  [...statsContainer.children].forEach((stat) => {
    switch (stat.classList[0]) {
      case "price":
        stat.children[0].innerHTML = bitcoinDATA.bitcoinPrice;
        break;
      case "percentChange":
        stat.children[0].innerHTML = bitcoinDATA.percentChange;
        break;
      case "market-cap":
        stat.children[0].innerHTML = bitcoinDATA.market_cap;
        break;
      case "volume":
        stat.children[0].innerHTML = bitcoinDATA.volume;
      case "blockheight":
        stat.children[0].innerHTML = bitcoinDATA.blockheight;
      case "difficulty":
        stat.children[0].innerHTML = bitcoinDATA.difficulty;
        break;
      case "hashrate":
        stat.children[0].innerHTML = bitcoinDATA.hashrate;
        break;
      case "nodecount":
        stat.children[0].innerHTML = bitcoinDATA.nodecount;
        break;
    }
  });
  if (statsContainer.classList.contains("non-active"))
    statsContainer.classList.remove("non-active");
}

function loadBitcoinData() {
  if (alreadyCalledAPI()) gettingInfo();
  else {
    statsContainer.classList.add("non-active");
    infoInterval = setInterval(waitForData, 1000);
  }
}
function waitForData() {
  if (
    !blockHeight &&
    !hashRate &&
    !networkStats &&
    // !lastHash &&
    !BitcoinPrice &&
    !dayPriceChangePercent &&
    !marketCap &&
    !volume
  )
    return;
  clearInterval(infoInterval);
  setUpLocalStorage();
  gettingInfo();
}
getBitcoinPriceData();
// getLastHash();
getNetworkStats();
getHashRate();
blockHeightFunction();
// beiging of process
loadBitcoinData();

// async function makeGetRequest(url) {
//   try {
//     const response = await fetch(url);
//     if (!response.ok) {
//       throw new Error(`HTTP error! status: ${response.status}`);
//     }
//     const data = await response.json();
//     return data;
//   } catch (error) {
//     console.log(error);
//   }
// }

// ///////////////////////////////
// ///////////////////////////////
// ///////////////////////////////
// ///////////////////////////////

function alreadyCalledAPI() {
  // will clear local storage after an hour to reset data upon new login
  const clearMinutes = 10;
  const now = new Date().getTime();
  const setupTime = localStorage.getItem("setupTime");
  if (setupTime == null) {
    localStorage.setItem("setupTime", now);
  } else {
    if (now - setupTime > clearMinutes * 60 * 1000) {
      localStorage.clear();
      localStorage.setItem("setupTime", now);
    }
  }
  // testing if local storage is set yet with data
  if (JSON.parse(localStorage.getItem("bitcoin-data"))) {
    bitcoinDATA = JSON.parse(localStorage.getItem("bitcoin-data"));
    return true;
  } else return false;
}

function setUpLocalStorage() {
  const EH_constant = 0.000000000000000001;
  const currentDificulty = hashRate.currentDifficulty;
  const currentHashrate = hashRate.currentHashrate * EH_constant;
  const nodeCount = networkStats.latest.node_count;

  [...statsContainer.children].forEach((stat) => {
    switch (stat.classList[0]) {
      case "price":
        console.log("test");
        bitcoinDATA["bitcoinPrice"] =
          Number(BitcoinPrice).toLocaleString("en-US");
        break;
      case "percentChange":
        bitcoinDATA["percentChange"] = dayPriceChangePercent;
        break;
      case "market-cap":
        bitcoinDATA["market_cap"] = marketCap;
        break;
      case "volume":
        bitcoinDATA["volume"] = volume;
      case "blockheight":
        bitcoinDATA["blockheight"] = blockHeight.toLocaleString("en-US");
      case "difficulty":
        bitcoinDATA["difficulty"] = new Intl.NumberFormat("en-US", {
          notation: "compact",
          compactDisplay: "short",
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
        }).format(currentDificulty);
        break;
      case "hashrate":
        bitcoinDATA["hashrate"] = currentHashrate.toFixed(2) + " E/H";
        break;
      case "nodecount":
        bitcoinDATA["nodecount"] = nodeCount.toLocaleString("en-US");
        break;
    }
  });
  localStorage.setItem("bitcoin-data", JSON.stringify(bitcoinDATA));
}
