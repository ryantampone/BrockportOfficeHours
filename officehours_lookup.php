<?php
	$callToActionVar = "Office Hours Lookup";
	include 'header2.php';
	require('db_cn.inc');
	//require('officehours_lookup_process_result.php');
	echo '<link href="css/searchStyles.css" type="text/css" rel="stylesheet" />';
?>

<?php/*
	$selectFacStatement = "SELECT NetID FROM `Faculty`;";
	$FacResult = mysql_query($selectFacStatement);
	$facultyList = array();
	while($row = mysql_fetch_array($facultyList, MYSQL_NUM))
	{
		array_push($facultyList, $row[0]);
	}*/
?>
<?php
    echo "

    <h2 class='contentAction' align='center'>Search for Your Professor Below</h2>
    <div class='bodyContent'>
		<form action='officehours_lookup_process.php' method='post' autocomplete='false'>
			<table align='center'>
				<tr>
					<td><input type='search' name='FacultyName' id='FacultyName' onKeyUp='updateFaculty()' placeholder='Search...' autocomplete='off'></td>
					<td valign='center'><input type='submit' value='Go'/></td>
				</tr>
				<tr>
					<td>
					<!--
            <select name='netid' id='netid' style=\"width:160px;\" onpaste='return false' required>
              <option disable selected hidden value=''>Select one</option>
						</select>
						-->

						<select name='netid' id='netid' multiple='multiple' size='1'>
							<option disable selected hidden value=''>Select one</option>
						</select>
          </td>
				</tr>
			</table>
			<p align='center'>

			</p>
		</form>
    </div>
    ";

echo "
</div> <!-- End pagecontent Div -->
</div> <!-- End pagebody Div -->
<script src='scripts/jquery-3.1.1.js'></script>
<script src='scripts/officehours_lookup_ajax.js'></script>
</body>
</html>
";
?>

</body>
</html>
