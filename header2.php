<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <title>Brockport Faculty Office Hours</title>

		<link rel='shortcut icon' type='image/x-icon' href='src/favicon.ico' />

		<link href="css/genericStyles.css" type="text/css" rel="stylesheet" />
    <link href="css/headerStyles.css" type="text/css" rel="stylesheet" />
		<link href="css/bodyStyles.css" type="text/css" rel="stylesheet" />
		<!-- <link href="css/cssDebug.css" type="text/css" rel="stylesheet" /> --> <!-- Uncomment this to test issues with CSS display -->

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

						if (creds == 1 || creds == "")
						{
							resetAdmin();
						}
						else if (creds == 2)
						{
							document.getElementById("dept").disabled = false;
							document.getElementById("room").value = "";
							document.getElementById("email").value = "";
							document.getElementById("phone2").value = "";
							document.getElementById("room").disabled = true;
							document.getElementById("email").disabled = true;
							document.getElementById("phone2").disabled = true;
						}
						else
						{
							document.getElementById("dept").disabled = false;
						}
					}

					function checkTime()
					{
					  var start1 = document.getElementById("start").value;
					  var end1 = document.getElementById("end").value;
					  var startStr = start1.split(":");
					  var endStr = end1.split(":");
					  var start2 = startStr[0].concat(startStr[1]);
					  var end2 = endStr[0].concat(endStr[1]);

					  if(document.getElementById("submitButton").disabled == true)
					  {
					    if(start2 < end2)
					    {
					      document.getElementById("submitButton").disabled = false;
					    }
					  }
					  else if(document.getElementById("submitButton").disabled == false)
					  {
					    if(start2 > end2)
					    {
					      alert("Start time cannot be later than end time.\nPlease check your times and try again.");
					      //timebox.value = 0000;
					      document.getElementById("submitButton").disabled = true;
					    }
					  }
					}

					function twoNumbers()
					{
						var section = document.getElementById("coursesection").value;
						var pattern = /^\d{2}$/;
						if (section.match(pattern))
							return;
						else
						{
							alert("Invalid Section Format\nMust be in the format: ##");
							document.getElementById("coursesection").value = "";
						}
					}

					function selectFaculty()
					{
						var acc = document.getElementById("access").value;
						var roomT = document.getElementById("room");
						var emailT = document.getElementById("email");
						var phoneT = document.getElementById("phone2");

						if (acc == 3)
						{
							roomT.disabled = false;
							emailT.disabled = false;
							phoneT.disabled = false;
						}
						else
						{
							roomT.disabled = true;
							emailT.disabled = true;
							phoneT.disabled = true;
						}
					}

					function resetFaculty()
					{
						document.getElementById("room").disabled = false;
						document.getElementById("email").disabled = false;
						document.getElementById("phone2").disabled = false;
					}

					function resetAdmin()
					{
						document.getElementById("dept").disabled = true;
						document.getElementById("dept").value = "none";
						document.getElementById("room").value = "";
						document.getElementById("email").value = "";
						document.getElementById("phone2").value = "";
						document.getElementById("room").disabled = true;
						document.getElementById("email").disabled = true;
						document.getElementById("phone2").disabled = true;
					}

					function checkEnables(acc)
					{
						if (acc == 1)
							resetAdmin();
						else if (acc == 3)
						{
							resetFaculty();
							document.getElementById("dept").disabled = false;
						}
						else
						{
							document.getElementById("dept").disabled = false;
							document.getElementById("room").value = "";
							document.getElementById("email").value = "";
							document.getElementById("phone2").value = "";
							document.getElementById("room").disabled = true;
							document.getElementById("email").disabled = true;
							document.getElementById("phone2").disabled = true;
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

											<li><a href='http://www.brockport.edu' target='_blank'>Brockport Homepage</a>
											<li><a href='officehours_lookup.php'>Search</a>

          	</li>
    		</ul>
		</div>
</div>
<?php
echo"
<div class='callToActionBox'>
    <!-- <img src='src/callToActionHeader.png' alt='header'/> -->
    <div class='callToActionContent'>
        <center>$callToActionVar</center>
    </div>
</div>
"
?>
				<!-- =========================End of Header======================== -->


				<!-- *************************Begin Body*************************** -->
<!--
<div class="pagebody">
<div class="pagecontent">
-->
