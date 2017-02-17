<?php
	$callToActionVar = "Add Department";
	include 'header.php';
	require('db_cn.inc');
?>
<?php
	if ((isset($_SESSION['NetID'])) && ((string)$_SESSION['Credentials'] == '1'))
	{
    echo "
    <h2 class='contentAction' align='center'>Enter the department information below</h2>
    <div class='bodyContent'>
		<form action='department_add_process.php' method='post'>
			<table align='center'>
				<tr>
					<td><span align='right'>Department Name:</span></td>
					<td><input name='deptname' id='deptname' TYPE='text' SIZE='50' onKeyPress='return hasToBeNumberOrLetter(event)' required/></td>
				</tr>
				<tr>
					<td><span align='right'>Department Code:</span></td>
					<td><input name='deptcode' id='deptcode' TYPE='text' SIZE='50' onKeyPress='return hasToBeLetter(event)' maxlength='3' required/></td>
				</tr>
				";

			echo "</select>
					</td>
				</tr>
				<tr>
					<td><span align='right'>Building:</span></td>
					<td>
						<select name='deptbuilding' id='deptbuilding'>";
							connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
							$sql_building = "SELECT * FROM Building ORDER BY Name DESC";
							$result_building = mysql_query($sql_building);

							while($row = mysql_fetch_assoc($result_building))
							{
								$buildingid = $row['BuildingID'];
								$buildingname = $row['Name'];

								echo "<option value=$buildingid selected>$buildingname</option>";
							}
			echo "</select>
					</td>
				</tr>
				<tr>
					<td><span align='right'>Room Number:</span></td>
					<td><input name='deptroom' id='deptroom' TYPE='text' SIZE='50' onKeyPress='return hasToBeNumber(event)' required/></td>
				</tr>
			</table>
			<p align='center'>
				<input type='submit' value='Submit'/>
				<input type='reset' value='Reset'/>
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
