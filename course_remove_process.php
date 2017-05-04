<?php
  session_start();
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  // Course variables
  $course_id = $_POST['courseid'];
  $course_name = $_POST['coursename'];

  $sql_delete = "DELETE FROM Course WHERE CourseID='$course_id'";

  $result = mysql_query($sql_delete);

  if(!$result)
  {
    $message = "Unable to remove course : ".mysql_error();
    echo "
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = 'course_remove_lookup.php';
          </script>
    ";
  }
  else
  {
    $message = "Course '$course_name' removed successfully.";
    echo "
      <script language='javascript'>
        window.alert(\"$message\");
        window.location = 'course_remove_lookup.php';
      </script>
    ";
  }

?>
