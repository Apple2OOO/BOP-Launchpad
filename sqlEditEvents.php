<html>
<style type = "text/css">
  body {
    background-color: rgb(241, 239, 233);
    font-family:"Helvetica";
    color: black;
 }
 h1, h2, h3, h4
 {
   font-family:"Trebuchet MS";
 }
  #tableheader {
    background-color: Gold

  }
    img {
    max-width: 100%;
    padding: 10px
    border: 10px solid #000000;
  }
  #name
  {
    color: #00d4ff
  }
</style>
</html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("connect.php");
/* if(isset($_POST["submit"])){*/

    //$_POST['deleteEvent']
    //$eventAudience = $_POST['eventAudience'];
    $eventDateTimeStart = $_POST['eventDateTimeStart'];
    $eventDateTimeEnd = $_POST["eventDateTimeEnd"];
    $eventName = $_POST['eventName'];
    $sysFilename = $_POST['sysFilename'];
    $eventDescription = $_POST['eventDescription'];
    $eventID = $_POST['eventID'];
    $eventAudience = $_POST['eventAudience'];


  /*  $arrEventAudience = $_POST['eventAudience'];
    if (count($arrEventAudience) == 1) {
    // If the array has only one value, output it without any delimiter
    $eventAudience = $arrEventAudience[0];
  } else
{
$eventAudience =   implode(', ', $arrEventaudience);
}*/
 /*$_POST['eventAudience'];
print "<br><br><br>eventDateTimeStart";
    echo $_POST['eventDateTimeStart'];
    print "<br><br><br>EVENTNAME";
  echo $_POST['eventName'];
  print "<br><br><br>FILENAME";
    echo $_POST['sysFilename'];
    print "<br><br><br>DESCRIPTION";
    echo $_POST['eventDescription'];
    print "<br><br><br>EVENTID";
    echo $_POST['eventID'];*/



    if (isset($_POST['deleteEvent'])) {
        $sql = mysqli_query($conn,  "DELETE FROM Files WHERE eventID='"
        . $eventID ."' ");
        print "
          <h1> Event <i>$eventName</i> successfully deleted.</h1>
          <br>
          <br>
          <a href='https://web.ics.purdue.edu/~appletoj/BDPA/frmEditEvents.php'>Delete Another Event</a>
          <br>
          <br>
          <a href='javascript:window.close();'>Close Window</a>
          <br>";

    } else if (isset($_POST['updateEvent'])) {
        $sql = mysqli_query($conn,  "UPDATE Files SET eventName='"
        . $_POST["eventName"] . "' ,eventDateTimeStart ='"
        . $_POST["eventDateTimeStart"] ."' ,eventDateTimeEnd ='"
        . $_POST["eventDateTimeEnd"] . "' ,eventDescription ='"
        . $_POST["eventDescription"] . "' ,sysFilename ='"
        . $_POST["sysFilename"] . "',eventAudience ='"
        . $eventAudience . "' ,eventLocation ='"
        . $_POST["eventLocation"] .  "'  ,eventUrl ='"
        . $_POST["eventUrl"] ."' WHERE eventID='" . $_POST["eventID"] ."' " );
        print "
          <h1> Event <i>$eventName</i> successfully updated.</h1>
          <br>
          <br>
          <a href='https://web.ics.purdue.edu/~appletoj/BDPA/frmEditEvents.php'>Update Another Event</a>
          <br>
          <br>
          <a href='javascript:window.close();'>Close Window</a>
          <br>";
        }
        else {
          echo "Site Error. Please contact site administrator";
        }
        ?>








      <!--  /*$sql = mysqli_query($conn,  "DELETE FROM Files WHERE eventID='"
        . $eventID ."' ");
           echo("Event successfully deleted.");
           print "<br>
             <a href='https://web.ics.purdue.edu/~appletoj/BDPA/frmEditEvents.php'>Delete Another Event</a>
             <br>
             <br>
             <a href='javascript:window.close();'>Back to Main Page</a>
             <br>"*/


   /*echo $eventName;
   echo $eventAudience;
   echo $eventDateTimeStart;
   echo $sysFilename;
   echo $eventDescription;*/ -->


      <!--  if(!isset($result))
        {
          echo "<script type=\"text/javascript\">
              alert(\"Invalid File:Please Upload CSV File.\");
              window.location = \"uploadUsers.php\"
              </script>";
        }
        else {
            echo "<script type=\"text/javascript\">
            alert(\"CSV File has been successfully Imported.\");
            window.location = \"index.php\"
          </script>";
        }
           }

           fclose($file);
     }*/

  /*}
  else {
    echo "Error";
    echo $_POST['eventName'];
  }/*
 ?> -->
