<?php
	$callToActionVar = "Office Hours Lookup";
	include 'header.php';
	require('db_cn.inc');
?>
<?php
	$selectFacStatement = "SELECT NetID FROM `Faculty`;";
	$FacResult = mysql_query($selectFacStatement);
	$facultyList = array();
	while($row = mysql_fetch_array($facultyList, MYSQL_NUM))
	{
		array_push($facultyList, $row[0]);
	}
?>
<?php
    echo "
    <h2 class='contentAction' align='center'>Search for Your Professor Below</h2>
    <div class='bodyContent'>
		<form action='officehours_lookup_process.php' method='post'>
			<table align='center'>
				<tr>
					<td><input type='text' name='FacultyName' id='FacultyName' onKeyPress='updateFaculty'></td>
					<td>
            <select name='netid' id='netid' style=\"width:160px;\" onpaste='return false' required>
              <option disable selected hidden value=''>Select one</option>
						</select>
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