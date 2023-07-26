<?php
include_once("./includes/DB.php");

function isLoggedIn(){
    if (!isset($_SESSION["userName"])){
        header("Location:signIn.php");
        exit;
    }
}

function RedirectTo($New_Location){
    header("Location:".$New_Location);
    exit;
};

function CheckUsernameExistsOrNot($userName){
    global $connectingDB;
    $sql = "SELECT username FROM Users WHERE username=:usernamE";
    $stmt = $connectingDB->prepare($sql);
    $stmt -> bindvalue(":usernamE", $userName);
    $stmt -> execute();
    $Result = $stmt->rowcount();
    if ($Result >= 1){
        return true;
    }else{
        return false;
    }
}

function UserPass($username,$password){
    global $connectingDB;
    $sql = "SELECT * FROM Users WHERE username=:userName AND password=:passWord LIMIT 1";
    $stmt = $connectingDB->prepare($sql);
    $stmt-> bindvalue(":userName", $username);
    $stmt-> bindvalue(":passWord", $password);
    $stmt->execute();
    $Result = $stmt->rowcount();
    if ($Result == 1){
        return $found_account = $stmt->fetch();
    }else{
        return null;
    }
}


function displayLoginUserName(){
    // <!-- add php to make name popup on login -->
            
    if (isset($_SESSION["userFname"])){
        // echo "<span class='UserFname'> Hi ". 
        // ucfirst($_SESSION["userFname"]) . "!</span>";

        echo  '
        <div class="dropdown UserFname">
        <span>Hi ' . ucfirst($_SESSION["userFname"]) . '!</span>
        <img src="./assets/images/arrow-down-short.svg"/>
        <form class="dropdown-content" action="./index.php" method="post">
        
            <a href="#">Link 1</a>
            <a href="./sellProductIndex.php">List a product</a>
            <form action="./index.php" method="post">
            <button  type="submit" name="SignOut">Sign Out</button>
        
        
            </form>
        
        </div>';
    }else{
        echo '<a href="./signIn.php">
        <span class="CTABTN signIn">Sign In</span></a>';
        echo ' <a href="./signUp.php"
        ><span class="CTABTN signUP">Sign Up</span></a>';
    }
            
}

// function confirmLogin(){
//     if (isset($_SESSION["User_ID"])){
//         return true;
//     }else{
//         $_SESSION["ErrorMessage"]= "Login Required";
//         RedirectTo("Login.php");
//     }
// }

// function getTotal($whatFor){
//     global $connectingDB;
//     $sql = "SELECT * FROM $whatFor";
//     $Execute = $connectingDB->query($sql);
//     $count = 0;
//     while ($DataRows = $Execute->fetch()){
//         $count++;
//     }
//     return $count;

// }
// function getTotalWithId($id){
//     global $connectingDB;
//     $sql = "SELECT * FROM comments WHERE post_id='$id'";
//     $Execute = $connectingDB->query($sql);
//     $count = 0;
//     while ($DataRows = $Execute->fetch()){
//         $count++;
//     }
//     return $count;

// }

// function getommentCount($status,$postId){
//     global $connectingDB;
//     $sql2 = "SELECT * FROM comments WHERE post_id='$postId' AND status='$status'";
//     $stmt2 = $connectingDB->query($sql2);
//     $count = 0;
//     while ($DataRows = $stmt2->fetch()){
//         $count++;
//     };
//     return $count;
// }

?>
