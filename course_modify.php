<?php
	$callToActionVar = "Modify Course";
	include 'header.php';
	require('db_cn.inc');
	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
?>
<?php
	if ((isset($_SESSION['NetID'])) && (((string)$_SESSION['Credentials'] == '1') || (string)$_SESSION['Credentials'] == '2'))
	{

    $course_id = $_POST['buttonValue'];

		$sql_course = "SELECT * FROM Course WHERE CourseID='$course_id'";
		$result_course = mysql_query($sql_course);

		if(!$result_course)
			echo "Error in generating course data : ".mysql_error();
		else
		{
			while($row = mysql_fetch_assoc($result_course))
			{
				$courseName = $row['CourseName'];
				$courseCode = $row['DepartmentCode'];
				$courseNum = $row['CourseNumber'];
				$courseSection = $row['CourseSectionNumber'];
				$courseType = $row['CourseType'];
				$netID = $row['NetID'];
				$buildingID = $row['BuildingID'];
				$room = $row['RoomNumber'];
				$courseDay1 = $row['CourseDay1'];
				$courseDay2 = $row['CourseDay2'];
				$courseDay3 = $row['CourseDay3'];
				$startTime = (int)$row['StartTime'];
				$endTime = (int)$row['EndTime'];
			}
		}

		$sql_building = "SELECT Name FROM Building WHERE BuildingID='$buildingID'";
		$result_building = mysql_query($sql_building);

		if(!$result_building)
			echo "Error in retrieving building name : ".mysql_error();
		else
		{
			while($row = mysql_fetch_assoc($result_building))
			{
				$buildingName = $row['Name'];
			}
		}

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

    echo "
    <h2 class='contentAction' align='center'>Enter the course information below</h2>
    <div class='bodyContent'>
		<form action='course_modify_process.php' method='post'>
			<input type='hidden' id='courseid' name='courseid' value='$course_id' />
			<table align='center'>
				<tr>
					<td><span align='right'>Course Name:</span></td>
					<td><input name='coursename' id='coursename' TYPE='text' SIZE='30' value='$courseName' onpaste='return false' required/></td>
				</tr>
				<tr>
					<td><span align='right'>Department Code:</span></td>
					<td>
            <select name='deptcode' id='deptcode' onchange='updateFaculty();' style=\"width:160px;\" onpaste='return false' required>
              <option disable selected hidden value=''>Select one</option>";
              $sql_dept_code = "SELECT Code FROM Department ORDER BY Code";
              $result_dept_code = mysql_query($sql_dept_code);

              while($row = mysql_fetch_assoc($result_dept_code))
              {
                $deptcode = $row['Code'];
								if($deptcode == $courseCode)
									echo "<option value=$deptcode selected>$deptcode</option>";
                else echo "<option value=$deptcode>$deptcode</option>";
              }
            echo"</select>
          </td>
				</tr>
				<tr>
					<td><span align='right'>Course Number:</span></td>
					<td><input  name='coursenum' id='coursenum' type='text' size='30' value='$courseNum' onKeyPress='return hasToBeNumber(event)' onpaste='return false' required/></td>
				</tr>
				<tr>
					<td><span align='right'>Section Number:</span></td>
					<td><input name='coursesection' id='coursesection' TYPE='text' SIZE='30' value='$courseSection' onKeyPress='return hasToBeNumber(event)' onpaste='return false' required/></td>
				</tr>
        <tr>
          <td><span align='right'>Course Type:</span></td>
          <td>
            <select name='coursetype' id='coursetype' style=\"width:160px;\" onpaste='return false' required>
              <option disable selected hidden value=''>Select one</option>";
							if($courseType == 'Lab')
							{
              	echo "
									<option value='Lab' selected>Lab</option>
									<option value='Lecture'>Lecture</option>
								";
							}
              else
							{
								echo "
									<option value='Lecture' selected>Lecture</option>
									<option value='Lab'>Lab</option>
								";
							}
						echo"
            </select>
          </td>
        </tr>
          <tr>
          <td><span align='right'>Semester:</span></td>
          <td>
            <select name='semester' id='semester' style=\"width:160px;\" onpaste='return false' required>";
              $sql_semester = "SELECT * FROM Semester ORDER BY Year";
              $result_semester = mysql_query($sql_semester);

              while($row = mysql_fetch_assoc($result_semester))
              {
                $semester_id = $row['SemesterID'];
                $semester_year = $row['Year'];
                $semester_term = $row['Term'];
                $semester_status = $row['Status'];

                if($semester_status == 'Current')
                  echo "<option value=$semester_id selected>$semester_term $semester_year (Current)</option>";
                else echo "<option value=$semester_id>$semester_term $semester_year</option>";
              }
            echo "</select>
          </td>
        </tr>
        <tr>
          <td><span align='right'>Faculty Name:</span></td>
          <td>
            <select name='netid' id='netid' style=\"width:160px;\" onpaste='return false' required>
              <option disable selected hidden value=''>Select one</option>";
							$sql_faculty = "SELECT * FROM Faculty WHERE DepartmentID = (SELECT DepartmentID FROM Department WHERE Code='$courseCode')";
							$result_faculty = mysql_query($sql_faculty);

							if(!$result_faculty)
								echo "Error in getting faculty members for the $courseCode : ".mysql_error();
							else
							{
								while($nextProf = mysql_fetch_assoc($result_faculty))
								{
									$professor_netid = $nextProf['NetID'];
									$professor_fn = $nextProf['FirstName'];
									$professor_ln = $nextProf['LastName'];
									if($professor_netid == $netID)
										echo "<option value='$professor_netid' selected>$professor_ln, $professor_fn</option>";
									else echo "<option value='$professor_netid'>$professor_ln, $professor_fn</option>";
								}
							}
						echo"
						</select>
          </td>
        </tr>
        <tr>
          <td><span align='right'>Location:</span></td>
          <td>
            <select name='location' id='location' style=\"width:160px;\" onpaste='return false' required>
              <option disable selected hidden value=''>Select one</option>";
              $sql_building = "SELECT * FROM Building WHERE Status='Active' ORDER BY Name";
              $result_building = mysql_query($sql_building);

              while($row = mysql_fetch_assoc($result_building))
              {
                $building_id = $row['BuildingID'];
                $building_name = $row['Name'];
								if($buildingName == $building_name)
                	echo "<option value=$building_id selected>$building_name</option>";
								else echo "<option value=$building_id>$building_name</option>";
              }
            echo "</select>
          </td>
        </tr>
        <tr>
          <td><span align='right'>Room Number:</span></td>
          <td><input name='room' id='room' TYPE='text' SIZE='30' value='$room' onKeyPress='return hasToBeNumberOrLetter(event)' onpaste='return false' required/></td>
        </tr>
        <tr>
          <td><span align='right'>Days:</span></td>
          <td>
            <table>
              <tr>";
								if($courseDay1 == 'Sunday' || $courseDay2 == 'Sunday' || $courseDay3 == 'Sunday')
									echo "<td><input type='checkbox' id='sundayBox' name='sundayBox' onchange='checkCount(this);' value='Sunday' checked>Sunday</td>";
								else echo "<td><input type='checkbox' id='sundayBox' name='sundayBox' onchange='checkCount(this);' value='Sunday'>Sunday</td>";
							echo "
							</tr>
              <tr>";
								if($courseDay1 == 'Monday' || $courseDay2 == 'Monday' || $courseDay3 == 'Monday')
									echo "<td><input type='checkbox' id='mondayBox' name='mondayBox' onchange='checkCount(this);' value='Monday' checked>Monday</td>";
								else echo "<td><input type='checkbox' id='mondayBox' name='mondayBox' onchange='checkCount(this);' value='Monday'>Monday</td>";

								if($courseDay1 == 'Wednesday' || $courseDay2 == 'Wednesday' || $courseDay3 == 'Wednesday')
              		echo "<td><input type='checkbox' id='wednesdayBox' name='wednesdayBox' onchange='checkCount(this);' value='Wednesday' checked>Wednesday</td>";
								else echo "<td><input type='checkbox' id='wednesdayBox' name='wednesdayBox' onchange='checkCount(this);' value='Wednesday'>Wednesday</td>";

								if($courseDay1 == 'Friday' || $courseDay2 == 'Friday' || $courseDay3 == 'Friday')
									echo "<td><input type='checkbox' id='fridayBox' name='fridayBox' onchange='checkCount(this);' value='Friday' checked>Friday</td>";
								else echo "<td><input type='checkbox' id='fridayBox' name='fridayBox' onchange='checkCount(this);' value='Friday'>Friday</td>";
							echo "
							</tr>
              <tr>";
								if($courseDay1 == 'Tuesday' || $courseDay2 == 'Tuesday' || $courseDay3 == 'Tuesday')
              		echo "<td><input type='checkbox' id='tuesdayBox' name='tuesdayBox' onchange='checkCount(this);' value='Tuesday' checked>Tuesday</td>";
              	else echo "<td><input type='checkbox' id='tuesdayBox' name='tuesdayBox' onchange='checkCount(this);' value='Tuesday'>Tuesday</td>";

								if($courseDay1 == 'Thursday' || $courseDay2 == 'Thursday' || $courseDay3 == 'Thursday')
									echo "<td><input type='checkbox' id='thursdayBox' name='thursdayBox' onchange='checkCount(this);' value='Thursday' checked>Thursday</td>";
								else echo "<td><input type='checkbox' id='thursdayBox' name='thursdayBox' onchange='checkCount(this);' value='Thursday'>Thursday</td>";
							echo "
							</tr>
              <tr>";
								if($courseDay1 == 'Saturday' || $courseDay2 == 'Saturday' || $courseDay3 == 'Saturday')
									echo "<td><input type='checkbox' id='saturdayBox' name='saturdayBox' onchange='checkCount(this);' value='Saturday' checked>Saturday</td>";
								else echo "<td><input type='checkbox' id='saturdayBox' name='saturdayBox' onchange='checkCount(this);' value='Saturday'>Saturday</td>";
							echo "
							</tr>
            </table>
          </td>
        </tr>
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
			<div id='status'></div>
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
<script src='scripts/course_add_ajax.js'></script>
</body>
</html>
"
?>

</body>
</html>
