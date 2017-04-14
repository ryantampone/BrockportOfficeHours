<?php
	$callToActionVar = "Office Hours Lookup";
	//include 'header.php';
	require('db_cn.inc');
	//require('officehours_lookup_process_result.php')
	//echo '<link href="css/searchStyles.css" type="text/css" rel="stylesheet" />';
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
		<link href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' rel='stylesheet'>
    <script src='//code.jquery.com/jquery-2.1.4.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
    <script src='//netsh.pp.ua/upwork-demo/1/js/typeahead.js'></script>
    <style>
        h1 {
            font-size: 20px;
            color: #111;
        }

        .content {
            width: 80%;
            margin: 0 auto;
            margin-top: 50px;
        }

        .tt-hint,
        .city {
            border: 2px solid #CCCCCC;
            border-radius: 8px 8px 8px 8px;
            font-size: 24px;
            height: 45px;
            line-height: 30px;
            outline: medium none;
            padding: 8px 12px;
            width: 400px;
        }

        .tt-dropdown-menu {
            width: 400px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px 8px 8px 8px;
            font-size: 18px;
            color: #111;
            background-color: #F1F1F1;
        }
    </style>
    <script>
        $(document).ready(function() {

            $('input.city').typeahead({
                name: 'city',
                remote: 'city.php?query=%QUERY'

            });

        })
    </script>
</head>

<body>
    <div class='content'>

        <form>
            <h1>Try it yourself</h1>
            <input type='text' name='city' size='30' class='city' placeholder='Search by Name, Email, Phone, NetID'>
        </form>
    </div>
</body>
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
