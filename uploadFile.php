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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connect.php");
//$target_dir = "uploads/";
$target_dir = "Uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

    //  $sql = mysqli_query($conn,
    //  "SELECT * FROM Users WHERE username='"
    //  . $_POST["username"] . "' AND
    //  password='" . $_POST["pwd"] . "' ");
//ßecho $_POST["filename"]
    //  session_start();
//      $sql = mysqli_query($conn, "INSERT INTO Files SET userFilename='fn71',fileDescription='fd17'"); /*"INSERT INTO Files SET userFilename='"
  // Delimit eventAudience Array
  $arrEventaudience = $_POST['eventAudience'];
  if (count($arrEventaudience) == 1) {
  // If the array has only one value, output it without any delimiter
  $delimitedEventAudience = $arrEventaudience[0];
} else {
  // If the array has only two values, delimit them with an ampersand
  $delimitedEventAudience = implode(',', $arrEventaudience);
}
      $sql = mysqli_query($conn,  "INSERT INTO Files SET eventName='"
      . $_POST["eventName"] . "' ,eventDateTimeStart ='"
      . $_POST["eventDateTimeStart"] ."' ,eventDateTimeEnd ='"
      . $_POST["eventDateTimeEnd"] . "' ,eventDescription ='"
      . $_POST["eventDescription"] . "' ,sysFilename ='"
      . $_FILES["fileToUpload"]["name"] . "',eventAudience ='"
      . $delimitedEventAudience . "' ,eventLocation ='"
      . $_POST["eventLocation"] .  "'  ,eventUrl ='"
      . $_POST["eventUrl"] ."'" );

      echo "Event successfully created.";
      ?>
      <?php
      date_default_timezone_set('America/New_York');
      if(isset($_POST['createCalendarInvite'])){

      $to = "somm@purdue.edu";
      $subject = "LaunchpadEvent";

      $eventName = $_POST["eventName"];
      $eventDateTimeStart = $_POST["eventDateTimeStart"];
      $eventDateTimeEnd = $_POST["eventDateTimeEnd"];
      $eventAudience =  $delimitedEventAudience;//"Seniors";
      $eventLocation = $_POST["eventLocation"];
      $eventUrl = $_POST["eventUrl"];
      $eventDescription = $_POST["eventDescription"];
      $eventDateTimeStart = date("Y-m-d H:i", strtotime($_POST["eventDateTimeStart"]));
      $eventDateTimeEnd = date("Y-m-d H:i", strtotime($_POST["eventDateTimeEnd"]));


        //echo date("Y-m-d H:i", strtotime($_POST["eventDateTimeEnd"]));

        //echo $eventDateTimeStart;
        //echo $eventDateTimeEnd;


      $message =  "
        Event Name: | $eventName|
        Start DateTime: | $eventDateTimeStart|
        End DateTime: | $eventDateTimeEnd|
        Audience: | $eventAudience|
        Location: | $eventLocation|
        URL: | $eventUrl|
        Description: | $eventDescription
      ";
      $headers[] = 'MIME-Version: 1.0';
      $headers[] = 'Content-type: text/html; charset=UTF-8';
      $headers_string = implode("\r\n", $headers);

      mail($to, $subject, $message, $headers_string);
      echo "<br><br>Calendar Invite Successfully Created";
      }
      ?>

      <br>
      <br>
      <a href="javascript:window.close();">Back to Main Page</a>
      <br>
      <?php

  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>
