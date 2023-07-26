<?php
include_once("./includes/session.php");
include_once("./includes/DB.php");
include_once("./includes/DateTime.php");
include_once("./includes/functions.php");


if (isset($_POST['submitBTN'])) {
  $question_title = $_POST['question-title'];
  $question_description = $_POST['question-description'];
  $catagory = $_POST['catagory'];


  // form validation for title
  if (strlen($question_title)>100){
    $_SESSION["ErrorMessage-question"] = true;
    

  }elseif(strlen($question_description) < 20){
    $_SESSION["ErrorMessage-description"] = true;
  }elseif(strlen($question_description) > 500){
    $_SESSION["ErrorMessage-description"] = true;
  }
  else{
    global $connectingDB;
    $sql = "INSERT INTO questions(question_title,question_description,date_added, valid,catagory) VALUES(:question_titlE, :question_descriptioN, :date_addeD, :valiD, :catagorY)";
    $stmt = $connectingDB -> prepare($sql);
    $stmt -> bindvalue(":date_addeD", $Date_time);
    $stmt -> bindvalue(":question_titlE", $question_title);
    $stmt -> bindvalue(":question_descriptioN",$question_description);
    $stmt -> bindvalue(":valiD",1);
    $stmt -> bindvalue(":catagorY",$catagory);
    $Execute = $stmt->execute();
    if ($Execute){
      // displaying popup 
        $_SESSION["SuccessMessage-submit"] = true;


    }else{
        $_SESSION["ErrorMessage-submit"]= true;
       
        
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="./assets/css/index.css" />
    <link rel="stylesheet" href="./assets/css/navbar.css" />

    <link rel="stylesheet" href="./assets/css/footer.css" />
    <link rel="stylesheet" href="./assets/css/add-post.css" />
    <title>[platform name]</title>
  </head>
  <body>
    <!-- error and success message for submit -->
    <div class="submit-container">
      <?php 
      echo SuccessMessageSubmit();
      echo ErrorMessageSubmit();
      ?>
    </div>
    <!-- error and success message for submit -->
    <nav>
      <div class="nav-container-desktop">
        <a href="index.html"
          ><div class="logo">
            <img src="./assets/images/bitconEducationLogo.png" alt="Bitlearn" />
          </div>
        </a>
        <ul class="navbar-links">
          <li>
            <!-- ///////////////// -->
            <div class="nav-dropdown">
              <a class="nav-dropdown" href="#">
                <span> Resources </span>
                <img
                  src="./assets/images/arrow-down-short.svg"
                  alt=""
                  srcset=""
              /></a>
              <!-- ///////////////// -->
              <div class="dropdown-content">
                <div class="content">
                  <div class="left">
                    <span class="title">Reasorces</span>
                    <div class="resorce-container">
                      <!-- ////////// -->
                      <a
                        href="./resource-page.php?resource=bitcoin-mining"
                        class="reasorce"
                      >
                        <span class="reasorce-title">Bitcoin Mining</span>
                        <span class="reasorce-description"
                          >View all reasorces positioned around bitcoin
                          mining</span
                        >
                      </a>
                      <!-- //////////// -->
                      <!-- ////////// -->
                      <a
                        href="./resource-page.php?resource=economics"
                        class="reasorce"
                      >
                        <span class="reasorce-title">Economics</span>
                        <span class="reasorce-description"
                          >View all reasorces positioned around the economics of
                          bitcoin</span
                        >
                      </a>
                      <!-- //////////// -->
                      <!-- ////////// -->
                      <a
                        href="./resource-page.php?resource=philosophy"
                        class="reasorce"
                      >
                        <span class="reasorce-title">Philosophy</span>
                        <span class="reasorce-description"
                          >View all reasorces positioned around the philosophy
                          of bitcoin</span
                        >
                      </a>
                      <!-- //////////// -->
                      <!-- ////////// -->
                      <a
                        href="./resource-page.php?resource=new-innovations"
                        class="reasorce"
                      >
                        <span class="reasorce-title">New Innovations</span>
                        <span class="reasorce-description"
                          >View all reasorces highlighting new innovations</span
                        >
                      </a>
                      <!-- //////////// -->
                    </div>
                  </div>
                  <div class="right">
                    <div class="right-container">
                      <span>All Reasorces</span>
                      <img
                        src="./assets/images/resources.png"
                        alt="icon for reasource page"
                        srcset=""
                      />
                      <span class="description"
                        >View all of our reasorces today!</span
                      >
                      <a href="./all-resource-page.html">View Reasorces</a>
                    </div>
                  </div>
                </div>

                <!-- <li>Bitcoin Mining</li>
                  <li>Economics</li>
                  <li>Philosophy</li>
                  <li>Applications</li> -->
                <!-- ///////////////// -->
              </div>
            </div>
            <!-- ///////////////// -->
          </li>
          <!-- dropdown for courses, books, podcasts, twitter followers, etc -->
          <li><a href="./under-construction.html">Pricing</a></li>
          <li><a href="./fourm-page.php">Fourm</a></li>
          <!-- custom content that we put out -->
          <!-- <li><a href="./under-construction.html">Community</a></li> -->
          <!-- Q and A section for users -->
          <li><a href="./news-page.html">Current News</a></li>
        </ul>
      </div>
      <div class="nav-container-mobile">
        <div class="logo">
          <a href="index.html"
            ><img src="./assets/images/bitconEducationLogo.png" alt="Bitlearn"
          /></a>
        </div>
        <div class="login-signup">
          <img
            class="dropdown-BTN"
            src="./assets/images/list.svg"
            alt=""
            srcset=""
          />
          <!-- hamburger menu -->
        </div>
      </div>
      <!-- mobile nav dropdown -->
      <div class="mobile-nav-dropdown">
        <ul class="navbar-links">
          <li><a href="./all-resorces-page.html">Reasorces</a></li>
          <!-- dropdown for courses, books, podcasts, twitter followers, etc -->
          <li><a href="./under-construction.html">Pricing</a></li>
          <li><a href="./fourm-page.php">Fourm</a></li>
          <!-- custom content that we put out -->
          <!-- <li><a href="./under-construction.html">Community</a></li> -->
          <li><a href="./news-page.html">Current News</a></li>
          <!-- Q and A section for users -->
        </ul>
      </div>
      <div class="bitcoin-stats">
        <ul class="stats-container">
          <li class="price">
            Price: <span class="info-container">754703</span>
          </li>
          <li class="percentChange">
            24hr price change: <span class="info-container">754703</span>
          </li>
          <li class="market-cap">
            Market Cap: <span class="info-container">754703</span>
          </li>
          <li class="volume">
            Volume: <span class="info-container">754703</span>
          </li>
          <li class="blockheight">
            Block Height: <span class="info-container">754703</span>
          </li>
          <li class="difficulty">
            Difficulty: <span class="info-container">48.71T</span>
          </li>
          <li class="hashrate">
            Hash Rate: <span class="info-container">43.64E/H</span>
          </li>
          <li class="nodecount">
            Node Count: <span class="info-container">15,000</span>
          </li>
          <!-- <li class="lasthash">
            Last Hash:
            <span class="info-container">
              0000000000000000000624d76f52661d0f35a0da8b93a87cb93cf08fd9140209</span
            >
          </li> -->
        </ul>
      </div>
    </nav>


    <main>
      <!-- back btn -->
      <span class="go-back-BTN">Back</span>
      <!-- back btn -->
      <div class="intro-text">
        <h1>
          Welome to the post page. Type your question down below to start a
          conversation!
        </h1>
      </div>

      <form action="./add-post.php" method="post" class="post-form form-for-submiting">
        <div class="input-container">
          <label for="question-title">Title</label>
          <span
            >Make sure your title specific. Imagine you're asking a question to
            another person.</span
          >
          <input
            type="text"
            class="question-input title"
            name="question-title"
            id="question-title"
            placeholder="e.g what are the environmental impacts of bitcoin mining?"
            value="<?php echo $_POST['question-title'] ?>"
          />
          <span class="charector-count">0/100</span>
          <span class='error-message-title error-message'>*Title must be less than 100 and grater than 20 charectors long</span>
        </div>
        <div class="input-container">
          <label for="question-description"
            >Why are you asking this question?
          </label>
          <span>
            Expand upon what you put in the title. Minimum 20 characters.
          </span>
          <textarea
            name="question-description"
            class="question-input description"
            id="question-description"
            cols="30"
            rows="10"
            
          ><?php echo $_POST['question-description'] ?></textarea>
          <span class="charector-count">0/500</span>
          <span class='error-message-description error-message'>*Your description must be between 20 and 500 charectors long</span>
        </div>   
        <div class="input-container">
        <label for="question-description"
            >Question Catagory
        </label>
          <select name="catagory" id="catagory">
              <option <?php if (isset($post_catagory) && $post_catagory=="Introductions") echo "selected";?> value="Introductions">Introductions</option>
              <option <?php if (isset($post_catagory) && $post_catagory=="bitcoin-mining") echo "selected";?> value="bitcoin-mining">Bitcoin Mining</option>
              <option <?php if (isset($post_catagory) && $post_catagory=="Economics") echo "selected";?> value="Economics">Economics</option>
              <option <?php if (isset($post_catagory) && $post_catagory=="Philosophy") echo "selected";?> value="Philosophy">Philosophy</option>
              <option <?php if (isset($post_catagory) && $post_catagory=="bitcoin-price") echo "selected";?> value="bitcoin-price">Bitcoin Price</option>
          </select>
        </div>
        <span class="submit-form-BTN-span posts" >
          Submit Post
        </span>
        <!-- <button class="submit-form-BTN" type="submit" name="sumbitBTN" hidden>Submit Post</button> -->
      
      </form>
    </main>

    <footer>
      <div class="footer-container">
        <div class="logo">
          <a href="index.html"
            ><img
              src="./assets/images/bitconEducationLogo.png"
              alt="[platform name]"
          /></a>
        </div>
        <div class="to-questions list-container">
          <span class="title"> [platform name] </span>
          <ul class="footer-list">
            <li class="footer-item">
              <a href="./fourm-page.php">Questoins</a>
            </li>
            <li class="footer-item"><a href="./news-page.html">News</a></li>
            <li class="footer-item">
              <a href="./under-construction.html">Education</a>
            </li>
            <li class="footer-item">
              <a href="./fourm-page.php">Fourm</a>
            </li>
          </ul>
        </div>
        <div class="company list-container">
          <span class="title"> Company </span>
          <ul class="footer-list">
            <li class="footer-item">
              <a href="./company-pages/about-us.html">About</a>
            </li>
            <li class="footer-item"><a href="./help.html">Help</a></li>
            <li class="footer-item">
              <a href="./under-construction.html">Privacy Policy</a>
            </li>
            <li class="footer-item">
              <a href="./under-construction.html">Terms of Service</a>
            </li>
            <li class="footer-item">
              <a href="./under-construction.html">Privacy Polict</a>
            </li>
          </ul>
        </div>
        <div class="social list-container">
          <div class="top">
            <ul class="social-list">
              <li><a href="#">Facebook</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Linkedin</a></li>
              <li><a href="#">Instagram</a></li>
            </ul>
          </div>
          <div class="bottom">
            <span>Copyright © 2023 [platform name] All rights reserved.</span>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://mempool.space/mempool.js"></script>
    <script src="./javaScript/navbar.js"></script>
    <script src="./javaScript/add-post.js"></script>
    <script src="./javaScript/submit-message-for-forms.js"></script>
    <script src="./javaScript/strike-payments-api.js"></script>
    <script src="./javaScript/back-btn.js"></script>
  </body>
</html>
