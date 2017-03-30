<?php
	$callToActionVar = "Remove User";
	include 'header.php';
	require('db_cn.inc');
?>
<?php
	if ((isset($_SESSION['NetID'])) && ((string)$_SESSION['Credentials'] == '1'))
	{
    echo "
    <h2 class='contentAction' align='center'>Enter the Net ID of the user you would like to remove</h2>
    <div class='bodyContent'>
		<form action='user_remove.php' method='post'>
			<table align='center'>
				<tr>
					<td><span align='right'>Net ID:</span></td>
				  <td><input id='netid' name='netid' type='text' size='20' onkeypress='return hasToBeNumberOrLetter(event)' required /></td>
        </tr>
			</table>
			<p align='center'>
				<input type='submit' value='Submit'/>
				<input type='reset' value='Reset'/>
			</p>
		</form>
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

</body>
</html>
