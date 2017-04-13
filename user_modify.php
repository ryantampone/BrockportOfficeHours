<?php
	$callToActionVar = "Modify User";
	include 'header.php';
  include 'dbh.php';
	require('db_cn.inc');
	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $old_netid = $_POST['netid'];

  $sql_user = "SELECT * FROM Users WHERE (NetID = '$old_netid')";
  $user_result = mysql_query($sql_user);

  if (!$user_result)
    echo "Error in retrieving user $old_netid: ".mysql_error();

	if(mysql_num_rows($user_result) == 0)
	{
		$message = "No user with NetID '$old_netid' was found.";
		echo "
			<script language='javascript'>
	    	window.alert(\"$message\");
	      window.location = 'user_modify_lookup.php';
	    </script>
	  ";
	}

  // Get info of user by netid (entered by client)
  while($row = mysql_fetch_assoc($user_result))
  {
    $firstname = $row['FirstName'];
    $lastname = $row['LastName'];
    $access = $row['Credentials'];
    $dept_get = $row['DepartmentID'];
		$status = $row['Status'];
    /*if($deptid != "NULL")
    {
      $sql_dept = "SELECT Name FROM Department WHERE DepartmentID = '$deptid'";
      $dept_result = mysql_query($sql_dept);
      while($next = mysql_fetch_assoc($dept_result))
        $deptname = $next['Name'];
    }*/
  }

  $accessPerm = $access;

  // If netid is faculty, get more info from Faculty table
  if($access == 3)
  {
    $sql_fac = "SELECT OfficeRoomNumber, Email, PhoneNumber FROM Faculty WHERE NetID = '$old_netid'";
    $fac_result = mysql_query($sql_fac);
    while($row = mysql_fetch_assoc($fac_result))
    {
      $room = $row['OfficeRoomNumber'];
      $email = $row['Email'];
      $phone = $row['PhoneNumber'];
    }
  }


		echo "
		<center><h2 class='contentAction' style=\"margin-bottom: -20px;\">Please modify the desired information</h2></center>
    <center><h5><strong>NOTE: To change a user's password, the user must go to <font color='red'>Options > Change Password</font></strong></h5></center>
			<div id='userdataform'>
				<form action='user_modify_process.php' method='post'>
					<table align='center'>
						<tr>
							<td><span align='right'>Net ID:</span></td>
							<td><input name='new_netid' id='new_netid' TYPE='text' SIZE='50' value='$old_netid' onKeyPress='return hasToBeNumberOrLetter(event)' required/></td>
						</tr>
						<tr>
              <td><span align='right'>First Name:</span></td>
              <td><input name='firstname' id='firstname' TYPE='text' SIZE='50' value='$firstname' onKeyPress='return isTextCityOrPersonKey(event)' required/></td>
						</tr>
						<tr>
							<td><span align='right'>Last Name:</span></td>
              <td><input name='lastname' id='lastname' TYPE='text' SIZE='50' value='$lastname' onKeyPress='return isTextCityOrPersonKey(event)' required/></td>
            </tr>
						<tr>
						  <td><span align='right'>Access Level:</span></td>
              <td>
                <select name='access' id='access' onchange='checkCreds(); selectFaculty();' required>
								";
									if($access == 1)
									{
										echo"
	                  <option value='1' selected>Admin</option>
	                  <option value='2'>Secretary</option>
	                  <option value='3'>Faculty</option>";
									}
									elseif($access == 2)
									{
										echo"
	                  <option value='1'>Admin</option>
	                  <option value='2' selected>Secretary</option>
	                  <option value='3'>Faculty</option>";
									}
									elseif($access == 3)
									{
										echo"
	                  <option value='1'>Admin</option>
	                  <option value='2'>Secretary</option>
	                  <option value='3' selected>Faculty</option>";
									}
									else
									{
										echo"
	                  <option value='1'>Admin</option>
	                  <option value='2'>Secretary</option>
	                  <option value='3'>Faculty</option>";
									}
          echo "</select>
              </td>
						</tr>
						<tr>
							<td><span align='right'>Department:</span></td>
              <td>
                <select name='dept' id='dept'>";
									connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
                  $sql_dept = "SELECT DepartmentID, Name FROM Department WHERE Status='Active'";
                  $sql_result = mysql_query($sql_dept);

                  while($row = mysql_fetch_assoc($sql_result))
                  {
                    $deptid = $row['DepartmentID'];
                    $deptname = $row['Name'];
										if($dept_get != "" || $dept_get != "NULL")
										{
											if($dept_get == $deptid)
											{
												echo "<option value=$deptid selected>$deptname</option>";
											}
											else echo "<option value=$deptid>$deptname</option>";
										}
										else echo "<option value=$deptid>$deptname</option>";
                  }
									if ($access == "")
										echo "<script type='text/javascript'>checkCreds();</script>";
									if ($access == 1)
										echo "<option value='' selected></option>";
          echo "</select>
              </td>
						</tr>
						<tr>
              <td><span id='roomLabel' align='right'>Office Room Number:</span></td>
              <td><input disabled name='room' id='room' TYPE='text' SIZE='50' value='$room' onKeyPress='return hasToBeNumber(event)' required/></td>
						</tr>
						<tr>
              <td><span id='emailLabel' align='right'>Email:</span></td>
              <td><input disabled name='email' id='email' TYPE='text' SIZE='50' value='$email' onKeyPress='' required/></td>
						</tr>
						<tr>
              <td><span id='phoneLabel' align='right'>Phone number:</span></td>
              <td><input disabled name='phone2' id='phone2' TYPE='text' SIZE='50' value='$phone' onblur='isPhoneNumber2()' required/></td>
						</tr>
					</table>
					";
					if($access == 1)
						echo "<script type='text/javascript'>resetAdmin();</script>";
					if($access == 3)
						echo "<script type='text/javascript'>resetFaculty();</script>";
					echo "
					<p align='center'>";
					if($status == 'Inactive')
					{
						echo "<label name='statusLabel' id='statusLabel'>This user is currently inactive.</label></br></br>";
						echo "<input type='button' name='reactivate' id='reactivate' onclick='reactivateUser();' value='Reactivate User' />";
					}
					echo "
						<input type='submit' value='Submit'/>
						<input type='reset' onclick='checkEnables($accessPerm)' value='Reset' />
					</p>
					<input type='hidden' name='old_netid' id='old_netid' value='$old_netid' />
					<input type='hidden' name='status' id='status' value='$status' />
				</form>
			</div>
		</div> <!-- End pagecontent Div -->
		</div> <!-- End pagebody Div -->
		<script src='scripts/jquery-3.1.1.js'></script>
		<script src='scripts/user_reactivate_ajax.js'></script>
		</body>
		</html>
		";
?>

</body>
</html>
