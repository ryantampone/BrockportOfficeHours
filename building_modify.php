<?php
	$callToActionVar = "Modify Building";
	include 'header.php';
	require('db_cn.inc');
?>
<?php
	if ((isset($_SESSION['NetID'])) && ((string)$_SESSION['Credentials'] == '1'))
	{
    echo "
    <h2 class='contentAction' align='center'>Select the building you would like to modify</h2>
    <div class='bodyContent'>
		<form action='building_modify_process.php' method='post'>
			<table align='center'>
				<tr>
					<td>
						<select name='buildingID' id='buildingID' onchange='renameBuilding();'>
              <option disable selected hidden>Select a building</option>";
							connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
							$sql_building = "SELECT * FROM Building ORDER BY Name";
							$result_building = mysql_query($sql_building);

							while($row = mysql_fetch_assoc($result_building))
							{
								$buildingName = $row['Name'];
								$buildingID = $row['BuildingID'];

								echo "<option value=$buildingID>$buildingName</option>";
							}
			echo "</select>
					</td>
				</tr>
			</table>
      <table align='center' style=\"padding-top: 30px;\">
        <tr>
          <td><span hidden id='buildingLabel'>New Building Name:</span></td>
          <td><input hidden type='text' id='newName' name='newName' /></td>
        </tr>
      </table>
			<table align='center'>
				<tr>
					<td><span hidden id='statusLabel'>This building is currently inactive.</span></td>
				</tr>
			</table>
			<p align='center'>
				<input id='reactivateButton' type='button' value='Reactivate Building' onclick='reactivateBuilding();' style=\"display: none;\" />
				<input id='submit' type='submit' value='Submit' style=\"display: none;\" />
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
<script src='scripts/jquery-3.1.1.js'></script>
<script src='scripts/building_ajax.js'></script>
<script src='scripts/building_reactivate_ajax.js'></script>
</body>
</html>
"
?>

</body>
</html>
