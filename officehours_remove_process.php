<?php
	$callToActionVar = "Modify Office Hours";
	include 'header.php';
	require('db_cn.inc');
	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
?>
<?php
	//Get Value from OH Modify process
	$officeHoursID = $_POST['officeHoursRadio'];

	//Get Office Hours Info
	$sql_delete = "DELETE FROM OfficeHours WHERE ID='$officeHoursID'";
	$result_delete = mysql_query($sql_delete);

  if(!$result_delete)
    echo "Error in removing selected office hours: ".mysql_error();
  else
  {
		echo "<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('Office Hours removed successfully.');
			 window.location.href='index.php';
			 </SCRIPT>";
	}

echo "
</div> <!-- End pagecontent Div -->
</div> <!-- End pagebody Div -->
</body>
</html>
"
?>

</body>
</html>
