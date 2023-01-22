<?php
 session_start();
 include("connect.php");
 if(!isset($_POST['read']))
{
    if (!isset($_SESSION['loggedin']))
        {
                 header('Location: login.php');
            }
        else
            {
                 if (isset($_POST['read']))
                     {
                         header('location:https://www.geeksforgeeks.org/about/');
                         session_destroy();
                     }
            }
}
?>
<?php

include("connect.php");

if(isset($_POST['submit'])) {
  $username = $_POST['username'];
  $currentPassword = $_POST['oldPassword'];
  $newPassword = $_POST['newPassword'];
  $confirmPassword = $_POST['confirmPassword'];
  if(($newPassword != $currentPassword) && ($newPassword == $confirmPassword)){
  	$query = mysqli_query($conn,
  	"UPDATE Users SET password='"
  	. $newPassword . "' WHERE username ='". $username ."'");
    echo "Password Changed Successfully
          <br><br>
              <a href='https://web.ics.purdue.edu/~appletoj/BDPA/login.php' target='_blank'>Back to Login</a>";
      } else{
    echo "Please confirm New password is not the same as old password.";
    print "<br><br>";
    echo "Please confirm New passwords match.";
  }
} else {
  echo "Error: Please resubmit form.";
}
   /*"'	 ,mobile	 ='"
	. $_POST["mob"] . "'	 ,password ='"
	. $_POST["pwd"] . "'	 ");*/
?>
