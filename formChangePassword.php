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

<form method="post" action="changePassword.php" name="frmChangePassword">

  <fieldset>
    <legend align="center">
      <h1>Change Password</h1>
    </legend>
    <table align="center" border="1"
      width="40%" style="border:thick;">
      <tr>
        <th height="40"><label for="username">
            Username</label>
        </th>
        <td><input type="text"
          name="username"
          id="username" required>
        </td>
      </tr>

      <tr>
        <th height="40">
          <label for="oldPassword">Current Password</label>
        </th>
        <td><input type="password"
          name="oldPassword" id="oldPassword" required>
        </td>
      </tr>
      <tr>
        <th height="40">
          <label for="newPassword">New Password</label>
        </th>
        <td><input type="password"
          name="newPassword" id="newPassword" required>
        </td>
      </tr>
      <tr>
        <th height="40">
          <label for="confirmPassword">Confirm Password</label>
        </th>
        <td><input type="password"
          name="confirmPassword" id="confirmPassword" required>
        </td>
      </tr>

      <tr>
        <td height="40" colspan="2"><input
          type="submit" name="submit"
          value="Change Password">
        </td>
      </tr>
    </table>
    <a href="javascript:window.close();">Back to Main Page</a>
  </fieldset>
</form>
</html>
