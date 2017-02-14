<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>Brockport Faculty Office Hours</title>

		<link rel='shortcut icon' type='image/x-icon' href='src/favicon.ico' />
    <link href="css/headerStyles.css" type="text/css" rel="stylesheet" />

		<script language="javascript">
					function hasToBeNumber(evt)
					{
						var charCode = (evt.which) ? evt.which : event.keycode
						if (charCode > 31 && (charCode < 48 || charCode > 57))
							return false;
						return true;
					}

					function isZipCode(evt)
					{
						var charCode = (evt.which) ? evt.which : event.keycode
						if ((charCode > 31 && (charCode < 48 || charCode > 57)) && (charCode.length == 5))
							return false;
						return true;
					}

					function hasToBeLetter(evt)
					{
						var charCode = (evt.which) ? evt.which : event.keycode
						if  ((charCode > 31 && (charCode < 65 || charCode > 90)) && (charCode > 31 && (charCode < 97 || charCode > 122)))
							return false;
						return true;
					}

					function hasToBeNumberOrLetter(evt)
					{
						var charCode = (evt.which) ? evt.which : event.keycode
						if  ((charCode > 31 && (charCode < 48 || charCode > 57)) && (charCode > 31 && (charCode < 65 || charCode > 90)) && (charCode > 31 && (charCode < 97 || charCode > 122)))
							return false;
						return true;
					}

					function isTime(evt)
					{
						var charCode = (evt.which) ? evt.which : event.keycode
						if ((charCode > 31 && (charCode < 58 || charCode > 58)) && (charCode > 31 && (charCode < 48 || charCode > 57)) && (charCode > 31 && (charCode < 65 || charCode > 90)) &&
							(charCode > 31 && (charCode < 97 || charCode > 122)))
							return false;
						return true;
					}

					function isTextNameKey(evt)
					{
						var charCode = (evt.which) ? evt.which : event.keycode
						if  ((charCode > 31 && (charCode < 65 || charCode > 90)) && (charCode > 31 && (charCode < 97 || charCode > 122)) && (charCode > 31 && (charCode < 45 || charCode > 45)) &&
						(charCode > 31 && (charCode < 39 && charCode > 39)) && (charCode > 31 && (charCode < 92 && charCode > 92)))
							return false;
						return true;
					}

					function isTextCityOrPersonKey(evt)
					{
						var charCode = (evt.which) ? evt.which : event.keycode
						if  ((charCode > 31 && (charCode < 65 || charCode > 90)) && (charCode > 31 && (charCode < 97 || charCode > 122)) && (charCode > 31 && (charCode < 45 || charCode > 45)) && (charCode > 31 && (charCode < 32 || charCode > 32)) &&
						(charCode > 31 && (charCode < 39 || charCode > 39)) && (charCode > 31 && (charCode < 92 || charCode > 92)))
							return false;
						return true;
					}

					function isKey(evt)
					{
						var charCode = (evt.which) ? evt.which : event.keycode
						if ((charCode > 31 && (charCode < 65 || charCode > 90)) && (charCode > 31 && (charCode < 97 || charCode > 122)) && (charCode > 31 && (charCode < 48 || charCode > 58)) &&
						(charCode > 31 && (charCode < 45 || charCode > 45)) && (charCode > 31 && (charCode < 46 || charCode > 46)) && (charCode > 31 && (charCode < 95 || charCode > 95)))
							return false;
						return true;
					}

					function isEmail(evt)
					{
						var charCode = (evt.which) ? evt.which : event.keycode
						if ((charCode > 31 && (charCode < 47 || charCode > 47)) && (charCode > 31 && (charCode < 39 || charCode > 39)) && (charCode > 31 && (charCode < 92 || charCode > 92)))
							return true;
						return false;
					}

					function isPhoneNumber1()
					{
						var phonenumber = document.getElementById("phone1").value;
						if (phonenumber != "")
						{
							var pattern = /^\d{3}-\d{3}-\d{4}$/;
							if (phonenumber.match(pattern))
								return;
							else
							{
								alert("Invalid Phone Number, must be in the format ###-###-####");
								document.getElementById("phone1").value = "";
							}
						}
					}

					function isPhoneNumber2()
					{
						var phonenumber = document.getElementById("phone2").value;
						if (phonenumber != "")
						{
							var pattern = /^\d{3}-\d{3}-\d{4}$/;
							if (phonenumber.match(pattern))
								return;
							else
							{
								alert("Invalid Phone Number, must be in the format ###-###-####");
								document.getElementById("phone2").value = "";
							}
						}
					}

					function hasToBeDate()
					{
						var mydate = document.getElementById("date").value;
						var pattern = /^\d{4}-\d{2}-\d{2}$/;
						if (mydate.match(pattern))
							return;
						else
						{
							alert("Invalid Date Format, must be in the format YYYY-MM-DD");
							document.getElementById("date").value = "";
						}
					}

					function checkpwds()//checks to make sure passwords are identical
					{
						var pwd1 = document.getElementById("pwd").value;
						var pwd2 = document.getElementById("pwdcheck").value;
						if (pwd2 != "")
						{
							if (pwd1 != pwd2)
							{
								document.getElementById("pwdcheck").value = "";
								document.getElementById("pwdcheck").focus();
								alert("Passwords do not match");
							}
						}
					}

					/* If credentials = 1 (admin), then department = null
								credentials = 2 or 3 (secretary or faculty), then department can be chosen
					*/
					function checkCreds()
					{
						var creds = document.getElementById("access").value;
						if (creds == 1)
						{
							document.getElementById("dept").value = "none";
							document.getElementById("dept").disabled();
						}
						else
						{
							document.getElementById("dept").enabled();
						}
					}

		</script>
