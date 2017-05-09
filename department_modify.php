<?php
	$callToActionVar = "Modify Department";
	include 'header.php';
  include 'dbh.php';
	require('db_cn.inc');
	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $deptid = $_POST['deptID'];

  $sql_dept = "SELECT * FROM Department WHERE (DepartmentID = '$deptid')";
  $result_dept = mysql_query($sql_dept);

  if (!$result_dept)
    echo "Error in retrieving department id '$deptid': ".mysql_error();

  while($row = mysql_fetch_assoc($result_dept))
  {
    $old_deptname = $row['Name'];
    $deptcode = $row['Code'];
    $buildingid = $row['Location'];
    $room = $row['Room'];
		$status = $row['Status'];
  }


		echo "
		<center><h2 class='contentAction'>Please modify the desired information</h2></center>
			<div id='userdataform'>
				<form action='department_modify_process.php' method='post'>
					<table align='center'>
						<tr>
							<td><span align='right'>Department Name:</span></td>
							<td><input name='new_deptname' id='new_deptname' TYPE='text' SIZE='50' value='$old_deptname' onKeyPress='return hasToBeLetter(event)' onpaste='return false' required/></td>
							<input type='hidden' name='old_deptname' id='old_deptname' value=$old_deptname />
							<input type='hidden' name='deptid' id='deptid' value=$deptid />
						</tr>
						<tr>
              <td><span align='right'>Department Code:</span></td>
              <td><input name='deptcode' id='deptcode' TYPE='text' SIZE='50' value='$deptcode' onKeyPress='return hasToBeLetter(event)' onpaste='return false' maxlength='3' required/></td>
						</tr>
						<tr>
							<td><span align='right'>Location:</span></td>
              <td>
                <select name='location' id='location' required>";
                  $sql_building = "SELECT * FROM Building ORDER BY Name";
                  $result_building = mysql_query($sql_building);
                  if(!$result_building)
                    echo "Error in retrieving buildings: ".mysql_error();

                  while($row = mysql_fetch_assoc($result_building))
                  {
                    $bName = $row['Name'];
                    $bId = $row['BuildingID'];

                    if($buildingid == $bId)
                      echo "<option value=$bId selected>$bName</option>";
                    else echo "<option value=$bId>$bName</option>";
                  }
                echo"
              </td>
            </tr>
						<tr>
						  <td><span align='right'>Room Number:</span></td>
              <td><input id='room' name='room' type='text' size='20' value='$room' onKeyPress='return hasToBeNumber(event)' onpaste='return false' required</td>
						</tr>
					</table>
					<p align='center'>";
					if($status == 'Inactive')
					{
						echo "<label name='statusLabel' id='statusLabel'>This department is currently inactive.</label></br></br>";
						echo "<input type='button' name='reactivate' id='reactivate' onclick='reactivateDepartment();' value='Reactivate Department' />";
					}
					echo "
						<input type='submit' value='Submit'/>
						<input type='reset' value='Reset' />
					</p>
					<input type='hidden' name='status' id='status' value='$status' />
				</form>
			</div>
		</div> <!-- End pagecontent Div -->
		</div> <!-- End pagebody Div -->
		<script src='scripts/jquery-3.1.1.js'></script>
		<script src='scripts/department_reactivate_ajax.js'></script>
		</body>
		</html>
		";
?>

</body>
</html>
