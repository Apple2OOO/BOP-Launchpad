
<?php
session_start();
include("connect.php");
/* if(isset($_POST["submit"])){*/

    //$_POST['deleteEvent']
   $eventAudience = $_POST['eventAudience'];
   $eventDate = $_POST['eventDate'];
   $eventName = $_POST['eventName'];
   $sysFilename = $_POST['sysFilename'];
   $eventDescription = $_POST['eventDescription'];
   $eventID = $_POST['eventID'];
   /*echo $eventName;
   echo $eventAudience;
   echo $eventDate;
   echo $sysFilename;
   echo $eventDescription;*/

       $sql = mysqli_query($conn,  "DELETE FROM Files WHERE eventID='"
       . $eventID ."' ");/*",eventAudience ='"
       . $_POST["eventAudience"][0] . "\n" . $_POST["eventAudience"][1].
       "\n" . $_POST["eventAudience"][2]. "\n" . $_POST["eventAudience"][3].
       "\n" . $_POST["eventAudience"][4]. "\n" . "' "); //,sysFilename ='"*/
                   //$result = mysqli_query($conn, $sql);
          echo("Event successfully deleted.");
          print "<br>
            <a href='https://web.ics.purdue.edu/~somm/deleteEvents.php'>Delete Another Event</a>
            <br>
            <br>
            <a href='javascript:window.close();'>Back to Main Page</a>
            <br>"
            ?>
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
