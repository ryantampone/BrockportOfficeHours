<?php
	$callToActionVar = "Remove User";
	include 'header.php';
  include 'dbh.php';
	require('db_cn.inc');
	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);

  $netid = $_POST['netid'];

  $sql_user = "SELECT * FROM Users WHERE (NetID = '$netid' AND Status = 'Active')";
  $user_result = mysql_query($sql_user);

  if (!$user_result)
    echo "Error in retrieving user $netid: ".mysql_error();

	if(mysql_num_rows($user_result) == 0)
	{
		$message = "No user with NetID '$netid' was found.";
		echo "
			<script language='javascript'>
	    	window.alert(\"$message\");
	      window.location = 'user_remove_lookup.php';
	    </script>
	  ";
	}

  // Get info of user by netid (entered by client)
  while($row = mysql_fetch_assoc($user_result))
  {
    $firstname = $row['FirstName'];
    $lastname = $row['LastName'];
    $access = $row['Credentials'];
    $deptid = $row['DepartmentID'];
  }

  // If netid is faculty, get more info from Faculty table
  if($access == 3)
  {
    $sql_fac = "SELECT OfficeRoomNumber, Email, PhoneNumber FROM Faculty WHERE NetID = '$netid'";
    $fac_result = mysql_query($sql_fac);
    while($row = mysql_fetch_assoc($fac_result))
    {
      $room = $row['OfficeRoomNumber'];
      $email = $row['Email'];
      $phone = $row['PhoneNumber'];
    }
  }

  if($access == 1)
    $acc_name = "Admin";
  else if($access == 2)
    $acc_name = "Secretary";
  else $acc_name = "Faculty";

  if($deptid)
  {
    $sql_dept = "SELECT Name FROM Department WHERE DepartmentID='$deptid'";
    $result_dept = mysql_query($sql_dept);
    while($row = mysql_fetch_assoc($result_dept))
    {
      $dept_name = $row['Name'];
    }
  }

		echo "
		<center><h2 class='contentAction'>Verify this is the correct user</h2></center>
    	<div id='userdataform'>
				<form action='user_remove_process.php' method='post'>
					<table align='center'>
						<tr>
							<td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Net ID:</span></td>
							<td><span align='right'>$netid</td>
              <input type='hidden' name='netid' id='netid' value='$netid' />
						</tr>
						<tr>
              <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>First Name:</span></td>
							<td><span align='right'>$firstname</td>
              <input type='hidden' name='firstname' id='firstname' value='$firstname' />
						</tr>
						<tr>
							<td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Last Name:</span></td>
							<td><span align='right'>$lastname</td>
              <input type='hidden' name='lastname' id='lastname' value='$lastname' />
            </tr>
						<tr>
						  <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Access Level:</span></td>
              <td><span align='right'>$acc_name</td>
              <input type='hidden' name='access' id='access' value='$access' />
						</tr>";
          if($access == 2 || $access == 3)
          {
            echo"
						<tr>
							<td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Department:</span></td>
							<td><span align='right'>$dept_name</td>
              <input type='hidden' name='deptid' id='deptid' value='$deptid' />
						</tr>";
          }
          if($access == 3)
          {
            echo"
						<tr>
              <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Office Room Number:</span></td>
              <td><span align='right'>$room</td>
              <input type='hidden' name='room' id='room' value='$room' />
            </tr>
						<tr>
              <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Email:</span></td>
							<td><span align='right'>$email</td>
              <input type='hidden' name='email' id='email' value='$email' />
						</tr>
						<tr>
              <td style=\"padding-right: 10px; padding-bottom: 5px;\"><span align='right'>Phone number:</span></td>
							<td><span align='right'>$phone</td>
              <input type='hidden' name='phone' id='phone' value='$phone' />
						</tr>";
          }
          echo"
					</table>
					<p align='center'>
						<input type='submit' value='Confirm Delete'/>
            <input type='button' onclick=\"window.location.href='user_remove_lookup.php'\" value='Back' />
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
