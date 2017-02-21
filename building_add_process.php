<?php
  session_start();
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $buildname = $_POST['buildname'];

  $sql = "INSERT INTO Building (Name)
    VALUES ('$buildname')";
  $result = mysql_query($sql);

  if(!$result)
  {
    $message = "Unable to add building : ".mysql_error();
    echo "
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = 'department_add.php';
          </script>
    ";
  }
  else
  {
    $message = "Building '$buildname' added successfully.";
    echo "
      <script language='javascript'>
        window.alert(\"$message\");
        window.location = 'index.php';
      </script>
    ";
  }

?>
