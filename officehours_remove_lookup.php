<?php
	$callToActionVar = "Remove Office Hours";
	include 'header.php';
	require('db_cn.inc');
?>
<?php
	$userdept = $_SESSION['DepartmentID'];

	if ((isset($_SESSION['NetID'])) && ((string)$_SESSION['Credentials'] == '1'))
	{
    echo "
    <h2 class='contentAction' align='center'>Select the department of the course you would like to remove</h2>
    <div class='bodyContent'>
		<form action='officehours_remove_list.php' method='post'>
			<input type='hidden' id='userdept' name='userdept' value='$userdept' />
			<table align='center'>
				<tr>
				  <td>
            <select id='netid' name='netid'>
              <option disabled hidden selected value=''>Select one</option>";
              connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
              $sql_fac = "SELECT * FROM Faculty WHERE Status='Active' ORDER BY LastName";
              $result_fac = mysql_query($sql_fac);

              while($row = mysql_fetch_assoc($result_fac))
              {
                $fac_netid = $row['NetID'];
                $fac_fn = $row['FirstName'];
                $fac_ln = $row['LastName'];

                echo "<option value=$fac_netid>$fac_ln, $fac_fn</option>";
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
	else if((isset($_SESSION['NetID'])) && (string)$_SESSION['Credentials'] == '2')
	{
    echo"
    <h2 class='contentAction' align='center'>Select the department of the course you would like to remove</h2>
    <div class='bodyContent'>
    <form action='officehours_remove_list.php' method='post'>
      <input type='hidden' id='userdept' name='userdept' value='$userdept' />
      <table align='center'>
        <tr>
          <td>
            <select id='netid' name='netid'>
              <option disabled hidden selected value=''>Select one</option>";
              connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
              $sql_fac = "SELECT * FROM Faculty WHERE Status='Active' AND DepartmentID='$userdept' ORDER BY LastName";
              $result_fac = mysql_query($sql_fac);

              while($row = mysql_fetch_assoc($result_fac))
              {
                $fac_netid = $row['NetID'];
                $fac_fn = $row['FirstName'];
                $fac_ln = $row['LastName'];

                echo "<option value=$fac_netid>$fac_ln, $fac_fn</option>";
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
    </div>";
	}

  else if((isset($_SESSION['NetID'])) && (string)$_SESSION['Credentials'] == '3')
	{
    $user_netid = $_SESSION['NetID'];
    echo"
    <h2 class='contentAction' align='center'>Select the department of the course you would like to remove</h2>
    <div class='bodyContent'>
    <form id='oh_lookup' action='officehours_remove_list.php' method='post'>
      <input type='hidden' id='usernet' name='usernet' value='$user_netid' />
      <table align='center'>
        <tr>
          <td>
            <select id='netid' name='netid'>
              <option disabled hidden selected value=''>Select one</option>";
              connect_and_select_db(DB_SERVER, DB_UN, DB_PWD,DB_NAME);
              $sql_fac = "SELECT * FROM Faculty WHERE Status='Active' AND DepartmentID='$userdept' ORDER BY LastName";
              $result_fac = mysql_query($sql_fac);

              while($row = mysql_fetch_assoc($result_fac))
              {
                $fac_netid = $row['NetID'];
                $fac_fn = $row['FirstName'];
                $fac_ln = $row['LastName'];

                echo "<option value=$fac_netid>$fac_ln, $fac_fn</option>";
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

    <script type='text/javascript'>
      var nid = document.getElementById('usernet').value;
      document.getElementById('netid').value = nid;
      document.getElementById('oh_lookup').submit();
    </script>
    ";
	}

	else
	{
		//echo '<script type='text/javascript'>alert('Please login to view this page')</script>';
		session_destroy();
		echo "<SCRIPT LANGUAGE='JavaScript'>
			 window.alert('Please Login as an Admin or Secretary to View This Page')
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
