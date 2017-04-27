<?php
	$callToActionVar = "Remove Building";
	include 'header.php';
	require('db_cn.inc');
?>
<?php
	if ((isset($_SESSION['NetID'])) && ((string)$_SESSION['Credentials'] == '1'))
	{
    echo "
    <h2 class='contentAction' align='center' style=\"margin-bottom: -20px;\">Select the building you would like to remove</h2>
    <center><h5><strong>NOTE: To reactivate a building, go to <font color='red'>Buildings > Modify Building</font></strong></h5></center>
    <div class='bodyContent'>
		<form action='building_remove_process.php' method='post'>
			<table align='center'>
				<tr>
				  <td>
            <select name='buildingid' id='buildingid' />";
						  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
              $sql_building = "SELECT * FROM Building WHERE Status='Active' ORDER BY Name";
							$result_building = mysql_query($sql_building);

							while($row = mysql_fetch_assoc($result_building))
							{
								$bName = $row['Name'];
								$bID = $row['BuildingID'];

								echo "<option value=$bID>$bName</option>";
							}
			echo "</select>
          </td>
        </tr>
			</table>
			<p align='center'>
				<input type='submit' value='Remove'/>
			</p>
		</form>
    </div>
    ";

	}
	else
	{
		//echo '<script type='text/javascript'>alert('Please login to view this page')</script>';
		session_destroy();
		echo "<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('Please Login as an Admin to View This Page')
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
