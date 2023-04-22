<!DOCTYPE html>
<html lang="en">
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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: rgb(241, 239, 233);
            font-family: "Helvetica";
            color: black;
        }
        h1, h2, h3, h4 {
            font-family: "Trebuchet MS";
        }
        #tableheader {
            background-color: Gold;
        }
        img {
            max-width: 20%;
            padding: 10px;
            border: 10px solid #000000;
        }
        #name {
            color: #00d4ff;
        }
        th, td {
            border-style: groove;
        }
        .table-wrapper {
            max-height: 400px;
            overflow-y: auto;
        }
        .event-col, .start-date-col, .end-date-col, .location-col {
            width: 15%;
        }
    </style>
    <script>
        function toggleEditing(rowId) {
            $(".row-" + rowId).toggleClass("d-none");
            $(".edit-row-" + rowId).toggleClass("d-none");
        }
    </script>
</head>
<body>
    <?php
        session_start();
        include("connect.php");
    ?>
    <div class="container mt-5">
    <h2 class="text-center mb-5">Event Management</h2>

    <div class="table-wrapper">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Action</th>
                    <th class="event-col">Event</th>
                    <th class="start-date-col">Start Date</th>
                    <th class="end-date-col">End Date</th>
                    <th>Audience</th>
                    <th class="location-col">Location</th>
                    <th>URL</th>
                    <th>Flyer</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = mysqli_query($conn, "SELECT eventID, eventName, eventDateTimeStart, eventDateTimeEnd, sysFilename, eventDescription, eventAudience, eventLocation, eventUrl FROM Files ORDER BY eventDateTimeStart DESC");
                    if ($row = mysqli_fetch_array($sql)) {
                        do {
                            $eventID = $row['eventID'];
                            $eventName = $row['eventName'];
                            $eventDateTimeStart = $row['eventDateTimeStart'];
                            $eventDateTimeEnd = $row['eventDateTimeEnd'];
                            $sysFilename = $row['sysFilename'];
                            $eventDescription = $row['eventDescription'];
                            $eventAudience = $row['eventAudience'];
                            $eventLocation = $row['eventLocation'];
                            $eventUrl = $row['eventUrl'];
                ?>
                <tr class="row-<?php echo $eventID; ?>">
                    <td>
                        <button type="button" onclick="toggleEditing('<?php echo $eventID; ?>')" class="btn btn-info btn-sm">Edit</button>
                    </td>
                    <td class="event-col"><?php echo $eventName; ?></td>
                    <td class="start-date-col"><?php echo $eventDateTimeStart; ?></td>
                    <td class="end-date-col"><?php echo $eventDateTimeEnd; ?></td>
                    <td><?php echo $eventAudience; ?></td>
                    <td class="location-col"><?php echo $eventLocation; ?></td>
                    <td><?php echo $eventUrl; ?></td>
                    <td><?php echo $sysFilename; ?></td>
                    <td><?php echo 'Click Edit to Update Description'; ?></td>
                </tr>
                <tr class="edit-row-<?php echo $eventID; ?> d-none">
                <form action='sqlEditEvents.php' method='post' enctype='multipart/form-data' onSubmit="if(!confirm('Are you sure you want to delete/edit <?php echo $eventName; ?>?')){return false;}">
                    <td>
                        <input type='hidden' name='eventID' value='<?php echo $eventID; ?>'>
                        <button type='submit' name='deleteEvent' class='btn btn-danger btn-sm mb-2'>Delete</button>
                        <button type='submit' name='updateEvent' class='btn btn-primary btn-sm'>Update</button>
                    </td>
                    <td><textarea name="eventName" class="form-control" rows="3"><?php echo $eventName; ?></textarea></td>
                    <td><input type="datetime-local" name="eventDateTimeStart" class="form-control" value="<?php echo $eventDateTimeStart; ?>"></td>
                    <td><input type="datetime-local" name="eventDateTimeEnd" class="form-control" value="<?php echo $eventDateTimeEnd; ?>"></td>
                    <td><textarea name="eventAudience" class="form-control" rows="3"><?php echo $eventAudience; ?></textarea></td>
                    <td><textarea name="eventLocation" class="form-control" rows="3"><?php echo $eventLocation; ?></textarea></td>
                    <td><textarea name="eventUrl" class="form-control" rows="3"><?php echo $eventUrl; ?></textarea></td>
                    <td><textarea name="sysFilename" class="form-control" rows="3"><?php echo $sysFilename; ?></textarea></td>
                    <!--<td>-->
                        <!--<input type="hidden" name="eventDescription" value="php<?//php echo $eventDescription; ?>">-->
                    <td><textarea name="eventDescription" class="form-control" rows="3"><?php echo $eventDescription; ?></textarea>
                    </td>
                    <!--</td>-->
                </form>
            </tr>

                <?php
                        } while ($row = mysqli_fetch_array($sql));
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>There are no events available for deletion. Please create an event before attempting to delete it.</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div class="text-center mt-3">
        <a href="javascript:window.close();" class="btn btn-secondary">Back to Main Page</a>
    </div>
</div>
</body>
</html>

