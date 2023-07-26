"use strict";
function initMovingBall() {
  const ball = document.querySelector(".moving-ball");
  const whatWeBeliveSection = document.querySelector(".what-we-believe");

  let prevHeight =
    window.pageYOffset + whatWeBeliveSection.getBoundingClientRect().top;

  let offsetAMT = 0;

  function scrollBallSetup(entries) {
    const [entry] = entries;

    if (entry.isIntersecting) {
      window.addEventListener("scroll", scrollBall);
    } else {
      window.removeEventListener("scroll", scrollBall);
      offsetAMT = 0;
    }
  }

  function scrollBall() {
    const currentHeight = window.pageYOffset;
    const distanceTraveled = Math.abs(currentHeight - prevHeight);
    const ballHeight = ball.getBoundingClientRect().height;

    if (offsetAMT < -200) {
      offsetAMT = -200;
      return;
    } else if (offsetAMT > 200) {
      offsetAMT = 200;
      return;
    } else if (currentHeight > prevHeight) {
      offsetAMT -= 0.2 * distanceTraveled;
    } else {
      offsetAMT += 0.2 * distanceTraveled;
    }

    ball.style.top = `${350 - ballHeight / 2 + offsetAMT}px`;
    prevHeight = currentHeight;
  }
  const believeSectionOBS = new IntersectionObserver(scrollBallSetup, {
    root: null,
    threshold: 0,
  });

  believeSectionOBS.observe(whatWeBeliveSection);
}
initMovingBall();
