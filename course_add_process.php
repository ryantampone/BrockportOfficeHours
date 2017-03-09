<?php
  session_start();
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  // Course variables
  $course_name = $_POST['coursename'];
  $course_name_esc = mysql_real_escape_string($course_name);
  $dept_code = $_POST['deptcode'];
  $course_num = $_POST['coursenum'];
  $course_section = $_POST['coursesection'];
  $course_type = $_POST['coursetype'];
  $semester = $_POST['semester'];
  $fac_netid = $_POST['netid'];
  $location = $_POST['location'];
  $room_num = $_POST['room'];
  $courseDay1 = "NULL";
  $courseDay2 = "NULL";
  $courseDay3 = "NULL";
  $start_time = $_POST['start'];
  $end_time = $_POST['end'];

  // Days of the week selected
  if($_POST["sundayBox"] !== NULL)
    $days = $days.$_POST["sundayBox"]." ";
  if($_POST["mondayBox"] !== NULL)
    $days = $days.$_POST["mondayBox"]." ";
  if($_POST["tuesdayBox"] !== NULL)
    $days = $days.$_POST["tuesdayBox"]." ";
  if($_POST["wednesdayBox"] !== NULL)
    $days = $days.$_POST["wednesdayBox"]." ";
  if($_POST["thursdayBox"] !== NULL)
    $days = $days.$_POST["thursdayBox"]." ";
  if($_POST["fridayBox"] !== NULL)
    $days = $days.$_POST["fridayBox"]." ";
  if($_POST["saturdayBox"] !== NULL)
    $days = $days.$_POST["saturdayBox"]." ";
  if($days === NULL)
    $days = "No days selected";
  else
  {
    // Parse days selected
    $days_array = split(" ", $days);
    for($i = 0; $i < sizeof($days_array)-1; $i++)
    {
      if($days_array[$i] !== NULL)
      {
        if($i + 1 == 1)
          $courseDay1 = $days_array[$i];
        elseif($i + 1 == 2)
          $courseDay2 = $days_array[$i];
        elseif($i + 1 == 3)
          $courseDay3 = $days_array[$i];
      }
    }
  }

  // Formatted time strings
  $start_time_parse = split(":", $start_time);
  $end_time_parse = split(":", $end_time);
  $start_time = implode("", $start_time_parse);
  $end_time = implode("", $end_time_parse);

  echo "<br/>";
  echo "Course name = ".$course_name;
  echo "<br/>Course name escaped = ".$course_name_esc;
  echo "<br/>Department code = ".$dept_code;
  echo "<br/>Course number = ".$course_num;
  echo "<br/>Section number = ".$course_section;
  echo "<br/>Course type = ".$course_type;
  echo "<br/>Semester = ".$semester;
  echo "<br/>Faculty NetID = ".$fac_name;
  echo "<br/>Location = ".$location;
  echo "<br/>Room number = ".$room_num;
  echo "<br/>Course Day 1 = ".$courseDay1;
  echo "<br/>Course Day 2 = ".$courseDay2;
  echo "<br/>Course Day 3 = ".$courseDay3;
  echo "<br/>Start time = ".$start_time;
  echo "<br/>End time = ".$end_time;

  /*$insert_sql = "INSERT INTO Course (CourseName, DepartmentCode, CourseNumber, CourseSectionNumber, CourseType, SemesterID, NetID, BuildingID, RoomNumber, CourseDay1, CourseDay2, CourseDay3, StartTime, EndTime) VALUES ('$course_name_esc', '$dept_code', '$course_num', '$course_section', '$course_type', '$semester', '$fac_netid', '$location', '$room_num', '$courseDay1', '$courseDay2', '$courseDay3', '$start_time', '$end_time')";
  $result = mysql_query($insert_sql);

  if(!$result)
  {
    $message = "Unable to add department : ".mysql_error();
    echo "
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = 'department_add.php';
          </script>
    ";
  }
  else
  {
    $message = "Department '$deptname' added successfully.";
    echo "
      <script language='javascript'>
        window.alert(\"$message\");
        window.location = 'index.php';
      </script>
    ";
  }*/

?>
