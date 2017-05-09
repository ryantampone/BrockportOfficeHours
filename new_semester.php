<?php
	$callToActionVar = "New Semester";
	include 'header.php';
	require('db_cn.inc');
?>
<?php
	if ((string)$_SESSION['Credentials'] == '1')
	{
    echo "
    <h2 class='contentAction' align='center'>Enter the information below to begin a new semester</h2>
    <center><h5><strong>NOTE: This will make the <font color='red'>CURRENT</font> semester become <font color='red'>PREVIOUS</font>, and cannot be undone</strong></h5></center>
    <div class='bodyContent'>
		<form id='new_semester' action='new_semester_process.php' method='post'>
			<table align='center'>
				<tr>
					<td><span align='right'>Year:</span></td>
					<td><input name='year' id='year' TYPE='text' SIZE='20' placeholder='(YYYY)' onKeyPress='return hasToBeNumber(event)' onblur='fourNumbers()' onpaste='return false;' required/></td>
				</tr>
        <tr>
					<td><span align='right'>Term:</span></td>
					<td>
            <select name='term' id='term' required>
              <option disable selected hidden value=''>Select one</option>
              <option value='Spring'>Spring</option>
              <option value='Summer'>Summer</option>
              <option value='Fall'>Fall</option>
              <option value='Winter'>Winter</option>
            </select>
          </td>
				</tr>
			</table>
			<p align='center'>
				<input type='Submit' value='Submit' onclick='confirmNewSemester();' />
        <input type='button' onclick=\"window.location.href='adminoptions.php'\" value='Back' />
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
