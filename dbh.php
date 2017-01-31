<?php

$conn = mysqli_connect("localhost", "bportforecasting", "bportforecasting", "brockportweatherforecasting");

if (!$conn) {
  die("Connection failed: ".mysqli_connect_error());
}

?>
