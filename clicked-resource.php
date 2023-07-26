<?php
include_once("./includes/session.php");
include_once("./includes/DB.php");
include_once("./includes/DateTime.php");
include_once("./includes/functions.php");
global $connectingDB;

$resource_id = $_GET['id'];



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="./assets/css/index.css" />
    <link
      rel="stylesheet"
      href="https://cdn.quilljs.com/1.3.6/quill.snow.css"
    />
    <link rel="stylesheet" href="./assets/css/navbar.css" />

    <link rel="stylesheet" href="./assets/css/footer.css" />
    <link rel="stylesheet" href="./assets/css/clicked-resource.css" />

    <link
      rel="shortcut icon"
      href="./assets/images/bitconEducationLogo.png"
      type="image/x-icon"
    />
   
    <title>Document</title>
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
      <div class="content">
        <div class="post-information">
          <?php



          $sql = 
          "
          SELECT *
          FROM resources
          WHERE resource_id = $resource_id
          ";
          $stmt = $connectingDB -> prepare($sql);
          $stmt->execute();
          $Result = $stmt->rowcount();

          if ($Result > 0){
            $DataRow = $stmt->fetch();
            $title = $DataRow['title'];
            $f_name = $DataRow['f_name'];
            $l_name = $DataRow['l_name'];
            $catagory = $DataRow['catagory'];
            $date_added = $DataRow['date_added'];
            $content = $DataRow['content'];
            $Q_A_dict = $DataRow['questions_answers'];

            ?>
            <span class="post-title"
            ><?= $title?></span>
          <div class="person-time">
          <?php
              if ($f_name != 0){
              ?>
                <span class="author">By: <?php echo ucfirst($f_name) . " " . ucfirst($l_name)?></span>
                <?php 

              }else{
                  ?>
                  <span class="author">By: Unkown</span>
              <?php
              }

            ?>
            <span class="post-date"
              ><img
                src="./assets/images/clock-three.svg"
                alt="clock to show that this is the post date"
                srcset=""
              /><?=$date_added?>
            </span>
          </div>
        </div>
        <div class="post">
          <?= gzuncompress($content)?>
        </div>
        <div class="recommended">
          <span class="recommended-title">Recommended for you:</span>
          <ul class="content-list">
            <a href=""><li>item 2</li></a>
            <a href=""><li>item 2</li></a>
            <a href=""><li>item 2</li></a>
            <a href=""><li>item 2</li></a>
          </ul>
        </div>

        <div class="quiz">
          <div class="begin-container">
            <?php

            if ($Q_A_dict){
            ?>
            <span class="tile">Click the start button to begin quiz!</span>
            <span class="description">Once you click next you cannot go back, so chose your answer wisely</span>
            <span class="start-quiz-BTN">Start Quiz</span>

            <?php
            }else{
              ?>
              <span class="tile">This resource does not have any questions</span>
            <?php  
            }
            ?>
          </div>
        </div>
            <?php
          }else{
            echo "<span>No Post Found</span>";
          }
          ?>
      </div>
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
    <script src="./javaScript/clicked-resource.js"></script>


  </body>
</html>
