<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $deptid = $_POST['deptid'];
  $new_deptname = $_POST['new_deptname'];
  $old_deptname = $_POST['old_deptname'];
  $deptcode = $_POST['deptcode'];
  $location = $_POST['location'];
  $room = $_POST['room'];

  $esc_old_deptname = mysql_real_escape_string($old_deptname);
  $esc_new_deptname = mysql_real_escape_string($new_deptname);

  $sql_update_dept = "UPDATE Department SET Name='$esc_new_deptname', Code='$deptcode', Location='$location', Room='$room' WHERE DepartmentID='$deptid'";
  $result_dept = mysql_query($sql_update_dept);

  if(!$result_dept)
    $message = "Error updating department '$deptid': ".mysql_error();
  else
    $message = "$old_deptname department updated successfully.";

  echo "
    <script language='javascript'>
      window.alert(\"$message\");
      window.location = 'index.php';
    </script>
  ";

?>
