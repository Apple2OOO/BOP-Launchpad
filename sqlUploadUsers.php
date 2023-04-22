<?php
 session_start();
    if (!isset($_SESSION['loggedin']))
        {
                 header('Location: login.php');
            }
        else
            {
              if(!isset($_SESSION['siteAdmin']))
                  {
                    header('location:https://web.ics.purdue.edu/~somm/accessDenied.php');
                    //session_destroy();
                  }
                 if (isset($_POST['read']))
                     {
                         header('location:https://www.google.com/');
                         session_destroy();
                     }
            }
?>
<?php
session_start();
include("connect.php");
 if(isset($_POST["Import"])){

    $filename=$_FILES["file"]["tmp_name"];
     if($_FILES["file"]["size"] > 0)
     {
        $file = fopen($filename, "r");
            $skipfirstrow = true;
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
           { if($skipfirstrow){$skipfirstrow=false;continue;}
             $sql = "INSERT into Users (username,password,firstname,lastname,bopClass)
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."')";
                   $result = mysqli_query($conn, $sql);
        if(!isset($result))
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
     }
  }
 ?>
