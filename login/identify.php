<?php //this function is called to determin the first name of the user logged into the system in order to customize the sytem
		include '../dbh.php';
		
		session_start();
		$id = (string)$_SESSION['id'];

		$sqlID = "SELECT first, last FROM user WHERE id='$id'";
		$resultID = $conn->query($sqlID);

		if(!$rowID = mysqli_fetch_assoc($resultID))
		{
			//echo "Your username or password is incorrect";

			echo "<SCRIPT LANGUAGE='JavaScript'>
				 window.alert('Unable to retrieve your first and last name from the database.  Contact your administrator $id')
				 window.location.href='../index.php';
				 </SCRIPT>";

		}
		else
		{
			$_SESSION['first'] = $rowID['first'];
			$_SESSION['last'] = $rowID['last'];
		}
?>
