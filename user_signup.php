<?php
	include 'header.php';
  include 'dbh.php';
?>

<?php
	if ((isset($_SESSION['NetID'])) && ($_SESSION['Credentials'] == 1))
	{
		session_destroy();
		echo "<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('Please logout to view this page')
			 window.location.href='index.php';
			 </SCRIPT>";
	}
	else
	{
		echo "
		<center><h2>Please fill out the form below</h2></center>
			<div id='userdataform'>
						<form action='login/signup.php' method='post'>
								<table align='center'>
										<tr>
												<td><span align='right'>Net ID:</span></td>
												<td><input name='netid' id='netid' TYPE='text' SIZE='20' onKeyPress='' required/></td>
                        <td><span align='right'>First Name:</span></td>
                        <td><input name='firstname' id='firstname' TYPE='text' SIZE='50' onKeyPress='' required/></td>
                        <td><span align='right'>Last Name:</span></td>
                        <td><input name='lastname' id='lastname' TYPE='text' SIZE='50' onKeyPress='' required/></td>
                        <td><span align='right'>Access Level:</span></td>
                        <td>
                          <select name='access' id='access' SIZE='10' onchange='checkCreds()' required>
                            <option value='1'>1: Admin</option>
                            <option value='2'>2: Secretary</option>
                            <option value='3'>3: Faculty</option>
                          </select>
                        </td>
                        <td><span align='right'>Department ID:</span></td>
                        <td>
                          <select name='dept' id='dept' SIZE='50'>";
                            $sql_dept = "SELECT DepartmentID, Name FROM Department WHERE Status='Active'";
                            $sql_result = mysqli_query($sql_dept);
                        		$row = $result->fetch_assoc();
                            while($row)
                            {
                              $deptid = $row['DepartmentID'];
                              $deptname = $row['Name'];
                              echo "<option value='$deptid'>'$deptid': '$deptname'</option>";
                            }
                    echo "</select>
                        </td>
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

	}
?>

</body>
</html>
