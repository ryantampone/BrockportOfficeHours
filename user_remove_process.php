<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  //get values from form
  $netid = $_POST['netid'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $access = $_POST['access'];
  $deptid = $_POST['deptid'];
  $room = $_POST['room'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  if($access == 3)
  {
    $sql_delete_fac = "UPDATE Faculty SET Status='Inactive' WHERE NetID='$netid'";
    $result_delete_fac = mysql_query($sql_delete_fac);

    if(!$result_delete_fac)
      $message = "Unable to delete faculty '$netid': ".mysql_error();

  }

  $sql_delete_user = "UPDATE Users SET Status='Inactive' WHERE NetID='$netid'";
  $result_delete_user = mysql_query($sql_delete_user);

  if(!$result_delete_user)
    $message = "Unable to delete user '$netid': ".mysql_error();
  else
    $message = "User '$netid' removed successfully.";

  echo "
    <script language='javascript'>
      window.alert(\"$message\");
      window.location = 'index.php';
    </script>
  ";

?>
