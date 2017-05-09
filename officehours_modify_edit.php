<?php
	$callToActionVar = "Modify Office Hours";
	include 'header.php';
	require('db_cn.inc');
	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
	$deptID = (string)$_SESSION['DepartmentID'];
?>
<?php
	//Get Value from OH Modify process
	$officeHoursID = $_POST['officeHoursRadio'];
	echo "<SCRIPT LANGUAGE='JavaScript'>
		 window.alert('OH ID: $officeHoursID')
		 window.location.href='#';
		 </SCRIPT>";
	//Get Office Hours Info
	$search_OfficeHours_stmt = "SELECT * FROM OfficeHours WHERE ID='$officeHoursID'";
	$result_OfficeHours = mysql_query($search_OfficeHours_stmt);
	$numrowsOH = mysql_num_rows($result_OfficeHours);
	if ($numrowsOH != 0)
	{
		while ($row = mysql_fetch_assoc($result_OfficeHours))
		{
			$netID = $row['NetID'];
			$semesterID = $row['SemesterID'];
			$day = $row['Day'];
			$startTime = (int)$row['StartTime'];
			$endTime = (int)$row['EndTime'];
			$location = $row['Location'];
			$roomNumber = $row['RoomNumber'];
		}
	}
	else
	{
		echo "<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('An Error Occured, Please Try Again Later: Unable to Retrieve Office Hours Information')
			 window.location.href='officehours_modify.php';
			 </SCRIPT>";
	}

	echo "<SCRIPT LANGUAGE='JavaScript'>
		 window.alert('Semester ID: $semesterID')
		 window.location.href='#';
		 </SCRIPT>";








		//Form for admins
		if ((string)$_SESSION['Credentials'] == '1')
		{
			echo "
	    <h2 class='contentAction' align='center'>Update the Information Below</h2>
	    <div class='bodyContent'>
			<form action='officehours_modify_edit_process.php' method='post'>
				<table align='center'>
					<tr>
						<td><span align='right'>Semester:</span></td>
						<td>
							<select name='semester' id='semester' style=\"width:160px;\">
							<option disable selected hidden value=''>Select one</option>";
							$sql_semester = "SELECT * FROM `Semester` ORDER BY 'Status'";// WHERE Status='Current'
							$result_semester = mysql_query($sql_semester);
							while($row = mysql_fetch_assoc($result_semester))
							{
								$semester_id = $row['SemesterID'];
								$semester_term = $row['Term'];
								$semester_year = $row['Year'];
								$status = $row['Status'];
								if($semester_id == $semesterID)
                  echo "<option value=$semester_id selected>$semester_term $semester_year</option>";
                else echo "<option value=$semester_id>$semester_term $semester_year</option>";
								//echo "<option value=$semesterID selected>$term $year ($status)</option>";
							}


					echo "
					<tr>
						<td><span align='right'>Department:</span></td>
							<td>
								<select name='deptcode' id='deptcode' onchange='updateFaculty();' style=\"width:160px;\" required>
									<option disable selected hidden value=''>Select one</option>";

									$sql_dept_id_compare = "SELECT DepartmentID FROM Faculty WHERE NetID='$netID'";
									$result_dept_id_compare = mysql_query($sql_dept_id_compare);
									while($row = mysql_fetch_assoc($result_dept_id_compare))
									{
										$deptid_compare = $row['DepartmentID'];
									}

									//run query to get dept code from dept id


									echo "<SCRIPT LANGUAGE='JavaScript'>
										 window.alert('DeptCode Compare: $deptid_compare, LocAtion: $location')
										 window.location.href='#';
										 </SCRIPT>";
									$sql_dept_code = "SELECT * FROM Department ORDER BY Code";
									$result_dept_code = mysql_query($sql_dept_code);

									while($row = mysql_fetch_assoc($result_dept_code))
									{
										$deptcode = $row['Code'];
										$deptID2 = $row['DepartmentID'];

										if ($deptID2 == $deptid_compare)
											echo "<option value=$deptcode selected>$deptcode</option>";
										else
											echo "<option value=$deptcode >$deptcode</option>";
									}
								echo"</select>
							</td>
					</tr>
					<tr>
						<td><span align='right'>Faculty Name:</span></td>
						<td>
							<select name='netid' id='netid' style=\"width:160px;\" required>";
							$sql_all_facs = "SELECT * FROM Faculty WHERE DepartmentID='$deptid_compare' ORDER BY LastName";
							$result_all_facs = mysql_query($sql_all_facs);
							while($row = mysql_fetch_assoc($result_all_facs))
							{
								$facsFN = $row['FirstName'];
								$facsLN = $row['LastName'];
								$facsNetID = $row['NetID'];
								if ($netID == $facsNetID)
									echo"<option value=$facsNetID selected>$facsLN, $facsFN</option>";
								else
									echo"<option value=$facsNetID>$facsLN, $facsFN</option>";
							}
							echo"
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
								if ($location == $bId)
									echo"<option value=$bId selected>$bName</option>";
								else
									echo"<option value=$bId>$bName</option>";
							}
						echo"
	        </tr>
					<tr>
						<td><span align='right'>Room Number:</span></td>
						<td><input name='deptroom' id='deptroom' TYPE='text' SIZE='25' onKeyPress='return hasToBeNumber(event)' onpaste='return false;' required value='$roomNumber'/></td>
					</tr>
					<tr>
						<td><span align='right'>Days:</span></td>
						<td>
						<table>
							<tr>";
								if($day == 'Sunday')
									echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Sunday' checked>Sunday</td>";
								else echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Sunday'>Sunday</td>";
							echo "
							</tr>
							<tr>";
								if($day == 'Monday')
									echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Monday' checked>Monday</td>";
								else echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Monday'>Monday</td>";

								if($day == 'Tuesday')
									echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Wednesday' checked>Wednesday</td>";
								else echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Wednesday'>Wednesday</td>";

								if($day == 'Wednesday')
									echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Friday' checked>Friday</td>";
								else echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Friday'>Friday</td>";
							echo "
							</tr>
							<tr>";
								if($day == 'Thursday')
									echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Tuesday' checked>Tuesday</td>";
								else echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Tuesday'>Tuesday</td>";

								if($day == 'Friday')
									echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Thursday' checked>Thursday</td>";
								else echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Thursday'>Thursday</td>";
							echo "
							</tr>
							<tr>";
								if($day == 'Saturday')
									echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Saturday' checked>Saturday</td>";
								else echo "<td><input type='radio' id='days' name='days' onchange='checkCount(this);' value='Saturday'>Saturday</td>";
							echo "
							</tr>
						</table>
						</td>
					</tr>";

					//Start/End Time Population
					$startArr = str_split($startTime);
					$endArr = str_split($endTime);

					if($startTime < 1000)
					{
						$startHour = $startArr[0];
						$startMin = $startArr[1].$startArr[2];
					}
					else
					{
						$startHour = $startArr[0].$startArr[1];
						$startMin = $startArr[2].$startArr[3];
					}

					if($endTime < 1000)
					{
						$endHour = $endArr[0];
						$endMin = $endArr[1].$endArr[2];
					}
					else
					{
						$endHour = $endArr[0].$endArr[1];
						$endMin = $endArr[2].$endArr[3];
					}

					if($startHour < 10)
						$startHour = "0".$startHour;
					if($endHour < 10)
						$endHour = "0".$endHour;

					echo"
					<tr>
	          <td><span align='right'>Start Time:</span></td>
	          <td><input name='start' id='start' TYPE='time' onchange='checkTime();' onpaste='return false' required/></td>
						<script>
							document.getElementById('start').value = '$startHour'+':'+'$startMin';
						</script>
	        </tr>
	        <tr>
	          <td><span align='right'>End Time:</span></td>
	          <td><input name='end' id='end' TYPE='time' onchange='checkTime();' onpaste='return false' required/></td>
						<script>
							document.getElementById('end').value = '$endHour'+':'+'$endMin';
						</script>
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
						<td><span align='right'>$buildingName</span></td>
	          <td><input name='location' id='location' TYPE='hidden' value='$buildingID'/></td>
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
									<td><input type='radio' name='days' value='Tuesday'>Wednesday</td>
									<td><input type='radio' name='days' value='Wednesday'>Friday</td>
								</tr>
								<tr>
									<td><input type='radio' name='days' value='Thursday'>Tuesday</td>
									<td><input type='radio' name='days' value='Friday'>Thursday</td>
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
						<td><span align='right'>$buildingName</span></td>
	          <td><input name='location' id='location' TYPE='hidden' value='$buildingID'/></td>
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
									<td><input type='radio' name='days' value='Tuesday'>Wednesday</td>
									<td><input type='radio' name='days' value='Wednesday'>Friday</td>
								</tr>
								<tr>
									<td><input type='radio' name='days' value='Thursday'>Tuesday</td>
									<td><input type='radio' name='days' value='Friday'>Thursday</td>
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
