<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  //get values from form
  $officeHoursRadio = $_POST['officeHoursRadio'];
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $studentEmail = $_POST['studentEmail'];
  $messageDetails = $_POST['messageDetails'];
  $otherOfficeTimeDate = $_POST['otherOfficeTimeDate'];
  $professorEmail = $_POST['professorEmail'];

  $dateTime;
  if ($officeHoursRadio == 'Other')
  {
    //Get and Use time and date from the other radio button
    $dateTime = $otherOfficeTimeDate;
  }
  else
  {
    $dateTime = $officeHoursRadio;
  }

  $toEmail = "$professorEmail";
  $subjectEmail = 'New Office Hours Appointment Request';
  $txtEmail = "Student: $lastName, $firstName has requested to make an appointment for $otherOfficeTimeDate
  with the following message: $messageDetails.  You can contact them via the email address: $studentEmail";
  $headersEmail = "From: <BPortOfficeHours>";
  mail($toEmail,$subjectEmail,$txtEmail,$headersEmail);



  /*echo "
        <script language='javascript'>
          window.alert(\"$netid\");
          window.location = '#';
        </script>";
        */



  //Get the faculty member information
  $search_FacInfo_stmt = "SELECT * FROM Faculty WHERE NetID = '$netid'";
  $result_FacInfo = mysql_query($search_FacInfo_stmt);
  if(!$result_FacInfo)
  {
    $message = "Unable to get Faculty Information : ".mysql_error();
    echo "
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = '#';
          </script>
    ";
  }
  else
  {
    while($row = mysql_fetch_assoc($result_FacInfo))
    {
      $deptID = $row['DepartmentID'];
      $officeRoomNumber = $row['OfficeRoomNumber'];
      $email = $row['Email'];
      $phoneNumber = $row['PhoneNumber'];
      $firstName = $row['FirstName'];
      $lastName = $row['LastName'];
    }
  }


?>
