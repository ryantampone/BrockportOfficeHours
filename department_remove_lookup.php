<?php
	$callToActionVar = "Remove Department";
	include 'header.php';
	require('db_cn.inc');
?>
<?php
	if ((isset($_SESSION['NetID'])) && ((string)$_SESSION['Credentials'] == '1'))
	{
    echo "
    <h2 class='contentAction' align='center'>Select the department you would like to remove</h2>
    <div class='bodyContent'>
		<form action='department_remove.php' method='post'>
			<table align='center'>
				<tr>
				  <td>
            <select name='deptid' id='deptid' />";
						  connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
              $sql_dept = "SELECT * FROM Department WHERE Status='Active' ORDER BY Name";
							$result_dept = mysql_query($sql_dept);

							while($row = mysql_fetch_assoc($result_dept))
							{
								$deptName = $row['Name'];
								$deptID = $row['DepartmentID'];

								echo "<option value=$deptID>$deptName</option>";
							}
			echo "</select>
          </td>
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
