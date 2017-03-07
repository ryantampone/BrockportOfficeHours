<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $selected_dept = $_POST['deptcode'];
  $sql_fac_id = "SELECT NetID, FirstName, LastName FROM Faculty WHERE DepartmentID =
    (SELECT DepartmentID FROM Department WHERE Code = '$selected_dept') ORDER BY LastName";
  $result = mysql_query($sql_fac_id); //$result = resource id

  while($row = mysql_fetch_assoc($result))
  {
    $netid = $row["NetID"];
    $fn = $row["FirstName"];
    $ln = $row["LastName"];
    echo json_encode($row)."\n";
  }

?>
