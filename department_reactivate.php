<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $deptid = $_POST['departmentid'];
  $deptname = $_POST['departmentname'];
  $sql_dept = "UPDATE Department SET Status='Active' WHERE DepartmentID='$deptid'";
  $result_dept = mysql_query($sql_dept); //$result = resource id

  if(!$result_dept)
    echo "Error in updating department id '$deptid': ".mysql_error();
  else
    echo "$deptname department reactivated successfully.\n";
?>
