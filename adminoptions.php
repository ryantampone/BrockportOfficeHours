<?php
  $callToActionVar = 'Administrator Options';
	include 'header.php';
?>

<?php
	if ((isset($_SESSION['NetID'])) && ((string)$_SESSION['Credentials'] == '1'))
	{
    echo "
		<link href=\"css/bodyStyles.css\" type=\"text/css\" rel=\"stylesheet\" />
    <h2 class='contentAction' align='center'>Welcome to the Administrator View</h2>
    <p align='center'>Here you can:</p>
    <div class='bodyContent'>
      <ul>
        <li>Sign up a User</li>
        <li>View Faculty and Secretary Pages</li>
        <li>Add or change the following:</li>
          <ul>
            <li>Departments</li>
            <li>Buildings</li>
            <li>Courses and Semesters</li>
            <li>Office Hours</li>
            <li>User Information</li>
          </ul>
      </ul>
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
