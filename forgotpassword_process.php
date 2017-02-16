<?php
require('db_cn.inc');

forgot_password();
function forgot_password()
{
	connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
	$netID = $_POST['netID'];
	//check to make sure there is a user with the provided netID
	$sql_stmt = "SELECT * FROM `Users` WHERE NetID='$netID';";

	$result = mysql_query($sql_stmt);
	$message = "";
	$numrows = mysql_num_rows($result);
	if (!$result)
	{
  	  $message = "An unknown error occured.  Please contact an admin for further assistance: ". mysql_error();
			echo "<SCRIPT LANGUAGE='JavaScript'>
				 window.alert(\"$message\")
				 window.location.href='forgotpassword.php';
				 </SCRIPT>";
	}
	else if ($numrows == 0)
	{
	  $message = "No user found with the provided NetID.  Check your provided NetID and try again.";
		echo "<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('$message')
			 window.location.href='forgotpassword.php';
			 </SCRIPT>";
	}
	else
	{
		//password reset code
		$rand = substr(md5(microtime()),rand(0,26),5);

		//used to store password reset code in database
		$sql_stmt2 = "UPDATE `Users` SET PWDResetCode='$rand' WHERE NetID='$netID';";
		$result2 = mysql_query($sql_stmt2);
		$message2 = "";
		if (!$result2)
		{
			$message2 = "An error occured reseting your password.  Please contact an admin for further assistance: ". mysql_error();
			echo "<SCRIPT LANGUAGE='JavaScript'>
				 window.alert(\"$message2\")
				 window.location.href='forgotpassword.php';
				 </SCRIPT>";
		}
		else
		{
			//email password reset code and instructions to brockport email
			$emailSubject = "Password Reset: Brockport Office Hours Account";
			$emailText = "We have received your request to reset your password.  Your reset code is $rand. Please click the following link to change your password: http://www.ryantampone.com/brockportofficehours/forgotpassword_reset.php";
			$emailAddress = $netID.'@brockport.edu';

			$toEmail = $emailAddress;
			$subjectEmail = $emailSubject;
			$txtEmail = $emailText;
			$headersEmail = "From: <brockportofficehours>"; //<brockportofficehours@ryantampone.com>
			mail($toEmail,$subjectEmail,$txtEmail,$headersEmail);

			echo "<SCRIPT LANGUAGE='JavaScript'>
				 window.alert('Check your inbox ($emailAddress) for instructions to reset your password.')
				 window.location.href='index.php';
				 </SCRIPT>";
		}
	}
}

?>
