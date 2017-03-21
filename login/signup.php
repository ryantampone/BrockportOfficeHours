<?php
  session_start();

  require('../db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $netid = $_POST['netid'];
  $fn = $_POST['firstname'];
  $ln = $_POST['lastname'];
  $access = $_POST['access'];
  $dept = $_POST['dept'];
  $pwd_entered = $_POST['pwd'];
  $pwd_hashed = password_hash($pwd_entered, PASSWORD_DEFAULT);
  $room = $_POST['room'];
  $email = $_POST['email'];
  $esc_email = mysql_real_escape_string($email);
  $phone = $_POST['phone2'];
  $status = "Active";

  if($dept == "")
  {
    if($access != 1)
    {
      $message = "A department is required for this user. Please try again.";
      echo "
        <script language='javascript'>
          window.alert(\"$message\");
          window.location = '../user_signup.php';
        </script>";
    }
    else
    {
      $dept = "NULL";
      $sql_user = "INSERT INTO Users (NetID, FirstName, LastName, Credentials, DepartmentID, Password, Status)
        VALUES ('$netid', '$fn', '$ln', '$access', $dept, '$pwd_hashed', '$status')";
      $user_result = mysql_query($sql_user);
    }
  }
  else
  {
    $sql_user = "INSERT INTO Users (NetID, FirstName, LastName, Credentials, DepartmentID, Password, Status)
      VALUES ('$netid', '$fn', '$ln', '$access', '$dept', '$pwd_hashed', '$status')";
    $user_result = mysql_query($sql_user);
  }

  if($access == 3)
  {
    $sql_fac = "INSERT INTO Faculty (NetID, FirstName, LastName, DepartmentID, OfficeRoomNumber, Email, PhoneNumber, Status)
      VALUES ('$netid', '$fn', '$ln', '$dept', '$room', '$email', '$phone', '$status')";
    $fac_result = mysql_query($sql_fac);
  }

  if(!$user_result)
  {
    $message = "Unable to insert user : ".mysql_error();
    echo "
        <form action='../user_signup.php' name='populate_form' id='populate_form' method='post'>
          <input type='hidden' name='nid' id='nid' value='$netid' />
          <input type='hidden' name='fn' id='fn' value='$fn' />
          <input type='hidden' name='ln' id='ln' value='$ln' />
          <input type='hidden' name='acc' id='acc' value='$access' />
          <input type='hidden' name='dep' id='dep' value='$dept' />
          <input type='hidden' name='pass' id='pass' value='$pwd_entered' />
          <input type='hidden' name='room' id='room' value='$room' />
          <input type='hidden' name='email' id='email' value='$esc_email' />
          <input type='hidden' name='phone' id='phone' value='$phone' />
        </form>
          <script language='javascript'>
            window.alert(\"$message\");
            //window.location = '../user_signup.php';
            document.getElementById(\"populate_form\").submit();
          </script>
    ";
  }
  else
  {
    if ($access == '3')
    {
      if(!$fac_result)
      {
        $message = "Unable to insert faculty : ".mysql_error();
        echo "
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = '../user_signup.php';
          </script>
        ";
      }
    }
    $message = "User '$netid' inserted successfully.";
    echo "
      <script language='javascript'>
        window.alert(\"$message\");
        window.location = '../user_signup.php';
      </script>
    ";

  }

?>
