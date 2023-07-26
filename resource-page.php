<?php

include_once("./includes/session.php");
include_once("./includes/DB.php");
include_once("./includes/functions.php");

global $connectingDB;


// converiting qurry search into readable term
$resource =  (str_contains($_GET["resource"], "-")) ? ucwords(join(" ", explode("-", $_GET["resource"]))) : ucfirst($_GET["resource"]);

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
    <link rel="stylesheet" href="./assets/css/resource-page.css" />

    <link
      rel="shortcut icon"
      href="./assets/images/bitconEducationLogo.png"
      type="image/x-icon"
    />


    <title>[resource name] reasources</title>
  </head>
  <body>
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
      <a class="backBTN" href="./all-resource-page.html">Back</a>
      <span class="resource-title"><?php echo $resource;?></span>
      <a href="./add-resource.php?resource=<?php echo $_GET["resource"]?>" class="add-resource">Add Resource</a>

      <form method="post" action="#" class="filter-options">
        <div class="options">
          <div class="radio-container">
            <input checked 
             type="radio" name="payment" class='view-option bubble' id="bubble" />
            <label for="bubble"
              ><img src="./assets/images/blobSorting.svg" alt="" srcset=""
            /></label>
            <input type="radio" class="view-option list" name="payment" id="list" />
            <label for="list"
              ><img src="./assets/images/listSorting.svg" alt="" srcset=""
            /></label>
          </div>
          <div class="filter-option">
            <label for="sort-by">Sort By</label>
            <select name="sort-by" id="sort-by">
              <option <?php if (isset($sort_option) && $sort_option=="newest") echo "selected";?> value="newest">Newest</option>
            <option <?php if (isset($sort_option) && $sort_option=="oldest") echo "selected";?> value="oldest">Oldest</option>
            </select>
          </div>
        </div>
      </form>

      <div class="all-posts">
        <div class="posts-container">
       
          <!-- <article class="list-post">
            <div class="img"></div>
            <div class="text-container">
              <span class="title"
                >Bias in AI: What can blockchains do to ensure fairness?</span
              >
              <div class="author-time">
                <span class="author">By: Blake Kaufman</span>
                <div class="seperator">|</div>
                <span class="time">10min ago</span>
              </div>
              <span class="desciption"
                >Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus,
                tenetur molestiae. Obcaecati ipsam mollitia, laudantium dolorem
                sapiente iure, sed facilis deserunt rerum blanditiis maiores
                esse iste officiis exercitationem, repellendus quasi!</span
              >
            </div>
          </article> -->
          <!-- //////////// -->
          <!-- <article class="blob-post">
            <div class="img"></div>
            <div class="text-container">
              <span class="title"
                >Bias in AI: What can blockchains do to ensure fairness?</span
              >
              <div class="author-time">
                <span class="author">By: Blake Kaufman</span>

                <span class="time">10min ago</span>
              </div>
            </div>
          </article> -->
        </div>
      </div>
    </main>

    <footer>
      <div class="footer-container">
        <div class="logo">
          <a href="index.html"
            ><img src="./assets/images/bitconEducationLogo.png" alt="Bitlearn"
          /></a>
        </div>
        <div class="to-questions list-container">
          <span class="title"> Bitlearn </span>
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
            <span>Copyright © 2023 Bitlearn All rights reserved.</span>
          </div>
        </div>
      </div>
    </footer>
    <script src="https://mempool.space/mempool.js"></script>
    <script src="./javaScript/navbar.js"></script>
    <script src="./javaScript/all-resoreces-page.js"></script>
  </body>
</html>
