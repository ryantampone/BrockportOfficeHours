<?php

//CREDENTIALS FOR DB
define ('DBSERVER', 'localhost');
define ('DBUSER', 'bportofficehours');
define ('DBPASS','bportofficehours');
define ('DBNAME','bportofficehours');

//LET'S INITIATE CONNECT TO DB
$connection = mysql_connect(DBSERVER, DBUSER, DBPASS) or die("Can't connect to server. Please check credentials and try again");
$result = mysql_select_db(DBNAME) or die("Can't select database. Please check DB name and try again");

//CREATE QUERY TO DB AND PUT RECEIVED DATA INTO ASSOCIATIVE ARRAY
if (isset($_REQUEST['query'])) {
    $query = $_REQUEST['query'];
    $sql = mysql_query ("SELECT NetID, FirstName, LastName FROM `Faculty` WHERE ((FirstName LIKE '%$enteredFacName%')
    OR (LastName LIKE '%$enteredFacName%') OR (NetID LIKE '%$enteredFacName%')) ORDER BY LastName");
	$array = array();
    while ($row = mysql_fetch_array($sql)) {
        $array[] = array (
            'label' => $row['LastName'].', '.$row['FirstName'],
            'value' => $row['NetID'],
        );
    }
    //RETURN JSON ARRAY
    echo json_encode ($array);
}

?>
