<?php
	$callToActionVar = "Add Facutly Office Hours";
	include 'header.php';
	require('db_cn.inc');
	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
?>
<?php
	if ((isset($_SESSION['NetID'])) && ((string)$_SESSION['Credentials'] == '2') || ((string)$_SESSION['Credentials'] == '1'))
	{
		//Setup Values for forms
		$sql_semester = "SELECT * FROM `Semester`";// WHERE Status='Current'
		$result_semester = mysql_query($sql_semester);





		if ((string)$_SESSION['Credentials'] == '2')
		{
			//getting the department code of the secratary
			$deptID = (string)$_SESSION['DepartmentID'];

			echo "<SCRIPT LANGUAGE='JavaScript'>
				 window.alert('$deptID')
				 window.location.href='#';
				 </SCRIPT>";
			echo "
	    <h2 class='contentAction' align='center'>Select a factuly member to add their office hours</h2>
	    <div class='bodyContent'>
			<form action='officehours_add_process.php' method='post'>
				<table align='center'>
					<tr>
						<td><span align='right'>Semester:</span></td>
						<td>
							<select name='semester' id='semester'>";
							while($row = mysql_fetch_assoc($result_semester))
							{
								$semesterID = $row['SemesterID'];
								$term = $row['Term'];
								$year = $row['Year'];
								$status = $row['Status'];
								echo "<option value=$semesterID selected>$term $year ($status)</option>";
							}echo "

					</tr>
					<tr>
						<td><span align='right'>Facult Member:</span></td>
						<td>
							<select name='facultyMember' id='facultyMember'>";

								$sql_fac = "SELECT * FROM `Faculty` WHERE DepartmentID='$deptID' ORDER BY FirstName;";
								$result_fac = mysql_query($sql_fac);
								while($row = mysql_fetch_assoc($result_fac))
								{
									$facNetID = $row['NetID'];
									$facFN = $row['FirstName'];
									$facLN = $row['LastName'];

									echo "<option value=$facNetID selected>$facFN $facLN</option>";
								}
				echo "</select>
						</td>
					</tr>
					<tr>
						<td><span align='right'>Room Number:</span></td>
						<td><input name='deptroom' id='deptroom' TYPE='text' SIZE='50' onKeyPress='return hasToBeNumber(event)' onpaste='return false;' required/></td>
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
