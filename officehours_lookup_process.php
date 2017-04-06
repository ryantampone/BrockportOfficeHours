<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  //Get Current Semester
  $currentSemester = "SELECT * FROM Semester WHERE Status = 'Current'";
  $result_Semester = mysql_query($currentSemester);
  while($row = mysql_fetch_assoc($result_Semester))
  {
    $semesterID = $row['SemesterID'];
    $message = "SemesterID = ".$semesterID;
  }
  echo "
        <script language='javascript'>
          window.alert(\"$message\");
          window.location = '#';
        </script>";

  //----------------------------------------------------------------------------

  //get values from form
  $facultyName = $_POST['FacultyName'];
  $netid = $_POST['netid'];
  echo "
        <script language='javascript'>
          window.alert(\"$netid\");
          window.location = '#';
        </script>";

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
    }
  }

  //----------------------------------------------------------------------------

  //Get the faculty member office hours
  $search_OfficeHours_stmt = "SELECT * FROM OfficeHours WHERE NetID = '$netid' AND SemesterID='$semesterID'";
  $result_OfficeHours = mysql_query($search_OfficeHours_stmt);
  if(!$result_OfficeHours)
  {
    $message = "Unable to get Faculty Office Hours : ".mysql_error();
    echo "
          <script language='javascript'>
            window.alert(\"$message\");
          </script>
    ";
  }
  else
  {
    while($row = mysql_fetch_assoc($result_OfficeHours))
    {
      $day = $row['Day'];
      $startTime = $row['StartTime'];
      $endTime = $row['EndTime'];
      $location = $row['Location'];
      $roomNumber = $row['RoomNumber'];
    }
  }


  //----------------------------------------------------------------------------

  //Get the faculty member courses
  $search_Courses_stmt = "SELECT * FROM Course WHERE NetID = '$netid' AND SemesterID='$semesterID'";
  $result_Courses = mysql_query($search_Courses_stmt);
  if(!$result_Courses)
  {
    $message = "Unable to get Faculty Member's Courses : ".mysql_error();
    echo "
          <script language='javascript'>
            window.alert(\"$message\");
          </script>
    ";
  }
  else
  {
    while($row = mysql_fetch_assoc($result_OfficeHours))
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

  show_result($result_Semester, $result_FacInfo, $result_OfficeHours, $result_Courses);

  /*
  $message2 = "Email ".$email.", Office Room ".$roomNumber.", Course Name ".$courseName;
  echo "
        <script language='javascript'>
          window.alert(\"$message2\");
        </script>
  ";
  */
?>
