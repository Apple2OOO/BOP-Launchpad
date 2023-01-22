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
    max-width: 75%;
    padding: 10px
    border: 10px solid #000000;
  }
  #name
  {
    color: #00d4ff
  }
</style>

<!--</body>
<</html>
<html>
<body>-->
<h1 style="font-family: Monospace; text-align:center; color:GoldenRod" id="Name" >Business Opportunity Program Launchpad</h1>
<right><h5 style="font-family: Monospace; text-align:right; color:Black"><a href="https://web.ics.purdue.edu/~appletoj/BDPA/logout.php">Log Out</a></h5>

<title>BOP Launchpad</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
  <div class="w3-bar w3-black" style="color:black">
    <button class="w3-bar-item w3-button tablink" onclick="openTab(event,'Homepage')" id="defaultOpen">Homepage</button>

    <!--<button class="w3-bar-item w3-button tablink" onclick="openTab(event,'Administration')">Administration</button>-->
    <button class="w3-bar-item w3-button tablink" onclick="openTab(event,'All Members')">All Members</button>
        <button class="w3-bar-item w3-button tablink" onclick="openTab(event,'Freshmen')">Freshmen</button>
        <button class="w3-bar-item w3-button tablink" onclick="openTab(event,'Sophomores')">Sophomores</button>
        <button class="w3-bar-item w3-button tablink" onclick="openTab(event,'Juniors')">Juniors</button>
        <button class="w3-bar-item w3-button tablink" onclick="openTab(event,'Seniors')">Seniors</button>


  </div>

  <div id="Homepage" class="w3-container w3-border Tab">
    <h2 style="color:gray"><p style="text-align:center">Welcome To The Launchpad</p></h2>
    <p style="color:black">Welcome to the Business Opportunity Program Launchpad. Click the tab above that corresponds to your class to see professional development opportunties available to you now.</p>
    <p style="text-align:center">
      <!--<a href="https://web.ics.purdue.edu/~appletoj/BDPA/formChangePassword.php" target="_blank">Change Password</a>
       |-->
      <a href="https://web.ics.purdue.edu/~appletoj/BDPA/siteAdmin.php" target="_blank">Site Administration</a>
    </p>

  </div>
  <div id="All Members" class="w3-container w3-border Tab">
    <h2 style="color:gray"><p style="text-align:center">Opportunities For All Members</p></h2>
        <?php
        $sql = mysqli_query($conn,
        "SELECT * FROM Users WHERE username='"
        . $_POST["username"] . "' AND
        password='" . $_POST["pwd"] . "' ");
            ?>
            <!--<p style="color:black">Ambitious and ggg creative business student at Purdue University with ample experience in a variety of leadership positions. Recognized for excellent organization, leadership, and efficiency. Admirable teamwork, leadership, and communication skills.</p>
        -->
        <?php
        $sql = mysqli_query($conn,
        "SELECT eventName, DATE_FORMAT(eventDateTimeStart,'%M %D, %Y') as eventDateStart, DATE_FORMAT(eventDateTimeStart, '%h:%i %p') as eventTimeStart, DATE_FORMAT(eventDateTimeEnd,'%M %D, %Y') as eventDateEnd, DATE_FORMAT(eventDateTimeEnd, '%h:%i %p') as eventTimeEnd, sysFilename, eventDescription, eventAudience, eventLocation, eventUrl
          FROM (select * from `Files`WHERE
                (eventAudience LIKE'%All Members%')
                ORDER BY eventDateTimeStart ASC) as s1
          WHERE eventDateTimeStart >= CURDATE()");

        if ($row = mysqli_fetch_array($sql)) {
          print "<ul style:'list-style-type:square;'>";
        do {
          $eventDateStart = $row['eventDateStart'];
          $eventTimeStart = $row["eventTimeStart"];
          $eventDateEnd = $row['eventDateEnd'];
          $eventTimeEnd = $row["eventTimeEnd"];
          $eventName = $row['eventName'];
          $sysFilename = $row['sysFilename'];
          $eventDescription = $row['eventDescription'];
          $eventLocation = $row['eventLocation'];
          $eventUrl = $row['eventUrl'];


          $arrEventAudience = explode(',', $row['eventAudience']);
          if (count($arrEventAudience) == 1) {
          // If the array has only one value, output it without any delimiter
          $eventAudience = $arrEventAudience[0];
        } elseif (count($arrEventAudience) == 2) {
          // If the array has only two values, delimit them with an ampersand
          $eventAudience = implode(' & ', $arrEventAudience);
        } else {
           $eventAudience = implode(', ', array_slice($arrEventAudience, 0, -1)) . ' & ' . end($arrEventAudience);
        }

          if((!(substr(strtolower($eventUrl),0,7) == 'http://')) && (!(substr(strtolower($eventUrl),0,8) == 'https://'))){
            $eventUrl = 'http://' . $eventUrl;
          }
        print "
          <h2><b>$eventName</b><br>" . $eventDateStart . " at ".$eventTimeStart. " to " .$eventDateEnd . " at " . $eventTimeEnd ."</h2>
          <img src='Uploads/".$sysFilename."' onerror='this.onerror=null; src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png\"'>
          <p><b>Open To:</b> " . $eventAudience . "</p>
          <p><b>Location: </b> $eventLocation</p>
          <p>$eventDescription</p>
          <a href='Uploads/".$sysFilename."' download>Download Flyer</a>
           |
          <a href='" .$eventUrl. "' target='_blank'>Visit Site</a>
          <br><br>
          <hr style='color:black'>";
        } while ($row = mysqli_fetch_array($sql));
          //print "</table>\n";
          print "</ul>";
        } else {
            print "No opportunities are currently posted. Please check again later.";
        }
        ?>
  </div>

  <div id="Freshmen" class="w3-container w3-border Tab">
    <h2 style="color:gray"><p style="text-align:center">Opportunities For Freshmen</p></h2>
        <?php
        $sql = mysqli_query($conn,
        "SELECT * FROM Users WHERE username='"
        . $_POST["username"] . "' AND
        password='" . $_POST["pwd"] . "' ");
            ?>
            <!--<p style="color:black">Ambitious and ggg creative business student at Purdue University with ample experience in a variety of leadership positions. Recognized for excellent organization, leadership, and efficiency. Admirable teamwork, leadership, and communication skills.</p>
        -->
        <?php
        $sql = mysqli_query($conn,
        "SELECT eventName, DATE_FORMAT(eventDateTimeStart,'%M %D, %Y') as eventDateStart, DATE_FORMAT(eventDateTimeStart, '%h:%i %p') as eventTimeStart, DATE_FORMAT(eventDateTimeEnd,'%M %D, %Y') as eventDateEnd, DATE_FORMAT(eventDateTimeEnd, '%h:%i %p') as eventTimeEnd, sysFilename, eventDescription, eventAudience, eventLocation, eventUrl
          FROM (select * from `Files`WHERE
                (eventAudience LIKE'%Freshmen%' OR eventAudience LIKE'%All Members%')
                ORDER BY eventDateTimeStart ASC) as s1
          WHERE eventDateTimeStart >= CURDATE()");

        if ($row = mysqli_fetch_array($sql)) {
          print "<ul style:'list-style-type:square;'>";
        do {
          $eventDateStart = $row['eventDateStart'];
          $eventTimeStart = $row["eventTimeStart"];
          $eventDateEnd = $row['eventDateEnd'];
          $eventTimeEnd = $row["eventTimeEnd"];
          $eventName = $row['eventName'];
          $sysFilename = $row['sysFilename'];
          $eventDescription = $row['eventDescription'];
          $eventLocation = $row['eventLocation'];
          $eventUrl = $row['eventUrl'];


          $arrEventAudience = explode(',', $row['eventAudience']);
          if (count($arrEventAudience) == 1) {
          // If the array has only one value, output it without any delimiter
          $eventAudience = $arrEventAudience[0];
        } elseif (count($arrEventAudience) == 2) {
          // If the array has only two values, delimit them with an ampersand
          $eventAudience = implode(' & ', $arrEventAudience);
        } else {
           $eventAudience = implode(', ', array_slice($arrEventAudience, 0, -1)) . ' & ' . end($arrEventAudience);
        }

          if((!(substr(strtolower($eventUrl),0,7) == 'http://')) && (!(substr(strtolower($eventUrl),0,8) == 'https://'))){
            $eventUrl = 'http://' . $eventUrl;
          }
        print "
          <h2><b>$eventName</b><br>" . $eventDateStart . " at ".$eventTimeStart. " to " .$eventDateEnd . " at " . $eventTimeEnd ."</h2>
          <img src='Uploads/".$sysFilename."' onerror='this.onerror=null; src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png\"'>
          <p><b>Open To:</b> " . $eventAudience . "</p>
          <p><b>Location: </b> $eventLocation</p>
          <p>$eventDescription</p>
          <a href='Uploads/".$sysFilename."' download>Download Flyer</a>
           |
          <a href='" .$eventUrl. "' target='_blank'>Visit Site</a>
          <br><br>
          <hr style='color:black'>";
        } while ($row = mysqli_fetch_array($sql));
          //print "</table>\n";
          print "</ul>";
        } else {
            print "No opportunities are currently posted. Please check again later.";
        }
        ?>
  </div>

  <div id="Sophomores" class="w3-container w3-border Tab">
    <h2 style="color:gray"><p style="text-align:center">Opportunities For Sophomores</p></h2>
        <?php
        $sql = mysqli_query($conn,
        "SELECT * FROM Users WHERE username='"
        . $_POST["username"] . "' AND
        password='" . $_POST["pwd"] . "' ");
            ?>
            <!--<p style="color:black">Ambitious and ggg creative business student at Purdue University with ample experience in a variety of leadership positions. Recognized for excellent organization, leadership, and efficiency. Admirable teamwork, leadership, and communication skills.</p>
        -->
        <?php
        $sql = mysqli_query($conn,
        "SELECT eventName, DATE_FORMAT(eventDateTimeStart,'%M %D, %Y') as eventDateStart, DATE_FORMAT(eventDateTimeStart, '%h:%i %p') as eventTimeStart, DATE_FORMAT(eventDateTimeEnd,'%M %D, %Y') as eventDateEnd, DATE_FORMAT(eventDateTimeEnd, '%h:%i %p') as eventTimeEnd, sysFilename, eventDescription, eventAudience, eventLocation, eventUrl
          FROM (select * from `Files`WHERE
                (eventAudience LIKE'%Sophomores%' OR eventAudience LIKE'%All Members%')
                ORDER BY eventDateTimeStart ASC) as s1
          WHERE eventDateTimeStart >= CURDATE()");

        if ($row = mysqli_fetch_array($sql)) {
          print "<ul style:'list-style-type:square;'>";
        do {
          $eventDateStart = $row['eventDateStart'];
          $eventTimeStart = $row["eventTimeStart"];
          $eventDateEnd = $row['eventDateEnd'];
          $eventTimeEnd = $row["eventTimeEnd"];
          $eventName = $row['eventName'];
          $sysFilename = $row['sysFilename'];
          $eventDescription = $row['eventDescription'];
          $eventLocation = $row['eventLocation'];
          $eventUrl = $row['eventUrl'];


          $arrEventAudience = explode(',', $row['eventAudience']);
          if (count($arrEventAudience) == 1) {
          // If the array has only one value, output it without any delimiter
          $eventAudience = $arrEventAudience[0];
        } elseif (count($arrEventAudience) == 2) {
          // If the array has only two values, delimit them with an ampersand
          $eventAudience = implode(' & ', $arrEventAudience);
        } else {
           $eventAudience = implode(', ', array_slice($arrEventAudience, 0, -1)) . ' & ' . end($arrEventAudience);
        }

          if((!(substr(strtolower($eventUrl),0,7) == 'http://')) && (!(substr(strtolower($eventUrl),0,8) == 'https://'))){
            $eventUrl = 'http://' . $eventUrl;
          }
        print "
          <h2><b>$eventName</b><br>" . $eventDateStart . " at ".$eventTimeStart. " to " .$eventDateEnd . " at " . $eventTimeEnd ."</h2>
          <img src='Uploads/".$sysFilename."' onerror='this.onerror=null; src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png\"'>
          <p><b>Open To:</b> " . $eventAudience . "</p>
          <p><b>Location: </b> $eventLocation</p>
          <p>$eventDescription</p>
          <a href='Uploads/".$sysFilename."' download>Download Flyer</a>
           |
          <a href='" .$eventUrl. "' target='_blank'>Visit Site</a>
          <br><br>
          <hr style='color:black'>";
        } while ($row = mysqli_fetch_array($sql));
          //print "</table>\n";
          print "</ul>";
        } else {
            print "No opportunities are currently posted. Please check again later.";
        }
        ?>
  </div>

  <div id="Juniors" class="w3-container w3-border Tab">
    <h2 style="color:gray"><p style="text-align:center">Opportunities For Juniors</p></h2>
        <?php
        $sql = mysqli_query($conn,
        "SELECT * FROM Users WHERE username='"
        . $_POST["username"] . "' AND
        password='" . $_POST["pwd"] . "' ");
            ?>
            <!--<p style="color:black">Ambitious and ggg creative business student at Purdue University with ample experience in a variety of leadership positions. Recognized for excellent organization, leadership, and efficiency. Admirable teamwork, leadership, and communication skills.</p>
        -->
        <?php
        $sql = mysqli_query($conn,
        "SELECT eventName, DATE_FORMAT(eventDateTimeStart,'%M %D, %Y') as eventDateStart, DATE_FORMAT(eventDateTimeStart, '%h:%i %p') as eventTimeStart, DATE_FORMAT(eventDateTimeEnd,'%M %D, %Y') as eventDateEnd, DATE_FORMAT(eventDateTimeEnd, '%h:%i %p') as eventTimeEnd, sysFilename, eventDescription, eventAudience, eventLocation, eventUrl
          FROM (select * from `Files`WHERE
                (eventAudience LIKE'%Juniors%' OR eventAudience LIKE'%All Members%')
                ORDER BY eventDateTimeStart ASC) as s1
          WHERE eventDateTimeStart >= CURDATE()");

        if ($row = mysqli_fetch_array($sql)) {
          print "<ul style:'list-style-type:square;'>";
        do {
          $eventDateStart = $row['eventDateStart'];
          $eventTimeStart = $row["eventTimeStart"];
          $eventDateEnd = $row['eventDateEnd'];
          $eventTimeEnd = $row["eventTimeEnd"];
          $eventName = $row['eventName'];
          $sysFilename = $row['sysFilename'];
          $eventDescription = $row['eventDescription'];
          $eventLocation = $row['eventLocation'];
          $eventUrl = $row['eventUrl'];


          $arrEventAudience = explode(',', $row['eventAudience']);
          if (count($arrEventAudience) == 1) {
          // If the array has only one value, output it without any delimiter
          $eventAudience = $arrEventAudience[0];
        } elseif (count($arrEventAudience) == 2) {
          // If the array has only two values, delimit them with an ampersand
          $eventAudience = implode(' & ', $arrEventAudience);
        } else {
           $eventAudience = implode(', ', array_slice($arrEventAudience, 0, -1)) . ' & ' . end($arrEventAudience);
        }

          if((!(substr(strtolower($eventUrl),0,7) == 'http://')) && (!(substr(strtolower($eventUrl),0,8) == 'https://'))){
            $eventUrl = 'http://' . $eventUrl;
          }
        print "
          <h2><b>$eventName</b><br>" . $eventDateStart . " at ".$eventTimeStart. " to " .$eventDateEnd . " at " . $eventTimeEnd ."</h2>
          <img src='Uploads/".$sysFilename."' onerror='this.onerror=null; src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png\"'>
          <p><b>Open To:</b> " . $eventAudience . "</p>
          <p><b>Location: </b> $eventLocation</p>
          <p>$eventDescription</p>
          <a href='Uploads/".$sysFilename."' download>Download Flyer</a>
           |
          <a href='" .$eventUrl. "' target='_blank'>Visit Site</a>
          <br><br>
          <hr style='color:black'>";
        } while ($row = mysqli_fetch_array($sql));
          //print "</table>\n";
          print "</ul>";
        } else {
            print "No opportunities are currently posted. Please check again later.";
        }
        ?>
  </div>

  <div id="Seniors" class="w3-container w3-border Tab">
    <h2 style="color:gray"><p style="text-align:center">Opportunities For Seniors</p></h2>
        <?php
        $sql = mysqli_query($conn,
        "SELECT * FROM Users WHERE username='"
        . $_POST["username"] . "' AND
        password='" . $_POST["pwd"] . "' ");
            ?>
            <!--<p style="color:black">Ambitious and ggg creative business student at Purdue University with ample experience in a variety of leadership positions. Recognized for excellent organization, leadership, and efficiency. Admirable teamwork, leadership, and communication skills.</p>
        -->
        <?php
        $sql = mysqli_query($conn,
        "SELECT eventName, DATE_FORMAT(eventDateTimeStart,'%M %D, %Y') as eventDateStart, DATE_FORMAT(eventDateTimeStart, '%h:%i %p') as eventTimeStart, DATE_FORMAT(eventDateTimeEnd,'%M %D, %Y') as eventDateEnd, DATE_FORMAT(eventDateTimeEnd, '%h:%i %p') as eventTimeEnd, sysFilename, eventDescription, eventAudience, eventLocation, eventUrl
          FROM (select * from `Files`WHERE
                (eventAudience LIKE'%Seniors%' OR eventAudience LIKE'%All Members%')
                ORDER BY eventDateTimeStart ASC) as s1
          WHERE eventDateTimeStart >= CURDATE()");

        if ($row = mysqli_fetch_array($sql)) {
          print "<ul style:'list-style-type:square;'>";
        do {
          $eventDateStart = $row['eventDateStart'];
          $eventTimeStart = $row["eventTimeStart"];
          $eventDateEnd = $row['eventDateEnd'];
          $eventTimeEnd = $row["eventTimeEnd"];
          $eventName = $row['eventName'];
          $sysFilename = $row['sysFilename'];
          $eventDescription = $row['eventDescription'];
          $eventLocation = $row['eventLocation'];
          $eventUrl = $row['eventUrl'];


          $arrEventAudience = explode(',', $row['eventAudience']);
          if (count($arrEventAudience) == 1) {
          // If the array has only one value, output it without any delimiter
          $eventAudience = $arrEventAudience[0];
        } elseif (count($arrEventAudience) == 2) {
          // If the array has only two values, delimit them with an ampersand
          $eventAudience = implode(' & ', $arrEventAudience);
        } else {
           $eventAudience = implode(', ', array_slice($arrEventAudience, 0, -1)) . ' & ' . end($arrEventAudience);
        }

          if((!(substr(strtolower($eventUrl),0,7) == 'http://')) && (!(substr(strtolower($eventUrl),0,8) == 'https://'))){
            $eventUrl = 'http://' . $eventUrl;
          }
        print "
          <h2><b>$eventName</b><br>" . $eventDateStart . " at ".$eventTimeStart. " to " .$eventDateEnd . " at " . $eventTimeEnd ."</h2>
          <img src='Uploads/".$sysFilename."' onerror='this.onerror=null; src=\"https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png\"'>
          <p><b>Open To:</b> " . $eventAudience . "</p>
          <p><b>Location: </b> $eventLocation</p>
          <p>$eventDescription</p>
          <a href='Uploads/".$sysFilename."' download>Download Flyer</a>
           |
          <a href='" .$eventUrl. "' target='_blank'>Visit Site</a>
          <br><br>
          <hr style='color:black'>";
        } while ($row = mysqli_fetch_array($sql));
          //print "</table>\n";
          print "</ul>";
        } else {
            print "No opportunities are currently posted. Please check again later.";
        }
        ?>
  </div>


</body>
</html>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!--<script language="Javascript">
//document.write("This page was last modified on: " + document.lastModified +"");
</SCRIPT>-->
<script language="Javascript">
function openTab(evt, TabName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("Tab");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-black", "");
  }
  document.getElementById(TabName).style.display = "block";
  evt.currentTarget.className += " w3-black";
}
    document.getElementById("defaultOpen").click();
</script>
