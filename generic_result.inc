<?php
$callToActionVar = '';
include 'header.php';

function show_result($fullmessage)
{
  //----------------------------------------------------------
  // Start the html page
  echo "<HTML>";
  echo "<HEAD>";
  echo "</HEAD>";
  echo "<BODY>";

  // If the message is non-null and not an empty string print it
  if ($fullmessage)
  {
    if ($fullmessage != "")
       {
					echo "<SCRIPT LANGUAGE='JavaScript'>
						 window.alert('$fullmessage')
             window.location.href='index.php';
						 </SCRIPT>";
       }
  }

  //finishes the html body
  echo "
  </div> <!-- End pagecontent Div -->
  </div> <!-- End pagebody Div -->
  </body>
  </html>
  ";

}
?>
