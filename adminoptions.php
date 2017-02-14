<?php
  $callToActionVar = 'Admin Options';
	include 'header.php';
?>

<?php
	if ((isset($_SESSION['id'])) && (string)$_SESSION['Credentials'] == '1';)
	{
		echo "
    
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
</body>
</html>
"
?>
