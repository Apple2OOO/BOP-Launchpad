<!DOCTYPE html>
<html lang="en">
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
    max-width: 20%;
    padding: 10px
    border: 10px solid #000000;
  }
  #name
  {
    color: #00d4ff
  }
  th, td {
    border-style: "groove";
  }
</style>
<?php
 session_start();
 /* include("login.php");
 echo $_POST("username"); */
    if (!isset($_SESSION['loggedin']))
        {
                 header('Location: login.php');
            }
        else
            {
              if(!isset($_SESSION['siteAdmin']))
                  {
                    header('location:https://web.ics.purdue.edu/~appletoj/BDPA/accessDenied.php');
                    //session_destroy();
                  }
                 if (isset($_POST['read']))
                     {
                         header('location:https://www.geeksforgeeks.org/about/');
                         session_destroy();
                     }
            }
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>
<body>
  <?php
    session_start();
    include("connect.php");
  $sql = mysqli_query($conn,
  "SELECT * FROM Users WHERE username='"
  . $_POST["username"] . "' AND
  password='" . $_POST["pwd"] . "' ");
      ?>

  <?php
  $sql = mysqli_query($conn,
  "SELECT eventID, eventName, eventDateTimeStart, eventDateTimeEnd, sysFilename, eventDescription, eventAudience, eventLocation, eventUrl FROM Files ORDER BY eventDateTimeStart DESC");

  if ($row = mysqli_fetch_array($sql)) {

    print "<table width=100% border=1>";
    print "<tr><th>Delete Event</th><th>Event</th><th>Start Date</th><th>End Date</th><th>Audience</th><th>Location</th><th>URL</th><th>Flyer</th><th>Description</th>";

  do {
    $eventAudience = $row['eventAudience'];
    $eventDateTimeStart = $row['eventDateTimeStart'];
    $eventDateTimeEnd = $row["eventDateTimeEnd"];
    $eventName = $row['eventName'];
    $sysFilename = $row['sysFilename'];
    $eventDescription = $row['eventDescription'];
    $eventID = $row['eventID'];
    $eventLocation = $row['eventLocation'];
    $eventUrl = $row['eventUrl'];

?>


  <tr>
    <?php
    echo  "<form action='sqlEditEvents.php' method='post' enctype='multipart/form-data'
      onSubmit=\"if(!confirm('Are you sure you want to delete/edit $eventName?')){return false;}\">"
    ?>
    <td>
        <input type='submit' name='deleteEvent' id='submitDelete' value='Delete Event'>
        <br>
        <br>
        <input type='submit' name='updateEvent' id='submitUpdate' value='Update Event'>
        <br>
        <br>
        <br>
    </td>
    <input type=hidden name=eventID id='eventID' value='<?php print $eventID; ?>'>
    <td><textarea name="eventName" id="eventName" style="height:150px;"><?php print $eventName; ?></textarea></td>
    <td><input type="datetime-local" name="eventDateTimeStart" id="eventDateTimeStart" value="<?php print $eventDateTimeStart; ?>"></td>
    <td><input type="datetime-local" name="eventDateTimeEnd" id="eventDateTimeEnd" value="<?php print $eventDateTimeEnd; ?>"></td>
    <td><textarea name="eventAudience" id="eventAudience" style="height:150px;width:200px;"><?php print $eventAudience; ?></textarea></td>
    <td><textarea name="eventLocation" id="eventLocation" style="height:150px;"><?php print $eventLocation; ?></textarea></td>
    <td><textarea name="eventUrl" id="eventUrl" style="height:150px;"><?php print $eventUrl; ?></textarea></td>
    <td><textarea name="sysFilename" id="sysFilename" style="height:150px;"><?php print $sysFilename; ?></textarea></td>
    <td><textarea name="eventDescription" id="eventDescription" style="width:500px;height:150px;"><?php print $eventDescription; ?></textarea></td>
  </tr>

<?php
print "</form>\n";
  } while ($row = mysqli_fetch_array($sql));
  print "</table>";
    #print "</form></table>\n";
  } else {
    print "There are no events available for deletion. Please create an event before attempting to delete it.";
  }
  ?>
  <br>
  <br>
  <a href="javascript:window.close();">Back to Main Page</a>
</body>
</html>
