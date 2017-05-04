<?php
	$callToActionVar = "Add Course";
	include 'header.php';
	require('db_cn.inc');
	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
?>
<?php
	if ((isset($_SESSION['NetID'])) && (((string)$_SESSION['Credentials'] == '1') || (string)$_SESSION['Credentials'] == '2'))
	{
    echo "
    <h2 class='contentAction' align='center'>Enter the course information below</h2>
    <div class='bodyContent'>
		<form action='course_add_process.php' method='post'>
			<table align='center'>
				<tr>
					<td><span align='right'>Course Name:</span></td>
					<td><input name='coursename' id='coursename' TYPE='text' SIZE='30' onpaste='return false' required/></td>
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
                echo "<option value=$deptcode>$deptcode</option>";
              }
            echo"</select>
          </td>
				</tr>
				<tr>
					<td><span align='right'>Course Number:</span></td>
					<td><input  name='coursenum' id='coursenum' type='text' size='30' onKeyPress='return hasToBeNumber(event)' onpaste='return false' required/></td>
				</tr>
				<tr>
					<td><span align='right'>Section Number:</span></td>
					<td><input name='coursesection' id='coursesection' TYPE='text' SIZE='30' onKeyPress='return hasToBeNumber(event)' onpaste='return false' required/></td>
				</tr>
        <tr>
          <td><span align='right'>Course Type:</span></td>
          <td>
            <select name='coursetype' id='coursetype' style=\"width:160px;\" onpaste='return false' required>
              <option disable selected hidden value=''>Select one</option>
              <option value='Lab'>Lab</option>
              <option value='Lecture'>Lecture</option>
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
              <option disable selected hidden value=''>Select one</option>
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

                echo "<option value=$building_id>$building_name</option>";
              }
            echo "</select>
          </td>
        </tr>
        <tr>
          <td><span align='right'>Room Number:</span></td>
          <td><input name='room' id='room' TYPE='text' SIZE='30' onKeyPress='return hasToBeNumberOrLetter(event)' onpaste='return false' required/></td>
        </tr>
        <tr>
          <td><span align='right'>Days:</span></td>
          <td>
            <table>
              <tr><td><input type='checkbox' id='sundayBox' name='sundayBox' onchange='checkCount(this);' value='Sunday'>Sunday</td></tr>
              <tr>
								<td><input type='checkbox' id='mondayBox' name='mondayBox' onchange='checkCount(this);' value='Monday'>Monday</td>
              	<td><input type='checkbox' id='wednesdayBox' name='wednesdayBox' onchange='checkCount(this);' value='Wednesday'>Wednesday</td>
								<td><input type='checkbox' id='fridayBox' name='fridayBox' onchange='checkCount(this);' value='Friday'>Friday</td>
							</tr>
              <tr>
              	<td><input type='checkbox' id='tuesdayBox' name='tuesdayBox' onchange='checkCount(this);' value='Tuesday'>Tuesday</td>
              	<td><input type='checkbox' id='thursdayBox' name='thursdayBox' onchange='checkCount(this);' value='Thursday'>Thursday</td>
							</tr>
              <tr><td><input type='checkbox' id='saturdayBox' name='saturdayBox' onchange='checkCount(this);' value='Saturday'>Saturday</td></tr>
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
