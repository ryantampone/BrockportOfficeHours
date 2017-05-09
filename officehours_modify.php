<?php
	$callToActionVar = "Modify Office Hours";
	include 'header.php';
	require('db_cn.inc');
	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
	$deptID = (string)$_SESSION['DepartmentID'];
?>
<?php
	//if ((isset($_SESSION['NetID'])) && ((string)$_SESSION['Credentials'] == '2') || ((string)$_SESSION['Credentials'] == '1'))
	//{
		//Getting Semester Information
		$sql_semester = "SELECT * FROM `Semester` ORDER BY 'Status'";// WHERE Status='Current'
		$result_semester = mysql_query($sql_semester);

		//Get Building ID from department
		$sql_location = "SELECT Location FROM `Department` WHERE DepartmentID='$deptID'";
		$result_location = mysql_query($sql_location);
		while($row = mysql_fetch_assoc($result_location))
		{
			$buildingID = $row['Location'];
		}

		//Get Building Name From Building ID above
		$sql_building = "SELECT Name FROM `Building` WHERE BuildingID='$buildingID'";
		$result_building = mysql_query($sql_building);
		while($row = mysql_fetch_assoc($result_building))
		{
			$buildingName = $row['Name'];
		}




		//Form for admins
		if ((string)$_SESSION['Credentials'] == '1')
		{
			echo '<link href="css/searchStyles.css" type="text/css" rel="stylesheet" />';
			echo "
			<h2 class='contentAction' align='center'>Search for the Professor Below</h2>
	    <div class='bodyContent'>
			<form action='officehours_modify_process.php' method='post' autocomplete='false'>
				<table align='center'>
					<tr>
						<td><input type='search' name='FacultyName' id='FacultyName' onKeyUp='updateFaculty()' placeholder='Search...' autocomplete='off'></td>
						<td valign='center'><input type='submit' value='Go'/></td>
					</tr>
					<tr>
						<td>
						<!--
	            <select name='netid' id='netid' style=\"width:160px;\" onpaste='return false' required>
	              <option disable selected hidden value=''>Select one</option>
							</select>
							-->

							<select name='netid' id='netid' multiple='multiple' size='1'>
								<option disable selected hidden value=''>Select one</option>
							</select>
	          </td>
					</tr>
				</table>
				<p align='center'>

				</p>
			</form>
	    </div>
	    ";
		}








		//Form for secratary
		else if ((string)$_SESSION['Credentials'] == '2')
		{
			//getting the department code of the secratary

			/*echo "<SCRIPT LANGUAGE='JavaScript'>
				 window.alert('$deptID')
				 window.location.href='#';
				 </SCRIPT>";*/

			$departmentID = (string)$_SESSION['DepartmentID'];
			$sql_fac_members = "SELECT * FROM `Faculty` WHERE ((DepartmentID = $departmentID) AND (Status = 'Active')) ORDER BY 'LastName'";// WHERE Status='Current'
			$result_fac_members = mysql_query($sql_fac_members);
			echo "
	    <h2 class='contentAction' align='center'>Please Select a Faculty Member Below</h2>
	    <div class='bodyContent'>
			<form action='officehours_modify_process.php' method='post'>
				<table align='center'>
					<tr>
						<td><span align='right'>Faculty Member:</span></td>
						<td>
							<select name='netid' id='netid' style=\"width:160px;\">";
							while($row = mysql_fetch_assoc($result_fac_members))
							{
								$LN = $row['LastName'];
								$FN = $row['FirstName'];
								$netID = $row['NetID'];

                echo "<option value=$netID>$LN , $FN</option>";
							}echo "
					</tr>
				</table>
				<p align='center'>
					<input type='submit' id='submitButton' value='Submit'/>
					<input type='reset' value='Reset'/>
				</p>
			</form>
	    </div>
	    ";
		}








		//Form for Faculty
		else if ((string)$_SESSION['Credentials'] == '3')
		{
			//Pass NetID to process File
			$facNetID = (string)$_SESSION['NetID'];

			echo"
			<form id='facOfficeHourseModify' action='officehours_modify_process.php' method='post'>
				<table align='center'>
					<tr>
						<td>
							<input type='hidden' name='netid' id='netid' value='$facNetID'>
						</td>
					</tr>
				</table>

				<script type='text/javascript'>
					document.getElementById('facOfficeHourseModify').submit();
				</script>
			";
		}


	else
	{
		//echo '<script type='text/javascript'>alert('Please login to view this page')</script>';
		session_destroy();
		echo "<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('Please Login to View This Page')
			 window.location.href='index.php';
			 </SCRIPT>";
	}

	echo "
	</div> <!-- End pagecontent Div -->
	</div> <!-- End pagebody Div -->
	<script src='scripts/jquery-3.1.1.js'></script>
	<script src='scripts/officehours_lookup_ajax.js'></script>
	</body>
	</html>
	";
?>

</body>
</html>
