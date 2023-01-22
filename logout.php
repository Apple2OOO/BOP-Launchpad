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
$_SESSION['loggedin'] = NULL;
 ?>
<html>
<h1>Logout Successful</h1>
<br>
<br>
<br>
    <a href="https://web.ics.purdue.edu/~appletoj/BDPA/login.php">Back to Login</a>

</html>
