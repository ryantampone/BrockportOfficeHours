<?php
  $callToActionVar = 'Secretary Options';
	include 'header.php';
?>

<?php
  $secName = $_SESSION['First'];

	if ((isset($_SESSION['NetID'])) && (string)$_SESSION['Credentials'] == '2' || (string)$_SESSION['Credentials'] == '1')
	{
		echo "
		<link href=\"css/bodyStyles.css\" type=\"text/css\" rel=\"stylesheet\" />
    <h2 class='contentAction' align='center'>Welcome, $secName</h2>

    <table align='center' style=\"font-family: verdana;\">
      <tr width=50>
        <td align='center' style=\"padding-left: 50px; padding-right: 50px;\">Add or Change Office Hours</font></td>
        <td align='center' style=\"padding-left: 50px; padding-right: 50px;\">Add or Change Courses</font></td>
      </tr>
      <tr>
        <td align='center' style=\"padding-left: 50px; padding-right: 50px;\"><img src='src/interview.png' width=150 /></td></center>
        <td align='center' style=\"padding-left: 50px; padding-right: 50px;\"><img src='src/Calendar-icon.png' width=150 /></td></center>
      </tr>
    </table>


    <!--<p align='center'>Here you can:</p>
    <div class='bodyContent'>
      <ul>
        <li>Edit office hours of a faculty member</li>
        <li>Edit courses of a faculty member</li>
      </ul>
    </div>-->
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
