<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  //get values from form
  $buildingid = $_POST['buildingid'];

  $sql_building_get = "SELECT * FROM Building WHERE BuildingID='$buildingid'";
  $result_building_get = mysql_query($sql_building_get);

  while($row = mysql_fetch_assoc($result_building_get))
  {
    $bName = $row['Name'];
  }

  $sql_building_remove = "UPDATE Building SET Status='Inactive' WHERE BuildingID='$buildingid'";
  $result_building_remove = mysql_query($sql_building_remove);

  if(!$result_building_remove)
    $message = "Unable to remove $bName building: ".mysql_error();
  else
    $message = "$bName building removed successfully.";

  echo "
    <script language='javascript'>
      window.alert(\"$message\");
      window.location = 'index.php';
    </script>
  ";

?>