</head>
<!-- <body bgcolor="#F5F5F5">#FFFFFF -->
<body bgcolor="#FFFFFF">
<!-- ====================== Begin Page Header ====================== -->
<div id="nav">
  	<div id="nav_wrapper">
        <ul>
						<li>
							<?php
									//$firstName = (string)$_SESSION['first'];
									///$lastName = (string)$_SESSION['last'];
									$NetID = (string)$_SESSION['NetID'];
									$credentials= (string)$_SESSION['Credentials'];
                  if (isset($_SESSION['NetID']))
									{
											//echo "<li><a href='index.php'>$firstName $lastName's $access dashboard</a> </li><li>";
											if ($credentials == '1')
											{
												echo "<li><a href='#'>Dashboards</a>";
												echo "<ul><li><a href='studentoptions.php'>Student Dashboard</a></li>";
												echo "<li><a href='coachoptions.php'>Coach Dashboard</a></li></ul></li>";
											}
											if ($credentials == '2')
											{
												echo "<li><a href='forecast_student_select_process.php'>Past Forecasts</a>";
											}
											if ($credentials == '3')
											{
												echo "<li><a href='forecast_student_select_process.php'>Past Forecasts</a>";
											}

											echo "<li><a href='#'>Options</a>";
											echo "<ul><li><a href='changepassword.php'>Change Password</a></li>";
											echo "<li><a href='login/logout.php'>Sign Out</a></li></ul></li>";
									}
									else
									{
											echo "<li><a href='index.php'>Home</a>";
											echo "<li><a href='user_signup.php'>Sign up</a>";
											echo "<li><a href='forgotpassword.php'>Forgot Password</a>";
											//echo "<center><h4 style='color:white;'>Please Login with Your Username and Password</h4></center>";
									}
              ?>
          	</li>
    		</ul>
		</div>
</div>
<?php
echo"
<div class='callToActionBox'>
    <!-- <img src='src/callToActionHeader.png' alt='header'/> -->
    <div class='callToActionContent'>
        $callToActionVar
    </div>
</div>
"
?>

				<!-- =========================End of Header======================== -->
