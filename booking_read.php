<?php include 'validate_login.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/malaysia.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="js/script.js">
    <script src="https://kit.fontawesome.com/d6ceb9e7bd.js" crossorigin="anonymous"></script>
    <link rel="icon" href="img/logo.webp" type="image/icon type">
    <title>Read Booking</title>
</head>

<body>
    <div class="container-fluid">
        <div class="bg-black">
            <div class="container">
                <div class=" row justify-content-between align-items-center">
                    <div class="col-3">
                        <img src="img/logo.webp" width="100px" alt="">
                    </div>
                    <div class="col-9 text-end">
                        <a class="btn btn-light px-2 px-sm-3 p-2" href="?logout=true">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h2 class="my-3 my-sm-5"><span class="border-5 border-bottom border-danger">Read Booking</span></h2>
            <?php
            include "config/database.php";
            $action = isset($_GET['action']) ? $_GET['action'] : "";

            // if it was redirected from delete.php
            if ($action == 'deleted') {
                echo "<div class='alert alert-success'>Booking was deleted.</div>";
            }

            $query = "SELECT id, trip_type, mpv_type, contact_number, pick_up_date FROM online_booking ORDER BY id ASC";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();

            if ($num > 0) {
                echo "<table class='table table-hover table-responsive table-bordered'>"; //start table

                //creating our table heading
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Trip Type</th>";
                echo "<th>MPV Type</th>";
                echo "<th>Contact Number</th>";
                echo "<th>Pick Up Date</th>";
                echo "<th>Action</th>";
                echo "</tr>";

                // table body will be here
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // extract row
                    // this will make $row['firstname'] to just $firstname only
                    extract($row);
                    // creating new table row per record
                    echo "<tr class='border-1 border-black'>";
                    echo "<td>{$id}</td>";
                    echo "<td>{$trip_type}</td>";
                    echo "<td>{$mpv_type}</td>";
                    echo "<td>{$contact_number}</td>";
                    echo "<td>{$pick_up_date}</td>";

                    echo "<td class='text-center'>";
                    echo "<a href='booking_read_one.php?id={$id}' class='btn btn-success m-r-1em mx-1'>Read</a>";

                    // we will use this links on next part of this post
                    echo "<a href='#' onclick='delete_booking({$id});'  class='btn btn-danger mx-1'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }


                // end table
                echo "</table>";

                // data from database will be here

            } else {
                echo "<div class='alert alert-danger'>No records found.</div>";
            }

            ?>

        </div>
    </div>
    <script src="js/script.js"></script>
    <script type='text/javascript'>
        // confirm record deletion
        function delete_booking(id) {

            if (confirm('Are you sure?')) {
                // if user clicked ok,
                // pass the id to delete.php and execute the delete query
                window.location = 'booking_delete.php?id=' + id;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>