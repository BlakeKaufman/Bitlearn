<?php
session_start();




function SuccessMessageSubmit(){
    if (isset($_SESSION["SuccessMessage-submit"])){

        $Output = '<div class="message-container">';
        $Output .= '<span class="title">Success!</span>';
        $Output .= '<span class="description">Your question has been submitted!</span>';
        $Output .= '<div class="img"><img src="./assets/images/accept.png" alt="" /></div>';
        if ($_SESSION["SuccessMessage-submit"] === "add-resource"){
          $location = 'resource-page.php?resource='.$_SESSION['add-resource-back-location'];
        }else{
          $location = './fourm-page.php';
        }
        $Output .= '<a href="' . $location .'">Continue</a>
      </div>';
        }
    
        $_SESSION["SuccessMessage-submit"] = null;
        return $Output;
}
function ErrorMessageSubmit(){
    if (isset($_SESSION["ErrorMessage-submit"])){

        $Output = '<div class="message-container">';
        $Output .= '<span class="title">Error!</span>';
        $Output .= '<span class="description">Your question has not been submitted!</span>';
        $Output .= '<div class="img"><img src="./assets/images/remove.png" alt="" /></div>';
        $Output .= ' <a href="./add-post.php">Continue</a>
      </div>';
        }
    
        $_SESSION["ErrorMessage-submit"] = null;
        return $Output;
}

function SuccessMessageComment($postid){
  if (isset($_SESSION["SuccessMessage-submit"])){
      $Output = '<div class="message-container">';
      $Output .= '<span class="title">Success!</span>';
      $Output .= '<span class="description">Your commnet has been submitted!</span>';
      $Output .= '<div class="img"><img src="./assets/images/accept.png" alt="" /></div>';
      $Output .= ' <a href="./full-post-page.php?postId='. $postid.'">Back to post</a>';
      $Output .= '</div>';
    }

    $_SESSION["SuccessMessage-submit"] = null;
    return $Output;

}
function ErrorMessageComment($postid){
  if (isset($_SESSION["SuccessMessage-submit"])){

    $Output = '<div class="message-container">';
    $Output .= '<span class="title">Success!</span>';
    $Output .= '<span class="description">Your commnet has not been submitted!</span>';
    $Output .= '<div class="img"><img src="./assets/images/remove.png" alt="" /></div>';
    $Output .= ' <a href="./full-post-page.php?postId='.$postid.'">Back to post</a>
  </div>';
    }

    $_SESSION["SuccessMessage-submit"] = null;
    return $Output;

}

// function SuccessMessage(){
//     if (isset($_SESSION["SuccessMessage"])){
//         // creating popup for sign up page 
//         if ($_SESSION["SuccessMessage"] == "SignUp"){
//             $Output  = "<div class='popup'>";
//             $Output .=  "<div class='popupContainer'>";
//             $Output .=      "<span class='popupText'>Your account has been created 
//                                 succesfully!</span>";
//             $Output .=      "<a class='popupBTN' href='./index.php'>Continue Shopping!</a>";
//             $Output .=  "</div>";
//             $Output .= "</div>";
//         }elseif ($_SESSION["SuccessMessage"] == "signIn"){
//             $Output  = "<div class='popup'>";
//             $Output .=  "<div class='popupContainer'>";
//             $Output .=      "<span class='popupText'>You have been Logged in!</span>";
//             $Output .=      "<a class='popupBTN' href='./index.php'>Continue Shopping!</a>";
//             $Output .=  "</div>";
//             $Output .= "</div>";
//         }
        

//         $_SESSION["SuccessMessage"] = null;
//         return $Output;

//     }
// }







?>