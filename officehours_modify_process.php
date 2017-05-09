<?php
  session_start();
  $callToActionVar = "Modify Office Hours";
  include 'header.php';
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  //Get Current Semester ID
  $sql_semester = "SELECT SemesterID FROM `Semester` WHERE Status='Current'";// WHERE Status='Current'
  $result_semester = mysql_query($sql_semester);
  $semesterRow = mysql_fetch_assoc($result_semester);
  $semesterID = $semesterRow['SemesterID'];




  //----------------------------------------------------------------------------
  if ($_POST['netid'] != null)
  {
    //get values from form
    $netid = $_POST['netid'];


    //Get the faculty member office hours
    $search_OfficeHours_stmt = "SELECT * FROM OfficeHours WHERE NetID = '$netid' AND SemesterID='$semesterID'";
    $result_OfficeHours = mysql_query($search_OfficeHours_stmt);
    $numrowsOH = mysql_num_rows($result_OfficeHours);
    if(!$result_OfficeHours)
    {
      $message = "Unable to get Faculty Office Hours : ".mysql_error();
      echo "
            <script language='javascript'>
              window.alert(\"$message\");
            </script>
      ";
    }
    else if ($numrowsOH == 0)
    {
      echo "<br/><br/><h3 class='subHeading' align='center'>This faculty member does not currently have any office hours scheduled</h3>";
    }
    else
    {
      echo"
      <br/><br/><h3 class='subHeading' align='center'>Select an Office Hour Below to Modify</h2>
      <form method='post' action='officehours_modify_edit.php'>
        <table align='center' cellspacing='20px'>
          <tr>
            <th></th>
            <th>Day</th>
            <th>Time</th>
            <th>Building</th>
            <th>Room</th>
          </tr>
      ";
      while($row = mysql_fetch_assoc($result_OfficeHours))
      {
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
  }
  else
  {
    echo "
          <script language='javascript'>
            window.alert('An error has occurred, please contact the system administrator');
            window.location = 'officehours_modify.php';
          </script>";
  }

?>
