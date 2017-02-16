<?php
  session_start();
  require('db_cn.inc');

  $deptname = $_POST['deptname'];
  $deptcode = $_POST['deptcode'];
  $deptbuilding = $_POST['deptbuilding'];
  $deptroom = $_POST['deptroom'];
  $status = 'Active';

  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $sql = "INSERT INTO Department (Name, Code, Location, Room, Status)
    VALUES ('$deptname', '$deptcode', '$deptbuilding', '$deptroom', '$status')";
  $result = mysql_query($sql);

  if(!$result)
  {
    $message = "Unable to add department : ".mysql_error();
    echo "
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = 'department_add.php';
          </script>
    ";
  }
  else
  {
    $message = "Department '$deptname' added successfully.";
    echo "
      <script language='javascript'>
        window.alert(\"$message\");
        window.location = 'index.php';
      </script>
    ";
  }

?>
