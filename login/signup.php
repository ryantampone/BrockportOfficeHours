<?php
  session_start();

  require('../db_cn.php');

  $netid = $_POST['netid'];
  $fn = $_POST['firstname'];
  $ln = $_POST['lastname'];
  $uid = $_POST['uid'];
  $pwd = $_POST['pwd'];
  $access = $_POST['access'];

  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
  $sql = "INSERT INTO user (first, last, uid, pwd, access)
    VALUES ('$first', '$last', '$uid', '$pwd', '$access')";
  $result = mysql_query($sql);

  while($row = mysql_fetch_assoc($sql))
  {

  }

  //header("location: ../forecastoptions.php");

?>
