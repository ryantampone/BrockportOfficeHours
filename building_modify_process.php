<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $newName = $_POST['newName'];
  $buildingId = $_POST['buildingID'];
  $sql_oldName = "SELECT Name FROM Building WHERE BuildingID='$buildingId'";
  $result_oldName = mysql_query($sql_oldName);

  while($row = mysql_fetch_assoc($result_oldName))
  {
    $oldName = $row['Name'];
  }

  $esc_newName = mysql_real_escape_string($newName);

  $sql_update_building = "UPDATE Building SET Name='$esc_newName' WHERE BuildingID='$buildingId'";
  $result_building = mysql_query($sql_update_building);

  if(!$result_building)
    $message = "Error updating $oldName building: ".mysql_error();
  else
    $message = "$oldName building updated successfully.";

  echo "
    <script language='javascript'>
      window.alert(\"$message\");
      window.location = 'index.php';
    </script>
  ";

?>
