<?php
define('DB_SERVER', 'localhost'); // database server
define('DB_UN', 'bportofficehours'); // Database username
define('DB_PWD', 'bportofficehours'); // Database password
define('DB_NAME', 'brockportofficehours'); // Database name


function connect_and_select_db($server, $username, $pwd, $dbname)
{
  // Connect to db server
  $conn = mysql_connect($server, $username, $pwd);

  if (!$conn) {
      echo "Unable to connect to DB: " . mysql_error();
          exit;
  }

  // Select the database
  $dbh = mysql_select_db($dbname);
  if (!$dbh){
        echo "Unable to select ".$dbname.": " . mysql_error();
    exit;
  }
}

?>
