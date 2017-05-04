<?php
  session_start();
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  // Course variables
  $course_id = $_POST['courseid'];
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

  /*echo "<br/>";
  echo "Course name = ".$course_name;
  echo "<br/>Course name escaped = ".$course_name_esc;
  echo "<br/>Department code = ".$dept_code;
  echo "<br/>Course number = ".$course_num;
  echo "<br/>Section number = ".$course_section;
  echo "<br/>Course type = ".$course_type;
  echo "<br/>Semester = ".$semester;
  echo "<br/>Faculty NetID = ".$fac_netid;
  echo "<br/>Location = ".$location;
  echo "<br/>Room number = ".$room_num;
  echo "<br/>Course Day 1 = ".$courseDay1;
  echo "<br/>Course Day 2 = ".$courseDay2;
  echo "<br/>Course Day 3 = ".$courseDay3;
  echo "<br/>Start time = ".$start_time;
  echo "<br/>End time = ".$end_time;*/

  $update_sql = "UPDATE Course SET CourseName='$course_name_esc', DepartmentCode='$dept_code', CourseNumber='$course_num', CourseSectionNumber='$course_section', CourseType='$course_type', SemesterID='$semester', NetID='$fac_netid', BuildingID='$location', RoomNumber='$room_num', CourseDay1='$courseDay1', CourseDay2='$courseDay2', CourseDay3='$courseDay3', StartTime='$start_time', EndTime='$end_time' WHERE CourseID='$course_id'";

  $result = mysql_query($update_sql);

  if(!$result)
  {
    $message = "Unable to update course : ".mysql_error();
    echo "
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = 'course_modify_lookup.php';
          </script>
    ";
  }
  else
  {
    $message = "Course '$course_name' updated successfully.";
    echo "
      <script language='javascript'>
        window.alert(\"$message\");
        window.location = 'course_modify_lookup.php';
      </script>
    ";
  }

?>
