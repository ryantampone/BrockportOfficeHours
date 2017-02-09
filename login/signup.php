<?php
  session_start();

  require('../db_cn.inc');

  $netid = $_POST['netid'];
  $fn = $_POST['firstname'];
  $ln = $_POST['lastname'];
  $access = $_POST['access'];
  $dept = $_POST['dept'];
  $pwd_entered = $_POST['pwd'];
  $pwd_hashed = password_hash($pwd_entered, PASSWORD_DEFAULT);
  $status = "Active";

  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
  $sql = "INSERT INTO Users (NetID, FirstName, LastName, Credentials, DepartmentID, Password, Status)
    VALUES ('$netid', '$fn', '$ln', '$access', '$dept', '$pwd_hashed', '$status')";
  $result = mysql_query($sql);

  if(!$result)
  {
    $message = "Unable to insert user : ".mysql_error();
    echo "
          <input type='hidden' name='nid' id='nid' value='$netid' />
          <input type='hidden' name='fn' id='fn' value='$fn' />
          <input type='hidden' name='ln' id='ln' value='$ln' />
          <input type='hidden' name='acc' id='acc' value='$access' />
          <input type='hidden' name='dep' id='dep' value='$dept' />
          <input type='hidden' name='pass' id='pass' value='$pwd_entered' />
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = '../user_signup.php';
          </script>
    ";
  }
  else
  {
    $message = "User '$netid' inserted successfully.";
  }

?>
