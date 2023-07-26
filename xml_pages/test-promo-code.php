<?php

include_once("../includes/session.php");
include_once("../includes/DB.php");
include_once("../includes/functions.php");
include_once("../includes/DateTime.php");

global $connectingDB;




$promo_code_user = $_GET["promo_code"];

$sql = "
SELECT * FROM promo_codes
WHERE BINARY promo_code = BINARY '$promo_code_user'
";
$stmt = $connectingDB -> prepare($sql);
$stmt->execute();
$Result = $stmt->rowcount();

if ($Result === 1){
    echo true;
}else{
    echo false;

}


?>
