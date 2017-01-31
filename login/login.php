<?php
		session_start();

		include '../dbh.php';
		//Gets values from form
		$netid = $_POST['netid'];
		$pwd = $_POST['pwd'];
		//create a group variable
		$group = 'test';

		//get password from database based on UID
		$sql = "SELECT * FROM Users WHERE NetID='$netid' AND status='Active'";
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
				$sql1 = "SELECT * FROM user WHERE uid='$uid' AND pwd='$hash_pwd' AND status='Active'";
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
					$_SESSION['credentials'] = $row['Credentials'];
					/*$_SESSION['first'] = $row['first'];
					$_SESSION['last'] = $row['last'];
					$_SESSION['uid'] = $row['uid'];*/
					$group = $row['Credentials'];
				}
		 }
		/*
		//$result1 = $conn->query($sql1);
		//check if user exists in DB
		if(!$row1 = mysqli_fetch_assoc($result1))
		{
			echo "<SCRIPT LANGUAGE='JavaScript'>
				 window.alert('No user found with the provided NetID.  Check your credentials or click Signup to register for an account.')
				 window.location.href='../index.php';
				 </SCRIPT>";
		}
		else
		{
			$row1 = mysqli_fetch_assoc($result1);
			$dbpassword = $row1['pwd'];//getting encrypted password from the DB to check later
			echo "<SCRIPT LANGUAGE='JavaScript'>
				 window.alert('DB: $dbpassword');
				 </SCRIPT>";
		}


		//Check the passwords
		$check_passwords = password_verify($pwd, $dbpassword); //this is a boolean (0 means encrypted password does not match provided password)
		if ($check_passwords == 0)
		{
			echo "<SCRIPT LANGUAGE='JavaScript'>
				 window.alert('Invalid NetID or Password.  Check your credentials and try again.')
				 window.location.href='../index.php';
				 </SCRIPT>";
		}
		else
		{
			$sql = "SELECT * FROM user WHERE uid='$uid' AND pwd='$dbpassword' AND status='Active'";
			$result = $conn->query($sql);

			if(!$row = mysqli_fetch_assoc($result))
			{
				//echo "Your username or password is incorrect";

				echo "<SCRIPT LANGUAGE='JavaScript'>
					 window.alert('Invalid NetID or Password.  Check your credentials and try again.')
					 window.location.href='../index.php';
					 </SCRIPT>";

			}
			else
			{
				$_SESSION['id'] = $row['id'];
				$_SESSION['access'] = $row['access'];
				$_SESSION['first'] = $row['first'];
				$_SESSION['last'] = $row['last'];
				$group = $row['access'];
			}

		}

		*/


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
