<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $selected_building = $_POST['buildingid'];
  $sql_building = "SELECT Name FROM Building WHERE BuildingID='$selected_building'";
  $result_building = mysql_query($sql_building); //$result = resource id

  while($row = mysql_fetch_assoc($result_building))
  {
    $bId = $row["BuildingID"];
    $bName = $row["Name"];
    echo json_encode($row)."\n";
  }

?>
