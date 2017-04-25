<?php
  include 'header2.php';

  function show_result($result_Semester, $result_FacInfo, $result_OfficeHours, $result_Courses)
  {
    //Semester
    while($row = mysql_fetch_assoc($result_Semester))
    {
      $semesterID = $row['SemesterID'];
      $message = "SemesterID = ".$semesterID;
    }
    echo "
      <p>Semester is: $semesterID</p>
    ";



    //Faculty Info
    while($row = mysql_fetch_assoc($result_FacInfo))
    {
      $deptID = $row['DepartmentID'];
      $officeRoomNumber = $row['OfficeRoomNumber'];
      $email = $row['Email'];
      $phoneNumber = $row['PhoneNumber'];
    }
    echo "
      <p>Department ID is: $deptID</p>
      <p>Office Room Number is: $officeRoomNumber</p>
      <p>Email is: $email</p>
      <p>Phone is: $phoneNumber</p>
    ";




    //Office Hours
    echo"
      <table align='center'>
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
      $startTime = $row['StartTime'];
      $endTime = $row['EndTime'];
      $location = $row['Location'];
      $roomNumber = $row['RoomNumber'];
      echo"
        <tr>
          <td>$day</td>
          <td>$startTime</td>
          <td>$endTime</td>
          <td>$location</td>
          <td>$roomNumber</td>
        </tr>
      ";
    }
    echo"
      </table>
    ";



    //Courses
    while($row = mysql_fetch_assoc($result_Courses))
    {
      $courseID = $row['CourseID'];
      $courseName = $row['CourseName'];
      $courseCode = $row['DepartmentCode'];
      $courseNumber = $row['CourseNumber'];
      $courseSectionNumber = $row['CourseSectionNumber'];
      $courseType = $row['CourseType'];
      $buildingID = $row['BuildingID'];
      $roomNumber = $row['RoomNumber'];
      $courseDay1 = $row['CourseDay1'];
      $courseDay2 = $row['CourseDay2'];
      $courseDay3 = $row['CourseDay3'];
      $startTime = $row['StartTime'];
      $endTime = $row['EndTime'];
    }

  }





  echo "
  </div> <!-- End pagecontent Div -->
  </div> <!-- End pagebody Div -->
  <script src='scripts/jquery-3.1.1.js'></script>
  <script src='scripts/officehours_lookup_ajax.js'></script>
  </body>
  </html>
  ";
?>
