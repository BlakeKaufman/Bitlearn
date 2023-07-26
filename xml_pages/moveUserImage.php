<?php
include_once("../includes/session.php");
include_once("../includes/DB.php");
include_once("../includes/functions.php");
include_once("../includes/DateTime.php");

global $connectingDB;



$filename = $_FILES["file"]["name"];
$tempname = $_FILES["file"]["tmp_name"];
$folder = "./userImages/" . $filename;


echo $_GET['userImg'];



?>