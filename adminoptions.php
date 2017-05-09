<?php
  $callToActionVar = 'Administrator Options';
	include 'header.php';
?>

<?php
  $adminName = $_SESSION['First'];

	if ((isset($_SESSION['NetID'])) && ((string)$_SESSION['Credentials'] == '1'))
	{
    echo "
		<link href=\"css/bodyStyles.css\" type=\"text/css\" rel=\"stylesheet\" />
    <h2 class='contentAction' align='center'>Welcome, $adminName</h2>

    <div class='bodyContent'>

    <table align='center' style=\"font-family: verdana;\">
      <tr width=50>
        <td align='center'>Sign up a User</font></td>
        <td align='center'>View Faculty and Secretary Pages</td>
      </tr>
      <tr>
        <td align='center'><img src='src/user.png' width=150 /></td></center>
        <td align='center'><img src='src/magnifying_glass.png' width=150 /></td></center>
      </tr>
      <tr>
        <td colspan='2' align='center'></br>Add or Change:</br>Buildings, Departments, Courses, Semesters, Office Hours</td>
      </tr>
      <tr>
        <td colspan='2' align='center'><img src='src/office_building.png' width=150 /><img src='src/schedule.png' width=150 /><img src='src/study.png' width=150 /></td>
      </tr>
    </table>

      <!--<ul>
        <li id='pad'>Sign up a User</li>
        <li id='pad'>View Faculty and Secretary Pages</li>
        <li>Add or change the following:</li>
          <ul>
            <li>Departments</li>
            <li>Buildings</li>
            <li>Courses and Semesters</li>
            <li>Office Hours</li>
            <li>User Information</li>
          </ul>
      </ul>-->

      </div>
    ";
	}
	else
	{
		//echo '<script type='text/javascript'>alert('Please login to view this page')</script>';
		session_destroy();
		echo "<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('Please Login as an Admin to View This Page')
			 window.location.href='index.php';
			 </SCRIPT>";
	}
echo "
</div> <!-- End pagecontent Div -->
</div> <!-- End pagebody Div -->
</body>
</html>
"
?>
