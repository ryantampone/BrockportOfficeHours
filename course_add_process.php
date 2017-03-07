<?php
  session_start();
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $course_name = $_POST['coursename'];
  $course_name_esc = mysql_real_escape_string($course_name);
  $dept_code = $_POST['deptcode'];
  $course_num = $_POST['coursenum'];
  $course_section = $_POST['coursesection'];
  $course_type = $_POST['coursetype'];
  $semester = $_POST['semester'];
  $fac_name = $_POST['netid'];
  $location = $_POST['location'];
  $room_num = $_POST['room'];
  $days = $_POST['days'];
  $start_time = $_POST['start'];
  $end_time = $_POST['end'];

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
  echo "<br/>Days = ".$days;
  echo "<br/>Start time = ".$start_time;
  echo "<br/>End time = ".$end_time;


  /*$sql = "INSERT INTO Department (Name, Code, Location, Room, Status)
    VALUES ('$deptname', '$deptcode', '$deptbuilding', '$deptroom', '$status')";
  $result = mysql_query($sql);

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
