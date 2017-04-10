<?php
  require('db_cn.inc');
  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $netid = $_POST['nid'];
  $sql_fac_id = "UPDATE Users SET Status='Active' WHERE NetID='$netid'";
  $result = mysql_query($sql_fac_id); //$result = resource id

  if(!$result)
    echo "Error in updating '$netid': ".mysql_error();
  else
    echo "User '$netid' reactivated successfully.\n";
?>
