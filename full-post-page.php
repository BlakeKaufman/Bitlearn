<?php
include_once("./includes/session.php");
include_once("./includes/DB.php");
include_once("./includes/functions.php");
include_once("./includes/DateTime.php");

global $connectingDB;
global $Date_time;

$postId = $_GET["postId"];


if (isset($_POST["submitBTN"])){
  $comment_text = $_POST["comment"];

  // form validation for title
  if(strlen($comment_text) < 3){
    $_SESSION["ErrorMessage-description"] = true;
  }elseif(strlen($comment_text) > 500){
    $_SESSION["ErrorMessage-description"] = true;
  }
  else{
    $sql = "INSERT INTO comments(comment,question_id,parent_id) VALUES(:commenT, :question_iD,:parent_iD)";
    $stmt = $connectingDB -> prepare($sql);
    $stmt -> bindvalue(":commenT", $comment_text);
    $stmt -> bindvalue(":question_iD", $postId);
    $stmt -> bindvalue(":parent_iD", null);
    
    $Execute = $stmt->execute();
    if ($Execute){
      // displaying popup 
        $_SESSION["SuccessMessage-submit"] = "comment";
    }else{
        $_SESSION["ErrorMessage-submit"]= true;
    }
  }


}
if (isset($_POST['submit-sub-comment-BTN'])){
  
  $parent_id = $_POST['parent_comment_id'];
  $comment = $_POST['sub-comment'];
  
    $sql = "INSERT INTO comments(comment,question_id,parent_id) VALUES(:commenT, :question_iD,:parent_iD)";
    $stmt = $connectingDB -> prepare($sql);
    $stmt -> bindvalue(":commenT", $comment);
    $stmt -> bindvalue(":question_iD", $postId);
    $stmt -> bindvalue(":parent_iD", $parent_id);
   
    $Execute = $stmt->execute();
    if ($Execute){
      // displaying popup 
        $_SESSION["SuccessMessage-submit"] = "sub_comment";
    }else{
        $_SESSION["ErrorMessage-submit"]= true;
    }

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
    <link rel="stylesheet" href="./assets/css/full-post-page.css" />
    <title>Full post</title>
  </head>
  <body>


     <!-- error and success message for submit -->
    <div class="submit-container">
      <?php 
      echo SuccessMessageComment($postId);
      echo ErrorMessageComment($postId);
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
     <!-- popup container for comments on commnets -->
    <div class="popup-container">
     
    </div>
      <!-- popup container for comments on commnets -->


    <main>
      <!-- back btn -->
      <span class="go-back-BTN">Back</span>
      <!-- back btn -->
      <section class="clicked-question">
        <?php
        $sql = "SELECT * FROM questions WHERE question_id = $postId";
        $stmt = $connectingDB -> prepare($sql);
        $stmt->execute();
        $Result = $stmt->rowcount();
        if ($Result > 0){
          while ($DataRow = $stmt->fetch()){
            $title = $DataRow["question_title"];
            $description = $DataRow["question_description"];

          ?>

        <span class="title"><?php echo $title?></span>
        <span class="description"
          ><?php echo $description?></span
        >
        <?php
        
         }
        }else{
          ?>
           <span class="title">No post was found</span>
           <a class="no-post-found-BTN" href="./fourm-page.php">Back to posts</a>
      <?php
        }
        ?>
      </section>
      <section class="comments-container">
        <div class="all-comments">
        <?php
        $sql = 
        "
        SELECT c.id, c.comment, COUNT(s.id) AS sub_comment_count
        FROM comments c
        LEFT JOIN comments s ON c.id = s.parent_id
        WHERE c.question_id = $postId and c.parent_id is null
        GROUP BY c.id;
        ";
        $stmt = $connectingDB -> prepare($sql);
        $stmt->execute();
        $Result = $stmt->rowcount();
        if ($Result > 0){
          while ($DataRow = $stmt->fetch()){
            $comment = $DataRow["comment"];
            $commnet_id = $DataRow["id"];
            $sub_comment_count = $DataRow["sub_comment_count"]

          ?>

          <div class="comment-post comnet-id-<?php echo $commnet_id?>">
            <span class='clickable'
              ><?php echo $comment?></span
            >
            <div class="commnent-icon">
              <img src="./assets/images/comment.png" alt="" srcset="">
              <span> <?php echo $sub_comment_count?></span>
             
              <div class="screen clickable"></div>
            </div>
          </div>
          <?php

          }
        }else{
        ?>
          <div class="no-post-found">
            <span>Be the first to post.</span>
          </div>
        <?php

        }
        ?>
        </div>
      </section>

      <form action="./full-post-page.php?postId=<?php echo $postId?>" method="post" class="add-comment form-for-submiting">
        <span>Add Comment</span>
        <textarea
          name="comment"
          id="comment"
          cols="30"
          rows="10"
        ></textarea>
        <span class="char-limit">0/500</span>
        <span class='error-message-description error-message'>*Your comment must be between 3 and 500 charectors long</span>


        <span class="submit-form-BTN-span comments">Post</span>
        <!-- <button type="submit" class="submit-form-BTN" name="add-comment" hidden >Post</button> -->
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
    <script src="./javaScript/submit-message-for-forms.js"></script>
    <script src="./javaScript/strike-payments-api.js"></script>
    <script  src="./javaScript/full-post-page.js"></script>
    <script src="./javaScript/back-btn.js"></script>
  </body>
</html>
