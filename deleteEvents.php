<!DOCTYPE html>
<html lang="en">
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
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>
<body>
  <?php
  $sql = mysqli_query($conn,
  "SELECT * FROM Users WHERE username='"
  . $_POST["username"] . "' AND
  password='" . $_POST["pwd"] . "' ");
      ?>
      <!--<p style="color:white">Ambitious and ggg creative business student at Purdue University with ample experience in a variety of leadership positions. Recognized for excellent organization, leadership, and efficiency. Admirable teamwork, leadership, and communication skills.</p>
  -->
  <?php
  $sql = mysqli_query($conn,
  "SELECT eventID, eventName, DATE_FORMAT(eventDate,'%M %D, %Y') as eventDate, sysFilename, eventDescription, eventAudience FROM Files ORDER BY eventDate DESC");
  //echo("YYYYY");
  //echo(mysqli_fetch_array($sql));

  if ($row = mysqli_fetch_array($sql)) {

    print "<table width=100% border=1>";
    print "<tr><th>Delete Event</th><th>Event</th><th>Date</th><th>Audience</th><th>Flyer</th><th>Description</th>";

  do {
    $eventAudience = $row['eventAudience'];
    $eventDate = $row['eventDate'];
    $eventName = $row['eventName'];
    $sysFilename = $row['sysFilename'];
    $eventDescription = $row['eventDescription'];
    $eventID = $row['eventID'];

?>
  <form action='sqlDeleteEvents.php' method='post' enctype='multipart/form-data'>

  <tr>
    <td><input type='submit' name='deleteEvent' id='submit' value='Delete Event'></td>
    <input type=hidden name=eventID id='eventID' value='<?php print $eventID; ?>'>
    <td><?php print $eventName; ?></td>
    <td><?php print $eventDate; ?></td>
    <td><?php print $eventAudience; ?></td>
    <td><?php print $sysFilename; ?></td>
    <td><?php print $eventDescription; ?></td>
  </tr>

<?php
  } while ($row = mysqli_fetch_array($sql));
    print "</form></table>\n";
  } else {
    print "There are no events available for deletion. Please create an event before attempting to delete it.";
  }
  ?>
  <br>
  <br>
  <a href="javascript:window.close();">Back to Main Page</a>
</body>
</html>
