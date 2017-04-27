<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $buildingid = $_POST['buildingid'];

  $sql_building_get = "SELECT * FROM Building WHERE BuildingID='$buildingid'";
  $result_building_get = mysql_query($sql_building_get);

  while($row = mysql_fetch_assoc($result_building_get))
  {
    $buildingName = $row["Name"];
  }

  $sql_building_update = "UPDATE Building SET Status='Active' WHERE BuildingID='$buildingid'";
  $result_building_update = mysql_query($sql_building_update);

  if(!$result_building_update)
    echo "Error in updating $buildingName : ".mysql_error();
  else
    echo "$buildingName department reactivated successfully.\n";
?>
