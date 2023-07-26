"use strict";
function strikeAPIINIT() {
  const submitBTNSpan = document.querySelectorAll(".submit-form-BTN-span");
  const submit_container = document.querySelector(".submit-container");
  const allErrorMessages = document.querySelectorAll(".error-message");

  let lookForPayment;
  let AuthorizationCode;
  let invoiceId;
  let submitBTn;
  let realoadBTN;
  let validPromoCode;

  // submit form
  // form.submt()

  // creates the invoice
  // have to figure out how to crete a uique corrlation id. Probubly basd off time and hashing function
  function invoiceAIPCall(uniqueID, ammount, submitBTN, post_type) {
    fetch("https://api.strike.me/v1/invoices", {
      method: "post",

      body: JSON.stringify({
        correlationId: `${uniqueID.slice(0, 30)}`,
        description: post_type,

        amount: {
          amount: ammount,
          currency: "USD",
        },
      }),
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        Authorization: `Bearer ${AuthorizationCode}`,
      },
    })
      .then((response) => response.json())
      .then((json) => {
        quoteForInvoice(json, submitBTN);
      })
      .catch((error) => {
        console.log(error);
      });
  }

  // gets invoice. tells if it is payed or not along with other inforation
  function getInvoiceById(invoiceID, submitBTN) {
    invoiceId = invoiceID;
    submitBTn = submitBTN;

    fetch(`https://api.strike.me/v1/invoices/${invoiceID}`, {
      method: "get",

      headers: {
        Accept: "application/json",
        Authorization: `Bearer ${AuthorizationCode}`,
      },
    })
      .then((response) => response.json())
      .then((json) => {
        const status = json.state;
        if (status === "UNPAID") return;
        const img = submit_container.children[0].children[1].children[0];
        img.src = "./assets/images/accept.png";
        setTimeout(function () {
          clearInterval(lookForPayment);
          submitFromCreatedButton(submitBTN);
        }, 2000);
      })
      .catch((error) => {
        console.log(error);
        clearInterval(lookForPayment);
      });
  }

  function submitFromCreatedButton(submitBTN) {
    // submitbutton vairable changes the name of the button. question and comments have true sub comments have false
    const form = document.querySelector(".form-for-submiting");
    const button = document.createElement("button");
    button.textContent = "Post";
    button.classList.add("submit-form-BTN");
    submitBTN
      ? (button.name = "submitBTN")
      : (button.name = "submit-sub-comment-BTN");

    // Add an event listener to the button

    // Append the button to the document body
    form.appendChild(button);
    button.click();
  }

  // gets lighning adress and adds popup forpayment
  // sets timer to look for chnge in payd invoice
  // displays checkmark for qr code and puts post into database

  function createQrScreen() {
    let html = `
        <div class="message-container-invoice">
        <span class="title">Pay the lightning invoice to submit post!</span>
        <div class="qr-img-container">
          <video autoplay muted loop webkit-playsinline playsinline>
            <source src="./assets/videos/loading.mp4" type="video/mp4">
          </video>
        </div>
        <div class="ammount">Amount: XXX sats</div>
        <span class="description"
          >XXX</span
        >
      </div>`;
    submit_container.innerHTML = "";
    submit_container.style.display = "flex";
    document.body.style.overflow = "hidden";
    window.scrollTo({
      top: 0,
      left: 0,
    });
    submit_container.insertAdjacentHTML("beforeend", html);
  }
  function UpdatecreateQrScreen(json) {
    let html = `
        <div class="message-container-invoice">
        <span class="title">Pay the lightning invoice to submit post!</span>
        <div class="qr-img-container">
          <img src="https://image-charts.com/chart?chl=${
            json.lnInvoice
          }&choe=UTF-8&chs=150x150&cht=qr" alt="Static Chart"/>
        </div>
        <div class="ammount">Amount: ${(
          json.sourceAmount.amount * 100000000
        ).toFixed(2)} sats</div>
        <span class="description"
          >${String(json.lnInvoice)}</span
        >
        <span class="reload"> Reaload</span>
      </div>`;
    submit_container.innerHTML = "";
    submit_container.style.display = "flex";
    document.body.style.overflow = "hidden";
    window.scrollTo({
      top: 0,
      left: 0,
    });
    submit_container.insertAdjacentHTML("beforeend", html);
    setTimeout(function () {
      realoadBTN = document.querySelector(".reload");
      realoadBTN.addEventListener("click", function () {
        document.querySelector(".message-container-invoice").background =
          "black";

        getInvoiceById(invoiceId, submitBTn);
      });
    }, 1000);
  }

  function quoteForInvoice(invoiceProperties, submitBTN) {
    const invoiceId = invoiceProperties.invoiceId;
    fetch(`https://api.strike.me/v1/invoices/${invoiceId}/quote`, {
      method: "post",

      headers: {
        Accept: "application/json",
        "Content-Length": "0",
        Authorization: `Bearer ${AuthorizationCode}`,
      },
    })
      .then((response) => response.json())
      .then((json) => {
        UpdatecreateQrScreen(json);
        lookForPayment = setInterval(function () {
          getInvoiceById(invoiceId, submitBTN);
        }, 1000);
      })
      .catch((error) => {
        console.log(error);
      });
    // lookForPayment = setInterval(function () {
    //   getInvoiceById(invoiceId, submitBTN);
    // }, 1000);
  }

  function createUniqueCode() {
    // Generate a UUID
    function generateUUID() {
      let d = new Date().getTime();
      if (
        typeof performance !== "undefined" &&
        typeof performance.now === "function"
      ) {
        d += performance.now(); // use high-precision timer if available
      }
      return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(
        /[xy]/g,
        function (c) {
          const r = (d + Math.random() * 16) % 16 | 0;
          d = Math.floor(d / 16);
          return (c === "x" ? r : (r & 0x3) | 0x8).toString(16);
        }
      );
    }

    // Generate a random string
    function generateRandomString(length) {
      const chars =
        "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
      let result = "";
      for (let i = 0; i < length; i++) {
        result += chars.charAt(Math.floor(Math.random() * chars.length));
      }
      return result;
    }

    // Combine the UUID and random string to create a unique code
    const uniqueCode = generateUUID() + generateRandomString(6);

    return uniqueCode;
  }

  // gets the string of the date hash
  function createInvoice(ammount, submitBTN, post_type) {
    const hash = createUniqueCode();
    invoiceAIPCall(hash, ammount, submitBTN, post_type);
  }

  function initPaymentProcess(event) {
    let submitBTN;
    //////////////////////
    // posts Start Process
    //////////////////////
    allErrorMessages.forEach((error) => {
      error.style.display = "none";
    });

    if (event.target.classList.contains("posts")) {
      submitBTN = true;
      const question__title = document.getElementById("question-title");
      const question__description = document.getElementById(
        "question-description"
      );
      const titleCount = 100;
      const descriptionCount = 500;

      const questionTitleLen = question__title.value.length;
      const questionDescriptionLen = question__description.value.length;
      if (questionTitleLen > titleCount) {
        document.querySelector(".error-message-title").style.display = "block";
      } else if (20 > questionTitleLen) {
        document.querySelector(".error-message-title").style.display = "block";
      } else if (20 > questionDescriptionLen) {
        document.querySelector(".error-message-description").style.display =
          "block";
      } else if (questionDescriptionLen > descriptionCount) {
        document.querySelector(".error-message-description").style.display =
          "block";
      } else {
        createInvoice("0.15", submitBTN, "post");
        createQrScreen();
      }
      //////////////////////
      // posts Start Process
      //////////////////////
      //////////////////////
      //commnet Start Process
      //////////////////////
    } else if (event.target.classList.contains("comments")) {
      submitBTN = true;
      const comment = document.getElementById("comment");
      const commentCount = 500;

      const questionDescriptionLen = comment.value.length;

      if (3 > questionDescriptionLen) {
        document.querySelector(".error-message-description").style.display =
          "block";
      } else if (questionDescriptionLen > commentCount) {
        document.querySelector(".error-message-description").style.display =
          "block";
      } else {
        createInvoice("0.1", submitBTN, "comment");
        createQrScreen();
      }
      //////////////////////
      //commnet Start Process
      //////////////////////
      //////////////////////
      // sub comment Start Process
      //////////////////////
    } else if (event.target.classList.contains("sub_comment")) {
      submitBTN = false;
      createInvoice("0.05", submitBTN, "sub-commnet");
      createQrScreen();
    }
    //////////////////////
    // sub comment Start Process
    //////////////////////
    //////////////////////
    // add resource Process
    //////////////////////
    else if (event.target.classList.contains("resource")) {
      submitBTN = true;
      const resource_title = document.getElementById("resource-title");
      const resource_content = document.getElementById("editor");
      const resource_content_container = resource_content.parentElement;
      const imgUPload = document.getElementById("preview-file");
      const promo_code = document.getElementById("promo-code");
      const annoymousQuestions = document.querySelector(".annoymous_questions");
      const titleCount = 100;
      const resourceCount = 500;

      const resourceTitleLen = resource_title.value.length;
      const resourceContentLen = resource_content.textContent.length;

      if (resourceTitleLen > titleCount || resourceTitleLen < 20) {
        document.querySelector(".error-message-title").style.display = "block";
      } else if (resourceCount > resourceContentLen) {
        document.querySelector(".error-message-description").style.display =
          "block";
      } else if (!imgUPload.value) {
        document.querySelector(".error-message-preview_img").style.display =
          "block";
      } else {
        if (annoymousQuestions.value) {
          const allQuestionsContainer = document.querySelector(
            ".all-questions-container"
          );
          if (!doAllQuestionsHaveAnswers(allQuestionsContainer)) {
            window.alert("Please select a correct answer for each question");
            return;
          }

          if (allQuestionsContainer.children.length) {
            ///////////
            let Q_A_dict = {};
            let A_dict;
            [...allQuestionsContainer.children].forEach((question) => {
              const question_text = question.children[1];
              const answersContainer = question.children[2];
              // console.log(question_text, answersContainer);
              ///////////

              if (!answersContainer.children.length) return;
              A_dict = {};
              let question_counter = 1;
              [...answersContainer.children].forEach((answer) => {
                const input = answer.children[0];
                if (!input.value) return;
                A_dict[`answer_${question_counter}`] = input.value;
                if (!input.classList.contains("correct-answer")) return;
                A_dict["correct_answer"] = input.value;
                question_counter++;
              });
              ///////////
              // console.log(!A_dict, Object.keys(A_dict));
              if (!Object.keys(A_dict).length) return;
              Q_A_dict[question_text.value] = A_dict;
            });
            const Q_A_input = createHTMLElement(
              "input",
              "questions_dictionary",
              JSON.stringify(Q_A_dict)
            );
            allQuestionsContainer.appendChild(Q_A_input);
          }
        }
        resource_content.children[1].remove();
        resource_content.children[1].remove();
        const contentTextArea = createHTMLElement(
          "textarea",
          "resource-content",
          resource_content.innerHTML
        );
        // console.log(contentTextArea);
        resource_content_container.appendChild(contentTextArea);
        // resourceSubmit.value = resource_content.innerHTML;
        // submitFromCreatedButton(submitBTN);

        if (promo_code.value) {
          const xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              if (this.responseText) {
                submitFromCreatedButton(submitBTN);
              } else {
                document.querySelector(
                  ".error-message-promo-code"
                ).style.display = "block";
              }
            }
          };
          xmlhttp.open(
            "GET",
            `./xml_pages/test-promo-code.php?promo_code=${promo_code.value}`,
            true
          );
          xmlhttp.send();
        } else {
          createInvoice("5.0", submitBTN, "add_resource");
          createQrScreen();
        }
      }
    }
    //////////////////////
    // add resource Process
    //////////////////////
  }

  function doAllQuestionsHaveAnswers(allQuestionsContainer) {
    const allAnswerContainers = document.querySelectorAll(".answer-container");
    const numNeedeCorrectAnswers = allQuestionsContainer.children.length;
    let numCorrectAnswers = 0;

    [...allAnswerContainers].forEach((answer) => {
      console.log(answer, "<<<<");
      if (answer.children[0].classList.contains("correct-answer"))
        numCorrectAnswers++;
    });

    if (numCorrectAnswers === numNeedeCorrectAnswers) {
      return true;
    } else {
      return false;
    }
  }

  function createHTMLElement(type, name, content) {
    const ElementName = document.createElement(type);
    ElementName.name = name;
    ElementName.value = content;
    ElementName.style.display = "none";
    return ElementName;
  }

  function getAthorizationCode() {
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        AuthorizationCode = this.responseText;
      }
    };
    xmlhttp.open("GET", "./xml_pages/sensitive-data.php", true);
    xmlhttp.send();
  }

  getAthorizationCode();

  submitBTNSpan.forEach((span) => {
    span.addEventListener("click", initPaymentProcess);
  });
}

strikeAPIINIT();
