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
    <div id="wrap">
        <div class="container">
            <div class="row">
                <form class="form-horizontal" action="sqlUploadUsers.php" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>
                        <!-- Form Name -->
                        <legend>Import Users</legend>
                        <!-- Download Template -->
                        <div class="form-group">
                          <a href="BackendSiteFiles/UserImportTemplate.csv">Download Template Here</a>
                        </div>
                        <!-- File Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="file" class="input-large">
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                            <div class="col-md-4">
                                <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <a href="javascript:window.close();">Back to Main Page</a>
                </form>
            </div>
            <?php
               get_all_records();
            ?>
        </div>
    </div>
</body>
</html>
