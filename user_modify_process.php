<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  //get values from form
  $old_netid = $_POST['old_netid'];
  $new_netid = $_POST['new_netid'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $access = $_POST['access'];
  $deptid = $_POST['dept'];
  $room = $_POST['room'];
  $email = $_POST['email'];
  $phone = $_POST['phone2'];

  $message = "";
  $message2 = "";
  $message3 = "";

  /* Note:
    I am aware there are multiple messages that continuously get over written.
    This was for testing/debugging purposes. Only one message should be displayed
    in the final system.
  */

  // Modifying to admin:
  // 1: Check if user was faculty
  //    if so, try to delet fculty entry
  //       if cannot delete, set to inactive
  // 2: Update users entry
  if($access == 1)
  {
    // 1: First check if modified user is already in the faculty table
    $sql_fac_lookup = "SELECT NetID FROM Faculty WHERE NetID = '$old_netid'";
    $result_fac_lookup = mysql_query($sql_fac_lookup);
    if(!$result_fac_lookup)
      $message = "Unable to search for faculty '$old_netid': ".mysql_error();
    else
    {
      // If the modified user does not exist in the faculty table already, update users entry
      if(mysql_num_rows($result_fac_lookup) == 0)
      {
        $sql_admin = "UPDATE Users SET NetID='$new_netid', FirstName='$firstname', LastName='$lastname', Credentials='$access', DepartmentID=NULL WHERE NetID='$old_netid'";
        $result_admin = mysql_query($sql_admin);
        if(!$result_admin)
          $message = "Unable to update user '$old_netid': ".mysql_error();
        else
          $message = "User '$old_netid' updated successfully.";
      }
      else
      {
        // If the modified user exists in the faculty table already:
        // a: Drop faculty entry
        // b: Update users entry

        // a: Drop faculty entry
        $sql_fac_drop = "DELETE FROM Faculty WHERE NetID='$old_netid'";
        $result_fac_drop = mysql_query($sql_fac_drop);
        if(!$result_fac_drop)
        {
          // If faculty cannot be dropped, set the entry to inactive
          $sql_fac_deactivate = "UPDATE Faculty SET Status='Inactive' WHERE NetID='$old_netid'";
          $result_fac_deactive = mysql_query($sql_fac_deactivate);
          if(!$result_fac_deactive)
            $message = "Unable to deactivate faculty '$old_netid': ".mysql_error();
          else
            $message = "Faculty '$old_netid' set to inactive.";
        }
        else
          $message = "Faculty '$old_netid' dropped successfully.";

        // b: Update users entry
        $sql_admin = "UPDATE Users SET NetID='$new_netid', FirstName='$firstname', LastName='$lastname', Credentials='$access', DepartmentID=NULL WHERE NetID='$old_netid'";
        $result_admin = mysql_query($sql_admin);
        if(!$result_admin)
          $message = "Unable to update user '$old_netid': ".mysql_error();
        else
          $message = "User '$old_netid' updated successfully.";
      }
    }
    echo "
      <script language='javascript'>
        window.alert(\"$message\");
        window.location = 'index.php';
      </script>
    ";
  }

  // Modifying to secretary:
  // 1: Check if user was faculty
  //    if so, drop faculty entry
  // 2: Update user entry
  if($access == 2)
  {
    // 1: First check if modified user is already in the faculty table
    $sql_fac_lookup = "SELECT NetID FROM Faculty WHERE NetID = '$old_netid'";
    $result_fac_lookup = mysql_query($sql_fac_lookup);
    if(!$result_fac_lookup)
      $message = "Unable to search for faculty '$old_netid': ".mysql_error();
    else
    {
      // If the modified user does not exist in the faculty table already, update users entry
      if(mysql_num_rows($result_fac_lookup) == 0)
      {
        $sql_secretary = "UPDATE Users SET NetID='$new_netid', FirstName='$firstname', LastName='$lastname', Credentials='$access', DepartmentID='$deptid' WHERE NetID='$old_netid'";
        $result_secretary = mysql_query($sql_secretary);
        if(!$result_secretary)
          $message = "Unable to update user '$old_netid': ".mysql_error();
        else
          $message = "User '$old_netid' updated successfully.";
      }
      else
      {
        // If the modified user exists in the faculty table already:
        // a: Drop faculty entry
        // b: Update users entry

        // a: Drop faculty entry
        $sql_fac_drop = "DELETE FROM Faculty WHERE NetID='$old_netid'";
        $result_fac_drop = mysql_query($sql_fac_drop);
        if(!$result_fac_drop)
        {
          // If faculty cannot be dropped, set the entry to inactive
          $sql_fac_deactivate = "UPDATE Faculty SET Status='Inactive' WHERE NetID='$old_netid'";
          $result_fac_deactive = mysql_query($sql_fac_deactivate);
          if(!$result_fac_deactive)
            $message = "Unable to deactivate faculty '$old_netid': ".mysql_error();
          else
            $message = "Faculty '$old_netid' set to inactive.";
        }
        else
          $message = "Faculty '$old_netid' dropped successfully.";

        // b: Update users entry
        $sql_secretary = "UPDATE Users SET NetID='$new_netid', FirstName='$firstname', LastName='$lastname', Credentials='$access', DepartmentID='$deptid' WHERE NetID='$old_netid'";
        $result_secretary = mysql_query($sql_secretary);
        if(!$result_secretary)
          $message = "Unable to update user '$old_netid': ".mysql_error();
        else
          $message = "User '$old_netid' updated successfully.";
      }
    }
    echo "
      <script language='javascript'>
        window.alert(\"$message\");
        window.location = 'index.php';
      </script>
    ";
  }

  // Modifying to faculty:
  // 1: Drop entry from faculty
  // 2: Update users entry
  // 3: Insert back into faculty
  if($access == 3)
  {
    // First check if modified user is already in the faculty table
    $sql_fac_lookup = "SELECT NetID FROM Faculty WHERE NetID = '$old_netid'";
    $result_fac_lookup = mysql_query($sql_fac_lookup);
    if(!$result_fac_lookup)
      $message = "Unable to search for faculty '$old_netid': ".mysql_error();
    else
    {
      // If the modified user does not exist in the faculty table already:
      // 1: Update users entry
      // 2: Insert into faculty
      if(mysql_num_rows($result_fac_lookup) == 0)
      {
        // 1: Update users entry
        $sql_fac_users = "UPDATE Users SET NetID='$new_netid', FirstName='$firstname', LastName='$lastname', Credentials='$access', DepartmentID='$deptid' WHERE NetID='$old_netid'";
        $result_fac_users = mysql_query($sql_fac_users);
        if(!$result_fac_users)
          $message = "Unable to update user '$old_netid': ".mysql_error();
        else
          $message = "User '$old_netid' updated successfully.";

        // 2: Insert into faculty
        $sql_fac_insert = "INSERT INTO Faculty (NetID, FirstName, LastName, DepartmentID, OfficeRoomNumber, Email, PhoneNumber)
            VALUES ('$new_netid', '$firstname', '$lastname', '$deptid', '$room', '$email', '$phone')";
        $result_fac_insert = mysql_query($sql_fac_insert);
        if(!$result_fac_insert)
          $message2 = "Unable to insert faculty '$new_netid': ".mysql_error();
        else
          $message2 = "Faculty '$new_netid' inserted into Faculty successfully.";
      }

      // If the modified user exists in the faculty table:
      // 1: Update users entry
      // 2: Update faculty-specific info
      else
      {
        // 1: Drop faculty entry
        /*$sql_fac_drop = "DELETE FROM Faculty WHERE NetID='$old_netid'";
        $result_fac_drop = mysql_query($sql_fac_drop);
        if(!$result_fac_drop)
        {
          // If faculty cannot be dropped, set the entry to inactive
          $sql_fac_deactivate = "UPDATE Faculty SET Status='Inactive' WHERE NetID='$old_netid'";
          $result_fac_deactive = mysql_query($sql_fac_deactivate);
          if(!$result_fac_deactive)
            $message = "Unable to deactivate faculty '$old_netid': ".mysql_error();
          else
            $message = "Faculty '$old_netid' set to inactive.";
        }
        else
          $message = "Faculty '$old_netid' dropped successfully.";
        */

        // 1: Update users entry
        $sql_fac_users = "UPDATE Users SET NetID='$new_netid', FirstName='$firstname', LastName='$lastname', Credentials='$access', DepartmentID='$deptid' WHERE NetID='$old_netid'";
        $result_fac_users = mysql_query($sql_fac_users);
        if(!$result_fac_users)
          $message2 = "Unable to update user '$old_netid': ".mysql_error();
        else
          $message2 = "User '$old_netid' updated successfully.";

        // 2: Update faculty-specific info
        $sql_fac_insert = "UPDATE Faculty SET OfficeRoomNumber='$room', Email='$email', PhoneNumber='$phone', Status='Active' WHERE NetID='$new_netid'";
        $result_fac_insert = mysql_query($sql_fac_insert);
        if(!$result_fac_insert)
          $message3 = "Unable to insert faculty '$new_netid': ".mysql_error();
        else
          $message3 = "Faculty '$new_netid' inserted into Faculty successfully.";
      }
    }

    echo "
      <script language='javascript'>
        window.alert(\"$message\\n$message2\\n$message3\");
        window.location = 'index.php';
      </script>
    ";
  }


?>
