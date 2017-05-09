<?php
  $callToActionVar = "Remove Office Hours";
  include 'header.php';
  include 'dbh.php';
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $netid = $_POST['netid'];

  $sql_prof = "SELECT FirstName, LastName FROM Faculty WHERE NetID='$netid'";
  $result_prof = mysql_query($sql_prof);

  if(!$result_prof)
    echo "Error retrieving faculty member with netid = $netid: ".mysql_error();

  while($nextProf = mysql_fetch_assoc($result_prof))
  {
    $prof_fn = $nextProf['FirstName'];
    $prof_ln = $nextProf['LastName'];
  }

  $sql_oh = "SELECT * FROM OfficeHours WHERE NetID='$netid'";
  $result_oh = mysql_query($sql_oh);
  $oh_numrows = mysql_num_rows($result_oh);

  if($oh_numrows == 0)
    echo "<h3 class='subHeading' align='center'>No office hours found for $prof_fn $prof_ln</h3>";

  else
  {
  echo"
  <br/><br/><h3 class='subHeading' align='center'>Select an Office Hour Below to Remove</h2>
  <form method='post' action='officehours_remove_process.php'>
    <table align='center' cellspacing='20px'>
      <tr>
        <th></th>
        <th>Day</th>
        <th>Time</th>
        <th>Building</th>
        <th>Room</th>
      </tr>
  ";

    while($row = mysql_fetch_assoc($result_oh))
    {
      $oh_semester = $row['SemesterID'];
      $oh_location = $row['Location'];
      $oh_room = $row['RoomNumber'];
      $id = $row['ID'];
      $day = $row['Day'];
      $startTimeMilitary = (int)$row['StartTime'];
      $endTimeMilitary = (int)$row['EndTime'];

      $startTime_AM_PM = "";
          if ($startTimeMilitary >= 1300)
          {
            $startTimeUnparsed = (string)$startTimeMilitary - 1200;
            $startTime_AM_PM = 'PM';
          }
          else if (($startTimeMilitary == 1200) || (($startTimeMilitary < 1300) && ($startTimeMilitary >= 1200)))
          {
            $startTimeUnparsed = (string)$startTimeMilitary;
            $startTime_AM_PM = "PM";
          }
          else if ($startTimeMilitary == 0000)
          {
            $startTimeUnparsed = "1200";
            $startTime_AM_PM = "AM";
          }
          else
          {
            $startTimeUnparsed = (string)$startTimeMilitary;
            $startTime_AM_PM = 'AM';
          }
          //Convert back to 12HR time
          $startTimeArray = str_split($startTimeUnparsed);
          $arrayStartSize = sizeOf($startTimeArray);
          $separator = ':'; //change for example 1200 to 12:00
          $splitStartTimePos = $arrayStartSize - 2;
          $startSplicedArray = array_splice($startTimeArray, $splitStartTimePos, 0, $separator );
          //$startTime = implode("", $startSplicedArray);
          $startTime = "";

          for ($cnt = 0; $cnt <= $arrayStartSize; $cnt++)
          {
            $startTime = $startTime.$startTimeArray[$cnt];
          }

          $startTime = $startTime." ".$startTime_AM_PM;




      $endTime_AM_PM = "";
          if ($endTimeMilitary >= 1300)
          {
            $endTimeUnparsed = $endTimeMilitary - 1200;
            $endTime_AM_PM = "PM";
          }
          else if (($endTimeMilitary == 1200) || (($endTimeMilitary < 1300) && ($endTimeMilitary >= 1200)))
          {
            $endTimeUnparsed = (string)$endTimeMilitary;
            $endTime_AM_PM = "PM";
          }
          else if ($endTimeMilitary == 0000)
          {
            $endTimeUnparsed = "1200";
            $endTime_AM_PM = "AM";
          }
          else
          {
            $endTimeUnparsed = $endTimeMilitary;
            $endTime_AM_PM = "AM";
          }
          //Convert back to 12HR time
          $endTimeArray = str_split($endTimeUnparsed);
          $arrayEndSize = sizeOf($endTimeArray);
          $separator = ':'; //change for example 1200 to 12:00
          $splitEndTimePos = $arrayEndSize - 2;
          $endSplicedArray = array_splice($endTimeArray, $splitEndTimePos, 0, $separator );
          //$startTime = implode("", $startSplicedArray);
          $endTime = "";

          for ($cnt = 0; $cnt <= $arrayEndSize; $cnt++)
          {
            $endTime = $endTime.$endTimeArray[$cnt];
          }
          $endTime = $endTime." ".$endTime_AM_PM;

      $location = $row['Location'];
      $roomNumber = $row['RoomNumber'];
      $buildingNameOfficeHours = 'building';
            //Use location ID to get the department location
            $deparment_location_officeHours = "SELECT * FROM Building WHERE BuildingID = '$location'";
            $result_location_officeHours = mysql_query($deparment_location_officeHours);
            if(!$result_location_officeHours)
            {
              $message = "Unable to get Office Hours Location : ".mysql_error();
              echo "
                    <script language='javascript'>
                      window.alert(\"$message\");
                      window.location = '#';
                    </script>
              ";
            }
            else
            {
              while($row = mysql_fetch_assoc($result_location_officeHours))
              {
                $buildingNameOfficeHours = $row['Name'];
              }
            }
      echo"
        <tr>
          <td><input type='radio' name='officeHoursRadio' id='officeHoursRadio' value='$id' required></td>
          <td>$day</td>
          <td align='center'>$startTime - $endTime</td>
          <td>$buildingNameOfficeHours</td>
          <td>$roomNumber</td>
        </tr>
        ";
    }
    echo"
    </table>
    <p align='center'>
      <input type='submit' id='submitButton' value='Submit'/>
    </p>";
  }

?>
