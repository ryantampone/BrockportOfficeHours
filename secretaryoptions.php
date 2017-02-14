<?php
  $callToActionVar = 'Secretary Options';
	include 'header.php';
?>

<?php
	if ((isset($_SESSION['NetID'])) && (string)$_SESSION['Credentials'] == '2')
	{
		echo "
    <h2 align='center'>Welcome to the Secretary View</h2>
    <p align='center'>Here you can:</p>
    <div class='bodyContent'>
      <ul>
        <li>Sign up users</li>
        <li>Edit office hours of a faculty member</li>
        <li>Edit courses of a faculty member</li>
      </ul>
    </div>
    ";
	}
	else
	{
		//echo '<script type='text/javascript'>alert('Please login to view this page')</script>';
		session_destroy();
		echo "<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('Please Login as a Secretary to View This Page')
			 window.location.href='index.php';
			 </SCRIPT>";
	}
echo "
</body>
</html>
"
?>
