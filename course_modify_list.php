<?php
  $callToActionVar = "Modify Course";
  include 'header.php';
  include 'dbh.php';
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $deptid = $_POST['deptid'];
  $sql_dept = "SELECT Name, Code FROM Department WHERE DepartmentID='$deptid'";
  $result_dept = mysql_query($sql_dept);

  while($row = mysql_fetch_assoc($result_dept))
  {
    $dept_name = $row['Name'];
    $dept_code = $row['Code'];
  }

  echo"
  <form id='modify_course' action='course_modify.php' method='post'>
  <h3 class='subHeading' align='center'>$dept_name Courses</h2>
  <hr width='25%'>
    <table align='center' cellspacing='25px'>
      <tr>
        <th></th>
        <th>Course Number</th>
        <th>Name</th>
        <th>Type</th>
        <th>Location</th>
        <th>Days</th>
        <th>Time</th>
      </tr>
  ";

  $sql_courses = "SELECT * FROM Course WHERE DepartmentCode='$dept_code' ORDER BY CourseNumber";
  $result_courses = mysql_query($sql_courses);

  while($row = mysql_fetch_assoc($result_courses))
  {
    $course_id = $row['CourseID'];
    $course_name = $row['CourseName'];
    $course_num = $row['CourseNumber'];
    $course_section = $row['CourseSectionNumber'];
    $course_type = $row['CourseType'];
    $professor_netid = $row['NetID'];
    $course_building = $row['BuildingID'];
    $course_room = $row['RoomNumber'];
    $course_day1 = $row['CourseDay1'];
    $course_day2 = $row['CourseDay2'];
    $course_day3 = $row['CourseDay3'];
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

        $building_name_course = "SELECT Name FROM Building WHERE BuildingID = '$course_building'";
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

        echo"
          <tr>
            <td><input type='button' id='$course_id' value='Modify' onclick='getButtonId(this.id);'/>
            <td>$dept_code $course_num.$course_section</td>
            <td>$course_name</td>
            <td>$course_type</td>
            <td>$buildingName $course_room</td>
            <td>$course_day1 $course_day2 $course_day3</td>
            <td align='center'>$startTime - $endTime</td>
          </tr>
          <tr>
            <td><input type='hidden' name='courseCode' value='$dept_code' />
          </tr>
        ";

  }

  echo "
      <input type='hidden' id='buttonValue' name='buttonValue' />
    </table>
    </form>";

?>
