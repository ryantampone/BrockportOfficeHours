<?php
	include 'header.php';
  include 'dbh.php';
	$callToActionVar = "User Signup";
	include 'callToAction.php';
	require('db_cn.inc');

	/*if ((isset($_SESSION['NetID'])) && ($_SESSION['Credentials'] == 1))
	{
		session_destroy();
		echo "<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('Please logout to view this page')
			 window.location.href='index.php';
			 </SCRIPT>";
	}
	else
	{*/



//	Populate fields if being redirected from error message after submission

	if(isset($_POST['nid']))
		$netid = $_POST['nid'];
	else $netid = "";

	if(isset($_POST['fn']))
		$firstname = $_POST['fn'];
	else $firstname = "";

	if(isset($_POST['ln']))
		$lastname = $_POST['ln'];
	else $lastname = "";

	if(isset($_POST['acc']))
		$access = $_POST['acc'];
	else $access = "";

	if(isset($_POST['dep']))
	{
		connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
		$dept = $_POST['dep'];
		$dept_sql = "SELECT Name FROM Department WHERE DepartmentID = '$dept'";
		$dept_result = mysql_query($dept_sql);

		if(!$dept_result)
		{
			echo "Unable to get Department Name : " .mysql_error();
		}
		else
		{
			while($row = mysql_fetch_assoc($dept_result))
			{
				$deptname = $row['Name'];
			}
		}
	}
	else $dept = "";

	if(isset($_POST['pass']))
		$pwd = $_POST['pass'];
	else $pwd = "";

		echo "
		<center><h2>Please fill out the form below</h2></center>
			<div id='userdataform'>
				<form action='login/signup.php' method='post'>
					<table align='center'>
						<tr>
							<td><span align='right'>Net ID:</span></td>
							<td><input name='netid' id='netid' TYPE='text' SIZE='20' value='$netid' onKeyPress='return hasToBeNumberOrLetter(event)' required/></td>
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
                <select name='access' id='access' onchange='checkCreds()' required>
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
										if($dept != "")
										{
											if($dept == $deptid)
											{
												echo "<option value=$deptid selected>$deptname</option>";
											}
										}
										else echo "<option value=$deptid>$deptname</option>";
                  }
          echo "</select>
              </td>
						</tr>
						<tr>
              <td><span align='right'>Password:</span></td>
              <td><input name='pwd' id='pwd' TYPE='password' SIZE='50' onKeyPress='' required/></td>
						</tr>
					</table>
					<p align='center'>
						<input type='submit' value='Submit'/>
						<input type='reset' value='Reset'/>
					</p>
				</form>
			</div>
		";

	//}
?>

</body>
</html>
