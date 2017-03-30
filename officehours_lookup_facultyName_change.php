<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $enteredFacName = $_POST['facultyName'];
  $sql_fac_id = "SELECT NetID, FirstName, LastName FROM `Faculty` WHERE ((FirstName LIKE '%$enteredFacName%')
  OR (LastName LIKE '%$enteredFacName%') OR (NetID LIKE '%$enteredFacName%')) ORDER BY LastName";
  $result = mysql_query($sql_fac_id); //$result = resource id


  while($row = mysql_fetch_assoc($result))
  {
    $netid = $row["NetID"];
    $fn = $row["FirstName"];
    $ln = $row["LastName"];
    echo json_encode($row)."\n";
  }

?>
