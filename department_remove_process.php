<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  //get values from form
  $deptid = $_POST['deptid'];
  $deptname = $_POST['deptname'];
  $deptcode = $_POST['deptcode'];
  $location = $_POST['location'];
  $room = $_POST['room'];

  $sql_delete_dept = "UPDATE Department SET Status='Inactive' WHERE DepartmentID='$deptid'";
  $result_delete_dept = mysql_query($sql_delete_dept);

  if(!$result_delete_dept)
    $message = "Unable to delete $deptname department: ".mysql_error();
  else
    $message = "$deptname department removed successfully.";

  echo "
    <script language='javascript'>
      window.alert(\"$message\");
      window.location = 'index.php';
    </script>
  ";

?>
