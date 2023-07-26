<?php
include_once("../includes/session.php");
include_once("../includes/DB.php");
include_once("../includes/functions.php");
include_once("../includes/DateTime.php");
global $connectingDB;


$resource_id = $_GET['id'];

$sql = 'SELECT * FROM resources WHERE resource_id = "' . $resource_id . '"';
$stmt = $connectingDB -> prepare($sql);
$stmt->execute();
$DataRow = $stmt->fetch();

echo $DataRow['questions_answers'];

?>