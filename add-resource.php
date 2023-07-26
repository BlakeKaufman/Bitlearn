<?php
include_once("./includes/session.php");
include_once("./includes/DB.php");
include_once("./includes/DateTime.php");
include_once("./includes/functions.php");
// include_once("./includes/sensitive-info.php");
global $connectingDB;
// global $encrypt_key;

// $sql = 'SELECT * FROM resources';
// $stmt = $connectingDB -> prepare($sql);
// $stmt->execute();
// $Result = $stmt->rowcount();
// while ($DataRow = $stmt->fetch()){
//   // $text = $DataRow['preview_img'];
//   $content = $DataRow["content"];
//   echo gzuncompress($content);

 
//   echo '<img src="'. gzuncompress($text). '" alt="">';
// }




$resource_catagory = $_GET['resource'];

if (isset($_POST['submitBTN'])) {
  
  $resource_title = $_POST['resource-title'];
  $first_name = empty($_POST['f-name']) ? 0 : $_POST['f-name'] ;
  $last_name = empty($_POST['l-name']) ? 0 : $_POST['l-name'] ;
  $resource_content = gzcompress($_POST['resource-content'], 9);
  // how to uncompress data
  // gzuncompress($Compressed_data)
  $catagory = $_POST['catagory'];
  $promo_code = empty($_POST["promo-code"])? 0:1;
  $preview_img = gzcompress($_POST["prev-file-inpt"], 9); 
  $questions_answers = empty($_POST["questions_dictionary"]) ? 0 :$_POST["questions_dictionary"];

  // echo $preview_img;
// how to decrpt img
// openssl_decrypt(base64_decode($encrypted_data), "aes-256-cbc", $key, OPENSSL_RAW_DATA);


//   $compressedEssay = gzcompress($resource_content, 9);
  //echo gzuncompress($title);


  // form validation for title
   
    $sql = "INSERT INTO resources(title,f_name,l_name, content,catagory,date_added,used_promo,preview_img,questions_answers) VALUES(:titlE,:f_namE,:l_namE,:contenT,:catagorY,:date_addeD,:used_promO,:preview_imG,:questions_answerS)";
    
    $stmt = $connectingDB -> prepare($sql);
    $stmt -> bindvalue(":date_addeD", $Date_time);
    $stmt -> bindvalue(":titlE", $resource_title);
    $stmt -> bindvalue(":f_namE", $first_name);
    $stmt -> bindvalue(":l_namE", $last_name);
    $stmt -> bindvalue(":contenT", $resource_content);
    $stmt -> bindvalue(":used_promO",$promo_code);
    $stmt -> bindvalue(":catagorY",$catagory);
    $stmt -> bindvalue(":preview_imG",$preview_img);
    $stmt -> bindvalue(":questions_answerS",$questions_answers);
  
    $Execute = $stmt->execute();
    if ($Execute){
        // displaying popup 
        $_SESSION["SuccessMessage-submit"] = "add-resource";
        $_SESSION['add-resource-back-location'] = $resource_catagory;

    }else{
        $_SESSION["ErrorMessage-submit"]= "add-resource";
        
        
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
    <link rel="stylesheet" href="./assets/css/add-resource.css" />
    <link
      rel="stylesheet"
      href="https://cdn.quilljs.com/1.3.6/quill.snow.css"
    />
    <link
      rel="shortcut icon"
      href="./assets/images/bitconEducationLogo.png"
      type="image/x-icon"
    />
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
      <a href="./resource-page.php?resource=<?php echo $resource_catagory;?>" class="go-back-BTN">Back</a>
      <!-- back btn -->
      <div class="intro-text">
        <h1>
        Are you ready to add to the conversation. Just fill out the form bellow and after review we will add it to the website!
        </h1>
      </div>

      <form action="./add-resource.php?resource=<?php echo $resource_catagory?>" method="post" class="post-form form-for-submiting"  enctype="multipart/form-data">
        <div class="input-container">
          <label for="resource-title">Title</label>
          <span
            >Make sure your title specific.</span
          >
          <input
            type="text"
            class="resource-input title input"
            name="resource-title"
            id="resource-title"
            placeholder="e.g How bitcoin mining works"
            value="<?php echo $_POST['resource-title'] ?>"
          />
          <span class="charector-count">0/100</span>
          <span class='error-message-title error-message'>*Title must be less than 100 and grater than 20 charectors long</span>
        </div>
        <div class="input-container">
          <label for="resource-title">Name</label>
          <input
            type="text"
            class="resource-input title"
            name="f-name"
            id="f-name"
            placeholder="First Name"
            value="<?php echo $_POST['f-name'] ?>"
          />
          <input
            type="text"
            class="resource-input title"
            name="l-name"
            id="l-name"
            placeholder="Last Name"
            value="<?php echo $_POST['l-name'] ?>"
          />
          <div class="annoymous-container name">
            <input type="checkbox" name="annoymous" id="annoymous">
            <label for="annoymous">Annoymous</label>
          </div>
        </div>
        <div class="input-container">
          <label for="reasource-content"
            >Paste your essay into the box bellow.
          </label>
          <span>
            Minimum 500 characters.
          </span>
         
          <div id="editor" class="input"></div>
          <span class="charector-count">0/500</span>
          <span class='error-message-description error-message'>*Your post must be at least 500 charectors long</span>
     
        </div>
        <div class="input-container">
          <label for="resource-title">Questions </label>
          <div class="all-questions-container">
            <div class="question-container">
              <span class="close-img-span">Question 1 </span>
              <input
                type="text"
                class="resource-input question 1"
                name="question_1"
                id="question_1"
                placeholder="Question"
                value="<?php echo $_POST['question_1'] ?>"
              />
              <div class="answers">
              
              </div>
              <span class="add-answer">Add Answers</span>
            </div>
          </div>
          <span class="add-question">Add Questoin</span>
          

          <div class="annoymous-container questions">
            <input type="checkbox" name="annoymous_questions" class="annoymous_questions" id="annoymous">
            <label for="annoymous_questions">No questions</label>
          </div>
          <!-- <input type="text" name="questions_dictionary" id="questions_dictionary" hidden> -->
        </div>   
        <div class="input-container">
        <label for="question-description"
            >Resource Catagory
        </label>
          <select name="catagory" id="catagory">
              <option <?php if (isset($resource_catagory) && $resource_catagory=="bitcoin-mining") echo "selected";?> value="bitcoin-mining">Bitcoin Mining</option>
              <option <?php if (isset($resource_catagory) && $resource_catagory=="economics") echo "selected";?> value="Economics">Economics</option>
              <option <?php if (isset($resource_catagory) && $resource_catagory=="philosophy") echo "selected";?> value="Philosophy">Philosophy</option>
              <option <?php if (isset($resource_catagory) && $resource_catagory=="innovations") echo "selected";?> value="Innovations">Innovations</option>
          </select>
        </div>
        <div class="input-container">
          <label for="promo-code">Promo Code</label>
          <input
            type="text"
            class="resource-input title"
            name="promo-code"
            id="promo-code"
            placeholder="Promo Code"
            value="<?php echo $_POST['promo-code'] ?>"
          />
          <span class='error-message-promo-code error-message'>*Invalid Promo Code</span>
        </div>
        <div class="input-container">
          <label for="preview-file">Preview Image</label>
          <input
            type="file"
            class="resource-input title"
            name="preview-file"
            id="preview-file"
            value="<?php echo $_POST['preview-file'] ?>"
            accept=".jpg,.jpeg,.png"
            required
          />
          <span class='error-message-preview_img error-message'>*Please Upload a Preview img</span>

          <input type="text" name="prev-file-inpt" id="prev-file-inpt" hidden>

          <div class="preview-options">
            <span class='active-option clickable list-style'>List style</span>
            <span class='clickable blob-style'>Blob style</span>
          </div>
       
          <div class="preview-file-showcase"></div>
          
        </div>
        <span class="submit-form-BTN-span resource" >
          Submit Post
        </span>
        
       
      
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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="./imported-JS-modles/compressor.js"></script>
    <script src="./javaScript/add-resource.js"></script>
   
  </body>
</html>
