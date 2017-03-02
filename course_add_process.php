<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $selected_dept = $_POST['deptcode'];
  $sql_fac_id = "SELECT NetID, FirstName, LastName FROM Faculty WHERE DepartmentID =
    (SELECT DepartmentID FROM Department WHERE Code = '$selected_dept') ORDER BY LastName";
  $result = mysql_query($sql_fac_id); //$result = resource id

  while($row = mysql_fetch_assoc($result))
  {
    $netid = $row["NetID"];
    $fn = $row["FirstName"];
    $ln = $row["LastName"];
    echo json_encode($row)."\n";
  }

  /*$netid = $_GET["netid"];
  $fn = $_GET["fn"];
  $ln = $_GET["ln"];*/

  //echo $netid.", ".$fn.", ".$ln;


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
