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
    max-width: 100%;
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


<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>
<body>
  <h3>
    <a href="https://web.ics.purdue.edu/~appletoj/BDPA/uploadUsers.php" target="_blank">Bulk Add Users</a>
    <br>
    <br>
    <a href="https://web.ics.purdue.edu/~appletoj/BDPA/UploadFiles.php" target="_blank">Upload Event</a>
    <br>
    <br>
    <a href="https://web.ics.purdue.edu/~appletoj/BDPA/frmEditEvents.php" target="_blank">Modify and Delete Events</a>
  </h3>
<br><br><br>
  <a href="javascript:window.close();">Back to Main Page</a>
</body>
</html>
