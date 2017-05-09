<?php
  session_start();
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $year = $_POST['year'];
  $term = $_POST['term'];

  $sql_dup_semester = "SELECT * FROM Semester WHERE (Year='$year' AND Term='$term')";
  $result_dup_semester = mysql_query($sql_dup_semester);

  if(!$result_dup_semester)
  {
    $message = "Error in retrieving semester data: ".mysql_error();

    echo "
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = 'new_semester.php';
          </script>
    ";
  }
  else
  {
    if(mysql_num_rows($result_dup_semester) > 0)
    {
      $message = "This semester already exists.\\nPlease enter a new semester.";

      echo "
            <script language='javascript'>
              window.alert(\"$message\");
              window.location = 'new_semester.php';
            </script>
      ";
    }
    else
    {
      // Change the 'Current' semester to 'Previous'
      $sql_update_prev = "UPDATE Semester SET Status='Previous' WHERE Status='Current'";
      $result_update_prev = mysql_query($sql_update_prev);

      if(!$result_update_prev)
      {
        $message = "Error in updating current semester: ".mysql_error();

        echo "
              <script language='javascript'>
                window.alert(\"$message\");
                window.location = 'new_semester.php';
              </script>
        ";
      }

      $sql_semester = "INSERT INTO Semester (Year, Term, Status) VALUES ('$year', '$term', 'Current')";
      $result_semester = mysql_query($sql_semester);

      if(!$result_semester)
      {
        $message = "Unable to add semester : ".mysql_error();
        echo "
              <script language='javascript'>
                window.alert(\"$message\");
                window.location = 'new_semester.php';
              </script>
        ";
      }
      else
      {
        $message = "New semester added successfully.\\n$term $year is now the current semester.";
        echo "
          <script language='javascript'>
            window.alert(\"$message\");
            window.location = 'index.php';
          </script>
        ";
      }
    }
  }



?>
