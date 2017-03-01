<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $selected_dept = $_REQUEST['deptcode'];
  $sql_fac_id = "SELECT * FROM Faculty WHERE DepartmentID =
    (SELECT DepartmentID FROM Department WHERE Code = '$selected_dept')";
  $result = mysql_query($sql_fac_id);
  $arr = mysql_fetch_row($result);

  echo json_encode($arr);


  /*if(!$result)
  {
    $message = "Error in sql statement: ".mysql_error();
  }
  else $message = "Ajax executed successfully\nSelected Department = ".$selected_dept;
  while($row = mysql_fetch_assoc())
  {
    $netid = $row['NetID'];
    $fn = $row['FirstName'];
    $ln = $row['LastName'];
    $deptid = $row['DepartmentID'];
    $office = $row['OfficeRoomNumber'];
    $email = $row['Email'];
    $phone = $row['PhoneNumber'];
    $status = $row['Status'];
  }

  $message = $message."NetID = ".$netid."\nFirst Name = ".$fn."\nLast Name = ".$ln."\n
    Department ID = ".$deptid."\nOffice Room Number = ".$office."\nEmail = ".$email."\n
    Phone Number = ".$phone."\nStatus = ".$status;
  echo $message;*/
?>
