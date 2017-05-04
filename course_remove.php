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
        $semester = $row['SemesterID'];
				$netID = $row['NetID'];
				$buildingID = $row['BuildingID'];
				$room = $row['RoomNumber'];
				$courseDay1 = $row['CourseDay1'];
				$courseDay2 = $row['CourseDay2'];
				$courseDay3 = $row['CourseDay3'];
				$startTimeMilitary = (int)$row['StartTime'];
				$endTimeMilitary = (int)$row['EndTime'];
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

    $startTime_AM_PM = "";
        if ($startTimeMilitary >= 1300)
        {
          $startTimeUnparsed = (string)$startTimeMilitary - 1200;
          $startTime_AM_PM = 'PM';
        }
        else if (($startTimeMilitary == 1200) || (($startTimeMilitary < 1300) && ($startTimeMilitary >= 1200)))
        {
          $startTimeUnparsed = (string)$startTimeMilitary;
          $startTime_AM_PM = "PM";
        }
        else if ($startTimeMilitary == 0000)
        {
          $startTimeUnparsed = "1200";
          $startTime_AM_PM = "AM";
        }
        else
        {
          $startTimeUnparsed = (string)$startTimeMilitary;
          $startTime_AM_PM = 'AM';
        }
        //Convert back to 12HR time
        $startTimeArray = str_split($startTimeUnparsed);
        $arrayStartSize = sizeOf($startTimeArray);
        $separator = ':'; //change for example 1200 to 12:00
        $splitStartTimePos = $arrayStartSize - 2;
        $startSplicedArray = array_splice($startTimeArray, $splitStartTimePos, 0, $separator );
        //$startTime = implode("", $startSplicedArray);
        $startTime = "";

        for ($cnt = 0; $cnt <= $arrayStartSize; $cnt++)
        {
          $startTime = $startTime.$startTimeArray[$cnt];
        }

        $startTime = $startTime." ".$startTime_AM_PM;



    $endTime_AM_PM = "";
        if ($endTimeMilitary >= 1300)
        {
          $endTimeUnparsed = $endTimeMilitary - 1200;
          $endTime_AM_PM = "PM";
        }
        else if (($endTimeMilitary == 1200) || (($endTimeMilitary < 1300) && ($endTimeMilitary >= 1200)))
        {
          $endTimeUnparsed = (string)$endTimeMilitary;
          $endTime_AM_PM = "PM";
        }
        else if ($endTimeMilitary == 0000)
        {
          $endTimeUnparsed = "1200";
          $endTime_AM_PM = "AM";
        }
        else
        {
          $endTimeUnparsed = $endTimeMilitary;
          $endTime_AM_PM = "AM";
        }
        //Convert back to 12HR time
        $endTimeArray = str_split($endTimeUnparsed);
        $arrayEndSize = sizeOf($endTimeArray);
        $separator = ':'; //change for example 1200 to 12:00
        $splitEndTimePos = $arrayEndSize - 2;
        $endSplicedArray = array_splice($endTimeArray, $splitEndTimePos, 0, $separator );
        //$startTime = implode("", $startSplicedArray);
        $endTime = "";

        for ($cnt = 0; $cnt <= $arrayEndSize; $cnt++)
        {
          $endTime = $endTime.$endTimeArray[$cnt];
        }
        $endTime = $endTime." ".$endTime_AM_PM;

    echo "
    <h2 class='contentAction' align='center'>Enter the course information below</h2>
    <div class='bodyContent'>
		<form id='remove_course' action='course_remove_process.php' method='post'>
			<input type='hidden' id='courseid' name='courseid' value='$course_id' />
			<table align='center'>
				<tr>
          <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Course Name:</span></td>
          <td><span align='right'>$courseName</td>
          <td><input type='hidden' id='coursename' name='coursename' value='$courseName' />
				</tr>
				<tr>
          <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Department Code:</span></td>
          <td><span align='right'>$courseCode</td>
				</tr>
				<tr>
          <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Course Number:</span></td>
          <td><span align='right'>$courseNum</td>
				</tr>
				<tr>
          <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Course Section:</span></td>
          <td><span align='right'>$courseSection</td>
				</tr>
        <tr>
          <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Course Type:</span></td>
          <td><span align='right'>$courseType</td>
        </tr>
        <tr>";
              $sql_semester = "SELECT * FROM Semester WHERE SemesterID='$semester'";
              $result_semester = mysql_query($sql_semester);

              while($row = mysql_fetch_assoc($result_semester))
              {
                $semester_year = $row['Year'];
                $semester_term = $row['Term'];
                $semester_status = $row['Status'];
              }
            echo "
          <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Semester:</span></td>
          <td><span align='right'>$semester_term $semester_year</td>
        </tr>
        <tr>
          <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Professor:</span></td>
          <td><span align='right'>$netID</td>
        </tr>
        <tr>
          <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Location:</span></td>
          <td><span align='right'>$buildingName</td>
        </tr>
        <tr>
          <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Room Number:</span></td>
          <td><span align='right'>$room</td>
        </tr>
        <tr>
          <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Days:</span></td>
          <td><span align='right'>$courseDay1 $courseDay2 $courseDay3</td>
        </tr>
        <tr>
          <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Start Time:</span></td>
          <td><span align='right'>$startTime</td>
        </tr>
        <tr>
          <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>End Time:</span></td>
          <td><span align='right'>$endTime</td>
        </tr>
			</table>
			<p align='center'>
				<input type='button' id='submitButton' onclick='confirmRemoveCourse();' value='Confirm Remove'/>
				<input type='button' onclick=\"window.location.href='course_remove_lookup.php'\" value='Cancel' />
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
