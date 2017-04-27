<?php
	$callToActionVar = "Remove department";
	include 'header.php';
  include 'dbh.php';
	require('db_cn.inc');
	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $deptid = $_POST['deptid'];

  $sql_dept = "SELECT * FROM Department WHERE (DepartmentID = '$deptid' AND Status = 'Active')";
  $result_dept = mysql_query($sql_dept);

  if (!$result_dept)
    echo "Error in retrieving department $deptid: ".mysql_error();

  // Get info of user by netid (entered by client)
  while($row = mysql_fetch_assoc($result_dept))
  {
    $deptname = $row['Name'];
    $deptcode = $row['Code'];
    $location = $row['Location'];
    $room = $row['Room'];
  }

	echo "
	<center><h2 class='contentAction'>Verify this is the correct department</h2></center>
  	<div id='userdataform'>
			<form action='department_remove_process.php' method='post'>
				<table align='center'>
					<tr>
						<td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Department Name:</span></td>
						<td><span align='right'>$deptname</td>
            <input type='hidden' name='deptname' id='deptname' value='$deptname' />
            <input type='hidden' name='deptid' id='deptid' value='$deptid' />
					</tr>
					<tr>
            <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Department Code:</span></td>
						<td><span align='right'>$deptcode</td>
            <input type='hidden' name='deptcode' id='deptcode' value='$deptcode' />
					</tr>
					<tr>
						<td style=\"padding-right: 10px;\"><span align='right'>Location:</span></td>";
            $sql_building = "SELECT Name FROM Building WHERE BuildingID='$location'";
            $result_building = mysql_query($sql_building);

            while($row = mysql_fetch_assoc($result_building))
            {
              $bId = $row['BuildingID'];
              $bName = $row['Name'];
            }
            echo "
						<td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>$bName</td>
            <input type='hidden' name='location' id='location' value='$bId' />
          </tr>
					<tr>
					  <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Room Number:</span></td>
            <td><span align='right'>$room</td>
            <input type='hidden' name='room' id='room' value='$room' />
					</tr>
				</table>
				<p align='center'>
					<input type='submit' value='Confirm Remove'/>
          <input type='button' onclick=\"window.location.href='department_remove_lookup.php'\" value='Back' />
				</p>
			</form>
		</div>
	";

	//}
?>


</div> <!-- End pagecontent Div -->
</div> <!-- End pagebody Div -->
</body>
</html>
