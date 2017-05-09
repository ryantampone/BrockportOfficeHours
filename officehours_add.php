<?php
	$callToActionVar = "Add Faculty Office Hours";
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
			echo "
	    <h2 class='contentAction' align='center'>Enter the information for the office hours you would like to add</h2>
	    <div class='bodyContent'>
			<form action='officehours_add_process.php' method='post'>
				<table align='center'>
					<tr>
						<td><span align='right'>Semester:</span></td>
						<td>
							<select name='semester' id='semester' style=\"width:160px;\">
							<option disable selected hidden value=''>Select one</option>";
							while($row = mysql_fetch_assoc($result_semester))
							{
								$semester_id = $row['SemesterID'];
								$semester_term = $row['Term'];
								$semester_year = $row['Year'];
								$status = $row['Status'];
								if($status == 'Current')
                  echo "<option value=$semester_id selected>$semester_term $semester_year (Current)</option>";
                else echo "<option value=$semester_id>$semester_term $semester_year</option>";
								//echo "<option value=$semesterID selected>$term $year ($status)</option>";
							}


					echo "
					<tr>
						<td><span align='right'>Department:</span></td>
							<td>
								<select name='deptcode' id='deptcode' onchange='updateFaculty();' style=\"width:160px;\" required>
									<option disable selected hidden value=''>Select one</option>";
									$sql_dept_code = "SELECT Code FROM Department ORDER BY Code";
									$result_dept_code = mysql_query($sql_dept_code);

									while($row = mysql_fetch_assoc($result_dept_code))
									{
										$deptcode = $row['Code'];
										echo "<option value=$deptcode>$deptcode</option>";
									}
								echo"</select>
							</td>
					</tr>
					<tr>
						<td><span align='right'>Faculty Name:</span></td>
						<td>
							<select name='netid' id='netid' style=\"width:160px;\" required>
								<option disable selected hidden value=''>Select one</option>
							</select>
						</td>
					</tr>
					<tr>
	          <td><span align='right'>Location:</span></td>
						<td>
							<select id='location' name='location'>";

							// Get all Buildings (for admin adding office hours)
							$sql_all_buildings = "SELECT * FROM Building WHERE Status='Active' ORDER BY Name";
							$result_all_buildings = mysql_query($sql_all_buildings);
							while($row = mysql_fetch_assoc($result_all_buildings))
							{
								$bName = $row['Name'];
								$bId = $row['BuildingID'];
								echo"<option value=$bId>$bName</option>";
							}
						echo"
						</select>
						</td>
	        </tr>
					<tr>
						<td><span align='right'>Room Number:</span></td>
						<td><input name='deptroom' id='deptroom' TYPE='text' SIZE='25' onKeyPress='return hasToBeNumber(event)' onpaste='return false;' required/></td>
					</tr>
					<tr>
						<td><span align='right'>Days:</span></td>
						<td>
							<table>
								<tr><td><input type='radio' name='days' value='Sunday'>Sunday</td></tr>
								<tr>
									<td><input type='radio' name='days' value='Monday'>Monday</td>
									<td><input type='radio' name='days' value='Wednesday'>Wednesday</td>
									<td><input type='radio' name='days' value='Friday'>Friday</td>
								</tr>
								<tr>
									<td><input type='radio' name='days' value='Tuesday'>Tuesday</td>
									<td><input type='radio' name='days' value='Thursday'>Thursday</td>
								</tr>
								<tr><td><input type='radio' name='days' value='Saturday'>Saturday</td></tr>
							</table>
						</td>
					</tr>
					<tr>
	          <td><span align='right'>Start Time:</span></td>
	          <td><input name='start' id='start' TYPE='time' onchange='checkTime();' onpaste='return false' required/></td>
	        </tr>
	        <tr>
	          <td><span align='right'>End Time:</span></td>
	          <td><input name='end' id='end' TYPE='time' onchange='checkTime();' onpaste='return false' required/></td>
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








		//Form for secratary
		if ((string)$_SESSION['Credentials'] == '2')
		{
			//getting the department code of the secratary

			/*echo "<SCRIPT LANGUAGE='JavaScript'>
				 window.alert('$deptID')
				 window.location.href='#';
				 </SCRIPT>";*/
			echo "
	    <h2 class='contentAction' align='center'>Enter the information for the office hours you would like to add</h2>
	    <div class='bodyContent'>
			<form action='officehours_add_process.php' method='post'>
				<table align='center'>
					<tr>
						<td><span align='right'>Semester:</span></td>
						<td>
							<select name='semester' id='semester' style=\"width:160px;\">";
							while($row = mysql_fetch_assoc($result_semester))
							{
								$semester_id = $row['SemesterID'];
								$semester_term = $row['Term'];
								$semester_year = $row['Year'];
								$status = $row['Status'];
								if($status == 'Current')
                  echo "<option value=$semester_id selected>$semester_term $semester_year (Current)</option>";
                else echo "<option value=$semester_id>$semester_term $semester_year</option>";
								//echo "<option value=$semesterID selected>$term $year ($status)</option>";
							}echo "

					</tr>
					<tr>
						<td><span align='right'>Faculty Name:</span></td>
						<td>
							<select name='netid' id='netid' style=\"width:160px;\">";

								$sql_fac = "SELECT * FROM `Faculty` WHERE DepartmentID='$deptID' ORDER BY FirstName;";
								$result_fac = mysql_query($sql_fac);
								while($row = mysql_fetch_assoc($result_fac))
								{
									$facNetID = $row['NetID'];
									$facFN = $row['FirstName'];
									$facLN = $row['LastName'];

									echo "<option value=$facNetID selected>$facLN, $facFN</option>";
								}
				echo "</select>
						</td>
					</tr>
					<tr>
	          <td><span align='right'>Location:</span></td>
						<td>
							<select id='location' name='location'>";

							// Get all Buildings (for admin adding office hours)
							$sql_all_buildings = "SELECT * FROM Building WHERE Status='Active' ORDER BY Name";
							$result_all_buildings = mysql_query($sql_all_buildings);
							while($row = mysql_fetch_assoc($result_all_buildings))
							{
								$bName = $row['Name'];
								$bId = $row['BuildingID'];
								echo"<option value=$bId>$bName</option>";
							}
						echo"
						</select>
						</td>
	        </tr>
					<tr>
						<td><span align='right'>Room Number:</span></td>
						<td><input name='deptroom' id='deptroom' TYPE='text' SIZE='25' onKeyPress='return hasToBeNumber(event)' onpaste='return false;' required/></td>
					</tr>
					<tr>
						<td><span align='right'>Days:</span></td>
						<td>
							<table>
								<tr><td><input type='radio' name='days' value='Sunday'>Sunday</td></tr>
								<tr>
									<td><input type='radio' name='days' value='Monday'>Monday</td>
									<td><input type='radio' name='days' value='Wednesday'>Wednesday</td>
									<td><input type='radio' name='days' value='Friday'>Friday</td>
								</tr>
								<tr>
									<td><input type='radio' name='days' value='Tuesday'>Tuesday</td>
									<td><input type='radio' name='days' value='Thursday'>Thursday</td>
								</tr>
								<tr><td><input type='radio' name='days' value='Saturday'>Saturday</td></tr>
							</table>
						</td>
					</tr>
					<tr>
	          <td><span align='right'>Start Time:</span></td>
	          <td><input name='start' id='start' TYPE='time' onchange='checkTime();' onpaste='return false' required/></td>
	        </tr>
	        <tr>
	          <td><span align='right'>End Time:</span></td>
	          <td><input name='end' id='end' TYPE='time' onchange='checkTime();' onpaste='return false' required/></td>
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
		if ((string)$_SESSION['Credentials'] == '3')
		{
			//Get facutly first name, lastname from netID
			$sql_facName = "SELECT * FROM `Faculty` WHERE NetID='$NetID'";
			$result_facName = mysql_query($sql_facName);
			while($row = mysql_fetch_assoc($result_facName))
			{
				$fn = $row['FirstName'];
				$ln = $row['LastName'];
			}

			/*echo "<SCRIPT LANGUAGE='JavaScript'>
				 window.alert('$deptID, $NetID, $fn, $ln')
				 window.location.href='#';
				 </SCRIPT>";*/
			echo "
	    <h2 class='contentAction' align='center'>Select a faculty member to add their office hours</h2>
	    <div class='bodyContent'>
			<form action='officehours_add_process.php' method='post'>
				<table align='center'>
					<tr>
						<td><span align='right'>Semester:</span></td>
						<td>
							<select name='semester' id='semester' style=\"width:160px;\">";
							while($row = mysql_fetch_assoc($result_semester))
							{
								$semester_id = $row['SemesterID'];
								$semester_term = $row['Term'];
								$semester_year = $row['Year'];
								$status = $row['Status'];
								if($status == 'Current')
                  echo "<option value=$semester_id selected>$semester_term $semester_year (Current)</option>";
                else echo "<option value=$semester_id>$semester_term $semester_year</option>";
								//echo "<option value=$semesterID selected>$term $year ($status)</option>";
							}echo "

					</tr>
					<tr>
						<td><span align='right'>Faculty Name:</span></td>
						<td><span align='right'>$ln, $fn</span></td>
						<td><input name='netid' id='netid' TYPE='hidden' value='$NetID'/></td>
					</tr>
					<tr>
	          <td><span align='right'>Location:</span></td>
						<td>
							<select id='location' name='location'>";

							// Get all Buildings (for admin adding office hours)
							$sql_all_buildings = "SELECT * FROM Building WHERE Status='Active' ORDER BY Name";
							$result_all_buildings = mysql_query($sql_all_buildings);
							while($row = mysql_fetch_assoc($result_all_buildings))
							{
								$bName = $row['Name'];
								$bId = $row['BuildingID'];
								echo"<option value=$bId>$bName</option>";
							}
						echo"
						</select>
						</td>
	        </tr>
					<tr>
						<td><span align='right'>Room Number:</span></td>
						<td><input name='deptroom' id='deptroom' TYPE='text' SIZE='25' onKeyPress='return hasToBeNumber(event)' onpaste='return false;' required/></td>
					</tr>
					<tr>
						<td><span align='right'>Days:</span></td>
						<td>
							<table>
								<tr><td><input type='radio' name='days' value='Sunday'>Sunday</td></tr>
								<tr>
									<td><input type='radio' name='days' value='Monday'>Monday</td>
									<td><input type='radio' name='days' value='Wednesday'>Wednesday</td>
									<td><input type='radio' name='days' value='Friday'>Friday</td>
								</tr>
								<tr>
									<td><input type='radio' name='days' value='Tuesday'>Tuesday</td>
									<td><input type='radio' name='days' value='Thursday'>Thursday</td>
								</tr>
								<tr><td><input type='radio' name='days' value='Saturday'>Saturday</td></tr>
							</table>
						</td>
					</tr>
					<tr>
	          <td><span align='right'>Start Time:</span></td>
	          <td><input name='start' id='start' TYPE='time'  onchange='checkTime();' onpaste='return false'required/></td>
	        </tr>
	        <tr>
	          <td><span align='right'>End Time:</span></td>
	          <td><input name='end' id='end' TYPE='time' onchange='checkTime();' onpaste='return false' required/></td>
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

	/*
	}

	else
	{
		//echo '<script type='text/javascript'>alert('Please login to view this page')</script>';
		session_destroy();
		echo "<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('Please Login as an Admin to View This Page')
			 window.location.href='index.php';
			 </SCRIPT>";
	}*/

echo "
</div> <!-- End pagecontent Div -->
</div> <!-- End pagebody Div -->
<script src='scripts/jquery-3.1.1.js'></script>
<script src='scripts/officehours_add_ajax.js'></script>
</body>
</html>
"
?>

</body>
</html>
