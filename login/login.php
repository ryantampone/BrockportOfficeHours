<?php
		session_start();

		include '../dbh.php';
		//Gets values from form
		$netid = $_POST['netid'];
		$pwd = $_POST['pwd'];
		//create a group variable
		$group = 'test';

		//get password from database based on UID
		$sql = "SELECT * FROM Users WHERE NetID='$netid' AND Status='Active'";
		$result = mysqli_query($conn, $sql);
		$row = $result->fetch_assoc();
		$hash_pwd = $row['pwd'];
		$hash = password_verify($pwd, $hash_pwd);

		if ($hash == 0)
		{
			echo "<SCRIPT LANGUAGE='JavaScript'>
				 window.alert('Invalid NetID or Password.  Check your credentials or click Signup to register for an account.')
				 window.location.href='../index.php';
				 </SCRIPT>";
		}
		else
		{
				//Everything else
				$sql1 = "SELECT * FROM User WHERE NetID='$netid' AND Password='$hash_pwd' AND Status='Active'";
				$result1 = mysqli_query($conn, $sql1);
				if (!$row = mysqli_fetch_assoc($result1))
				{
					echo "<SCRIPT LANGUAGE='JavaScript'>
						 window.alert('Invalid NetID or Password.  Check your credentials or click Signup to register for an account.')
						 window.location.href='../index.php';
						 </SCRIPT>";
				}
				else
				{
					$_SESSION['NetID'] = $row['NetID'];
					$_SESSION['First'] = $row['FirstName'];
					$_SESSION['Last'] = $row['LastName'];
					$_SESSION['Credentials'] = $row['Credentials'];
					$_SESSION['DepartmentID'] = $row['DepartmentID'];
					$_SESSION['Password'] = $row['Password'];
					$group = $row['Credentials'];
				}
		 }

		if ($group == 1)
		{
			// If user is level 1 (admin), go to admin dashboard
			header('Location: ../adminoptions.php');
		}
		else if ($group == 2)
		{
			// If user is level 2 (secretary), go to secretary dashboard
			header('Location: ../secretaryoptions.php');
		}
		else if ($group == 3)
		{
			// If user is level 3 (faculty), go to faculty dashboard
			header('Location: ../facultyoptions.php');
		}

?>
