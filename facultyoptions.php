<?php
  $callToActionVar = 'Faculty Options';
	include 'header.php';
?>

<?php
	if ((isset($_SESSION['NetID'])) && (string)$_SESSION['Credentials'] == '3')
	{
		echo "
		<link href=\"css/bodyStyles.css\" type=\"text/css\" rel=\"stylesheet\" />
    <h2 align='center'>Welcome to the Faculty View</h2>
    <p align='center'>Here you can:</p>
    <div class='bodyContent'>
      <ul>
        <li>View your Office Hours and Schedule</li>
        <li>Add or Change your Office Hours</li>
      </ul>
    </div>
    ";
	}
	else
	{
		//echo '<script type='text/javascript'>alert('Please login to view this page')</script>';
		session_destroy();
		echo "<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('Please Login as a Faculty to View This Page')
			 window.location.href='index.php';
			 </SCRIPT>";
	}
echo "
</body>
</html>
"
?>
