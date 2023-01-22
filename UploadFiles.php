<!DOCTYPE html>
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
    max-width: 20%;
    padding: 10px
    border: 10px solid #000000;
  }
  #name
  {
    color: #00d4ff
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
<body>

<form action="uploadFile.php" method="post" enctype="multipart/form-data">
  <br>
  Event Name:
  <input type="text" name="eventName" id="eventName">
  <br>
  <fieldset>
  Event Start Date & Time: <input type="datetime-local" id="eventDateTimeStart" name="eventDateTimeStart">
  <br>
  Event End Date & Time: <input type="datetime-local" id="eventDateTimeEnd" name="eventDateTimeEnd">
</fieldset>
  <br>
  Event Location:
  <input type="text" id="eventLocation" name="eventLocation">
  <br>
  Event Description:
  <textarea name="eventDescription" id="eventDescription" style="width:500px;height:150px;"></textarea>
  <br>
  URL:
  <input type="text" id="eventUrl" name="eventUrl">
  <br>
  Attach Flyer:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <br>
  <fieldset>
  Open To:
  <br>
  <input type="checkbox" name="eventAudience[]" value="Freshmen" id="eventAudience">Freshmen<br>
  <input type="checkbox" name="eventAudience[]" value="Sophomores" id="eventAudience">Sophomores<br>
  <input type="checkbox" name="eventAudience[]" value="Juniors" id="eventAudience">Juniors<br>
  <input type="checkbox" name="eventAudience[]" value="Seniors" id="eventAudience">Seniors<br>
  <input type="checkbox" name="eventAudience[]" value="All Members" id="eventAudience">All Members<br>
  <br>
  <input type="checkbox" name="createCalendarInvite" value="Create Calendar Invite">Create Calendar Invite<br><br>
  <input type="submit" value="Upload Event" name="submit">
  </fieldset>
</form>
<br>
<a href="javascript:window.close();">Back to Main Page</a>
</body>
</html>
