<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $selected_dept = $_POST['deptID'];
  $sql_dept_info = "SELECT * FROM Department WHERE DepartmentID = '$selected_dept'";
  $result = mysql_query($sql_dept_info); //$result = resource id

  while($row = mysql_fetch_assoc($result))
  {
    echo json_encode($row)."\n";
  }
?>
