<?php
  $callToActionVar = 'Secretary Options';
	include 'header.php';
?>

<?php
	if ((isset($_SESSION['NetID'])) && (string)$_SESSION['Credentials'] == '2' || (string)$_SESSION['Credentials'] == '1')
	{
		echo "
		<link href=\"css/bodyStyles.css\" type=\"text/css\" rel=\"stylesheet\" />
    <h2 class='contentAction' align='center'>Welcome to the Secretary View</h2>
    <p align='center'>Here you can:</p>
    <div class='bodyContent'>
      <ul>
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
  </div> <!-- End pagecontent Div -->
  </div> <!-- End pagebody Div -->
  </body>
  </html>
  ";
?>
