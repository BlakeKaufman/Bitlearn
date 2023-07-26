<?php
include_once("./includes/session.php");
include_once("./includes/DB.php");
include_once("./includes/functions.php");

global $connectingDB;


if (isset($_POST["filter-optoins-BTN"])){
  $post_catagory = $_POST["catagory"];
  $sort_option = $_POST["sort-by"];
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link
      rel="shortcut icon"
      href="./assets/images/bitconEducationLogo.png"
      type="image/x-icon"
    />

    <link rel="stylesheet" href="./assets/css/index.css" />
    <link rel="stylesheet" href="./assets/css/navbar.css" />
    <link rel="stylesheet" href="./assets/css/footer.css" />
    <link rel="stylesheet" href="./assets/css/fourm-page.css" />
    <title>Fourm</title>
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
      <!-- //////////////// -->
      <div class="search">
        <!-- <input type="text" name="search" id="search" placeholder="Search" />
        <div class="search-BTN">GO</div> -->
        <!-- <img src="" alt="" srcset=""> -->
      </div>
      <!-- //////////////// -->
      <section class="questions">
        <div class="navigation">
          <!-- //// -->
          <div class="top">
            <span class="title">
              <?php
              if (!$post_catagory){
                echo "All Questions";
              }else{
                if (strpos($post_catagory, "-")){
                  echo ucwords(join(" ",explode("-", $post_catagory)));
                }else{
                  echo ucfirst($post_catagory);
                }
              };
               ?>
            </span>
            <a href="./add-post.php"
              ><span class="add-question-BTN">Ask question</span></a
            >
          </div>

          <!-- //// -->
          <div class="bottom">
            <span class="question-count">

          <?php
            $sql = "SELECT * FROM questions";
            $stmt = $connectingDB -> prepare($sql);
            $stmt->execute();
            $Result = $stmt->rowcount();
            echo $Result;    
          ?> questions</span>
            <form class="filter-options" action="fourm-page.php" method="post">
              <div class="options">
              <div class="filter-option">
                <label for="catagory">Select Post Catagory:</label>
                <select name="catagory" id="catagory">
                  <option <?php if (isset($post_catagory) && $post_catagory=="all-posts") echo "selected";?> value="all-posts">All Posts</option>
                  <option <?php if (isset($post_catagory) && $post_catagory=="Introductions") echo "selected";?> value="Introductions">Introductions</option>
                  <option <?php if (isset($post_catagory) && $post_catagory=="bitcoin-mining") echo "selected";?> value="bitcoin-mining">Bitcoin Mining</option>
                  <option <?php if (isset($post_catagory) && $post_catagory=="Economics") echo "selected";?> value="Economics">Economics</option>
                  <option <?php if (isset($post_catagory) && $post_catagory=="Philosophy") echo "selected";?> value="Philosophy">Philosophy</option>
                  <option <?php if (isset($post_catagory) && $post_catagory=="bitcoin-price") echo "selected";?> value="bitcoin-price">Bitcoin Price</option>
                </select>
              </div>
              <div class="filter-option">
                <label for="sort-by">Sort By</label>
                <select name="sort-by" id="sort-by">
                  <option <?php if (isset($sort_option) && $sort_option=="newest") echo "selected";?> value="newest">Newest</option>
                  <option <?php if (isset($sort_option) && $sort_option=="oldest") echo "selected";?> value="oldest">Oldest</option>
                  <option <?php if (isset($sort_option) && $sort_option=="engagement") echo "selected";?> value="engagement">Engagement</option>
                </select>
              </div>
              </div>
              <button name="filter-optoins-BTN" type="submit">Filter</button>
            </form>
          </div>
        </div>
  

       
        <div class="questions-container">
          <?php

          $sql = "
          SELECT questions.*, COUNT(comments.id) AS comment_count
          FROM questions
          LEFT JOIN comments ON comments.question_id = questions.question_id";
          if ($post_catagory){
            // //////
            // need to finish implementing this
            // //////
            if ($post_catagory === "Introductions"){
              $sql .= " WHERE questions.catagory = '$post_catagory'";
            }else if ($post_catagory === "bitcoin-mining"){
              $sql .= " WHERE questions.catagory = '$post_catagory'";
            }else if ($post_catagory === "Economics"){
              $sql .= " WHERE questions.catagory = '$post_catagory'";
            }else if ($post_catagory === "Philosophy"){
              $sql .= " WHERE questions.catagory = '$post_catagory'";
            }else if ($post_catagory === "bitcoin-price"){
              $sql .= " WHERE questions.catagory = '$post_catagory'";
            };
           
          };
          $sql .= " GROUP BY questions.question_id
          order by"; 
          // $sort_option = null;
          if ($sort_option){
            // add sort option given by form
           if ($sort_option === 'newest'){
            $sql .= " questions.date_added DESC";
           }else if($sort_option === 'oldest'){
            $sql .= " questions.date_added ASC";
           }else if($sort_option === 'engagement'){
            $sql .= " COUNT(comments.id) DESC";
           }
          }else{
            $sql .= " questions.date_added DESC";
          };
          $stmt = $connectingDB -> prepare($sql);
          $stmt->execute();
          $Result = $stmt->rowcount();
          if ($Result >0){
            while ($DataRow = $stmt->fetch()){
              $title = $DataRow["question_title"];
              $description = $DataRow["question_description"];
              $post_id = $DataRow["question_id"];
              $commnets_count = $DataRow["comment_count"];
              $date_added = $DataRow["date_added"];




          ?>
           <!-- ///////// -->
          <!-- question -->
          <!-- ///////// -->
          <div class="question">
            <div class="top">
              <span class="answers">
                <?php echo $commnets_count?> Comments
              </span>
              <span><?php echo $date_added?></span>
              <!-- <span class="views">0 views</span> -->
            </div>
            <div class="bottom">
              <a href="./full-post-page.php?postId=<?php echo $post_id?>" target="_self">
                <span class="question-title"
                  ><?php echo $title ?></span
                ></a
              >
              <span class="question-description"
                ><?php echo $description?></span
              >
              <!-- <div class="tag-container">
                <div class="tag">bitcoin-mining</div>
                <div class="tag">bitcoin</div>
              </div> -->
            </div>
          </div>
          <!-- ///////// -->
          <!-- question -->
          <!-- ///////// -->


      <?php

          }
        }else{
          ?>
          <!-- ///////// -->
          <!-- question -->
          <!-- ///////// -->
          <div class="no-post-found">
            <span>Be the first to post.</span>
          </div>
            </div>
          </div>
          <!-- ///////// -->
          <!-- question -->
          <!-- ///////// -->

          <?php }?>
        </div>
       
      </section>
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
  </body>
</html>
