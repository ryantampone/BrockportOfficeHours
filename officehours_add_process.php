<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  //get values from form
  $semester = $_POST['semester'];
  $facNetID = $_POST['facultyMember'];
  $buildingID = $_POST['location'];
  $roomNumber = $_POST['deptroom'];
  $days = $_POST['days'];

  /*Get Days value from database
  if (isset($_POST['days']))
  {
    $optionArray = $_POST['days'];
    for ($i=0; $i<count($optionArray); $i++) {
        echo $optionArray[$i]."<br />";
    }
  }
  */

  //Times to be parsed
  $startTime = $_POST['start'];
  $startTimeParsed_Array = split(":", $startTime);
  $startTimeParsed = implode("", $startTimeParsed_Array);
        //echo "Start time is: $startTimeParsed";

  $endTime = $_POST['end'];
  $endTimeParsed_Array = split(":", $endTime);
  $endTimeParsed = implode("", $endTimeParsed_Array);
        //echo "End time is: $endTimeParsed";


  //Insert Values into OfficeHours Table of Database
  $sql_insertOfficeHours = "INSERT INTO OfficeHours (NetID, SemesterID, Day, StartTime, EndTime, Location, RoomNumber)
      VALUES ('$facNetID', '$semester', '$days', '$startTimeParsed', '$endTimeParsed', '$buildingID', '$roomNumber')";
  $result = mysql_query($sql_insertOfficeHours);

  if(!$result)
  {
    $message = "Unable to add office hours for $facNetID.  Please try again: ".mysql_error();
    echo "
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = 'officehours_add.php';
          </script>
    ";
  }
  else
  {

    $message = "Office Hours for $facNetID added successfully.";
    echo "
      <script language='javascript'>
        window.alert(\"$message\");
        window.location = 'officehours_add.php';
      </script>
    ";
  }
?>
