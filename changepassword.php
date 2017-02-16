<?php
$callToActionVar = 'Change Password';
include 'header.php';



echo "
<center><h2>Update your password</h2></center>
  <div id='userpasswordform'>
        <form action='changepassword_process.php' method='post'>
            <table align='center'>
                <td><input name='uid' id='uid' TYPE='hidden' value='$netID' /></td>
                <tr>
                    <td><span align='right'>New Password:</span></td>
                    <td><input name='pwd' id='pwd' TYPE='password' SIZE='50' required/></td>
                </tr>
                <tr>
                    <td><span align='right'>Retype Password:</span></td>
                    <td><input name='pwdcheck' id='pwdcheck' TYPE='password' SIZE='50' onblur='checkpwds()' required/></td>
                </tr>
            </table>
            <p align='center'>
                <input type='submit' value='Submit'/>
                <input type='reset' value='Reset'/>
            </p>
        </form>
    </div>
";
//finishes the html body
echo "</BODY>";
echo "</HTML>";

?>
