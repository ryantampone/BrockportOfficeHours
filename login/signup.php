<?php
session_start();

include '../dbh.php';

$first = $_POST['first'];
$last = $_POST['last'];
$uid = $_POST['uid'];
$pwd = $_POST['pwd'];
$access = $_POST['access'];

$sql = "INSERT INTO user (first, last, uid, pwd, access)
  VALUES ('$first', '$last', '$uid', '$pwd', '$access')";
$result=mysqli_query($conn, $sql);

//header("location: ../forecastoptions.php");

?>
