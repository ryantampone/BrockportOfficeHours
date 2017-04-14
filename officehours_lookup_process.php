<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
  //----------------------------------------------------------------------------

  //get values from form
  $facultyName = $_POST['FacultyName'];
  $netid = $_POST['netid'];
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




  //Use department ID to get the department name
  $deparment_name = "SELECT * FROM Department WHERE DepartmentID = '$deptID'";
  $result_deparment_name = mysql_query($deparment_name);
  if(!$result_deparment_name)
  {
    $message = "Unable to get Department Information : ".mysql_error();
    echo "
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = '#';
          </script>
    ";
  }
  else
  {
    while($row = mysql_fetch_assoc($result_deparment_name))
    {
      $deptName = $row['Name'];
      $deptLocation = $row['Location'];
    }
  }




  //Use location ID to get the department location
  $deparment_location = "SELECT * FROM Building WHERE BuildingID = '$deptLocation'";
  $result_deparment_location = mysql_query($deparment_location);
  if(!$result_deparment_location)
  {
    $message = "Unable to get Department Location : ".mysql_error();
    echo "
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = '#';
          </script>
    ";
  }
  else
  {
    while($row = mysql_fetch_assoc($result_deparment_location))
    {
      $buildingName = $row['Name'];
    }
  }




  //Get Current Semester
  $currentSemester = "SELECT * FROM Semester WHERE Status = 'Current'";
  $result_Semester = mysql_query($currentSemester);
  while($row = mysql_fetch_assoc($result_Semester))
  {
    $semesterID = $row['SemesterID'];
    $message = "SemesterID = ".$semesterID;
  }
  /*echo "
        <script language='javascript'>
          window.alert(\"$message\");
          window.location = '#';
        </script>";
        */





  //---------------********Begin GUI*********------------------------
  $callToActionVar = "$firstName $lastName";
  include 'header.php';
  echo "
  <!-- <h2 class='contentAction' align='center'>Faculty Member Information</h2> -->
  <div class='bodyContent'>
  <h3 class='subHeading' align='center'>General Information</h3>
  <hr width='25%'>
  <table align='center'>
    <tr>
      <td>Department:</td>
      <td>$deptName</td>
    </tr>
    <tr>
      <td>Office:</td>
      <td>$buildingName $officeRoomNumber</td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><a href='mailto:$email'>$email</a></td>
    </tr>
    <tr>
      <td>Phone:</td>
      <td>$phoneNumber</td>
    </tr>
  </table>
  ";


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
    <br/><br/><h3 class='subHeading' align='center'>Office Hours</h2>
    <hr width='25%'>
      <table align='center' cellspacing='20px'>
        <tr>
          <th>Day</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Building</th>
          <th>Room Number</th>
        </tr>
    ";
    while($row = mysql_fetch_assoc($result_OfficeHours))
    {
      $day = $row['Day'];

      $startTimeMilitary = (int)$row['StartTime'];
      $startTime_AM_PM = "";
          if ($startTimeMilitary > 1300)
          {
            $startTimeUnparsed = (string)$startTimeMilitary - 1200;
            $startTime_AM_PM = 'PM';
          }
          else if ($startTimeMilitary == 1200)
          {
            $startTimeUnparsed = (string)$startTimeMilitary;
            $startTime_AM_PM = "PM";
          }
          else if ($startTimeMilitary == 0)
          {
            $startTimeUnparsed = "12";
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



      $endTimeMilitary = (int)$row['EndTime'];
      $endTime_AM_PM = "";
          if ($endTimeMilitary >= 1300)
          {
            $endTimeUnparsed = $endTimeMilitary - 1200;
            $endTime_AM_PM = "PM";
          }
          else if ($endTimeMilitary == 1200)
          {
            $endTimeUnparsed = (string)$endTimeMilitary;
            $endTime_AM_PM = "PM";
          }
          else if ($endTimeMilitary == 0)
          {
            $endTimeUnparsed = "12";
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
          <td>$day</td>
          <td>$startTime</td>
          <td>$endTime</td>
          <td>$buildingNameOfficeHours</td>
          <td>$roomNumber</td>
        </tr>
      ";
    }
    echo"
      </table>
    ";
  }





  //----------------------------------------------------------------------------

  //Get the faculty member courses
  $search_Courses_stmt = "SELECT * FROM Course WHERE NetID = '$netid' AND SemesterID='$semesterID'";
  $result_Courses = mysql_query($search_Courses_stmt);
  $numrowsCourses = mysql_num_rows($result_OfficeHours);
  if(!$result_Courses)
  {
    $message = "Unable to get Faculty Member's Courses : ".mysql_error();
    echo "
          <script language='javascript'>
            window.alert(\"$message\");
          </script>
    ";
  }
  else if ($numrowsCourses == 0)
  {
    echo "<br/><br/><h3 class='subHeading' align='center'>This faculty member does not currently have any courses to view</h3>";
  }
  else
  {
    echo"
    <br/><br/><h3 class='subHeading' align='center'>Courses</h2>
    <hr width='25%'>
      <table align='center' cellspacing='25px'>
        <tr>
          <th>Department</th>
          <th>Number</th>
          <th>Name</th>
          <th>Type</th>
          <th>Location</th>
          <th>Days</th>
          <th>Start Time</th>
          <th>End Time</th>
        </tr>
    ";
    while($row = mysql_fetch_assoc($result_Courses))
    {
      $courseID = $row['CourseID'];
      $courseName = $row['CourseName'];
      $deptCode = $row['DepartmentCode'];
      $courseNumber = $row['CourseNumber'];
      $courseSectionNumber = $row['CourseSectionNumber'];
      $courseType = $row['CourseType'];
      $buildingID = $row['BuildingID'];
            //Use building ID to get the department name
            $building_name_course = "SELECT Name FROM Building WHERE BuildingID = '$buildingID'";
            $result_building_name_course = mysql_query($building_name_course);
            if(!$result_building_name_course)
            {
              $message = "Unable to get course building : ".mysql_error();
              echo "
                    <script language='javascript'>
                      window.alert(\"$message\");
                      window.location = '#';
                    </script>
              ";
            }
            else
            {
              while($row = mysql_fetch_assoc($result_building_name_course))
              {
                $buildingName = $row['Name'];
              }
            }
      $roomNumber = $row['RoomNumber'];
      $courseDay1 = $row['CourseDay1'];
      $courseDay2 = $row['CourseDay2'];
      $courseDay3 = $row['CourseDay3'];
      $startTime = $row['StartTime'];
      $endTime = $row['EndTime'];


      echo"
        <tr>
          <td>$deptCode</td>
          <td>$courseNumber.$courseSectionNumber</td>
          <td>$courseName</td>
          <td>$courseType</td>
          <td>$buildingName $roomNumber</td>
          <td>$courseDay1 $courseDay2 $courseDay3</td>
          <td>$startTime</td>
          <td>$endTime</td>

      ";
    }
  }

  //show_result($result_Semester, $result_FacInfo, $result_OfficeHours, $result_Courses);

  /*
  $message2 = "Email ".$email.", Office Room ".$roomNumber.", Course Name ".$courseName;
  echo "
        <script language='javascript'>
          window.alert(\"$message2\");
        </script>
  ";
  */
?>
