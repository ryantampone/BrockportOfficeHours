<?php
	$callToActionVar = 'Office Hours System';
	include 'header.php';
	include 'dbh.php';
	echo '<link href="css/indexStyles.css" type="text/css" rel="stylesheet" />';
?>
<?php
		if (isset($_SESSION['NetID']))
		{
				$credentials = (string)$_SESSION['Credentials'];
				$loginID = (string)$_SESSION['id'];
				$callToAction = 'TEST';


				if ($credentials == '1')
				{
					 echo "<SCRIPT LANGUAGE='JavaScript'>window.location.href='adminoptions.php';</SCRIPT>";
				}
				else if ($credentials == '2')
				{
					echo "<SCRIPT LANGUAGE='JavaScript'>window.location.href='secretaryoptions.php';</SCRIPT>";
				}
				else if ($credentials == '3')
				{
					echo "<SCRIPT LANGUAGE='JavaScript'>window.location.href='facultyoptions.php';</SCRIPT>";
				}

		}
		else
		{
				echo"



						<center>
						<br><br><br><br><br>
						<!-- <div id='callToAction'>
							Sign in to access your account
						</div> -->
						<h2 class='contentAction'>Sign in to access your account</h2>
						<div id='login'>
							<div class='innerTable'>
							<p align='center'><img src='src/login_icon.png' height='110' width='110'/></p>
							<form action='login/login.php' method='POST'>
									<input type='text' name='netid' id='netid' placeholder='NetID' onKeyPress='return hasToBeNumberOrLetter(event)' SIZE='35' style='margin-bottom: 10px' required>
									<input type='password' name='pwd' id='pwd' placeholder='Password' SIZE='35' style='margin-bottom: 5px' required><br>
									<button class='button' type='submit' name='submit' id='submit' onClick=''>Sign in</button>
							</form>
							</div>
						</div>
						</center>
						";
		}


?>
<!--
<div class='actionButtonbutton'>
<input id='tiny_button' type='submit' id='submit' name='submit' value='testingbutton'>
</div>
-->

</div> <!-- End pagecontent Div -->
</div> <!-- End pagebody Div -->
</div> <!-- End Container Div -->
</body>
</html>
