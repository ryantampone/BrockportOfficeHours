<?php
	$callToActionVar = 'Office Hours System';
	include 'header.php';
	include 'dbh.php';
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


				<style>
						.button
						{
						    background-color: #5193FB;
						    border: none;
						    color: white;
						    padding: 10px 94px;
						    text-align: center;
						    text-decoration: none;
						    display: inline-block;
						    font-size: 16px;
						    margin: 4px 2px;
						    cursor: pointer;
						}

						input[type=text]
						{
						    width: 80%;
						    padding: 5px 20px;
						    margin: 0px 0;
						    box-sizing: border-box;
								font-size:18px;
						}

						input[type=password]
						{
								width: 80%;
								padding: 5px 20px;
								margin: 0px 0;
								box-sizing: border-box;
								font-size:18px;
						}

						#callToAction
						{
							color: #444444;
							font-size: 35px;
							font-family: 'Roboto', sans-serif;
							font-weight: 200;
						}
				</style>

						<center>
						<br><br><br><br><br>
						<div id='callToAction'>
							Sign in to access your account
						</div>
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

</body>
</html>
