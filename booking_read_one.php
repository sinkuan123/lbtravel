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
    <link rel="icon" href="img/logo.png" type="image/icon type">
    <title>Read One Booking</title>
</head>

<body>
    <div class="container-fluid">
        <?php include "menu.html"; ?>
        <div class="container">
            <h2 class="my-3 my-sm-5"><span class="border-5 border-bottom border-danger">Read Booking</span></h2>
            <?php

            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

            include "config/database.php";
            try {
                $query = "SELECT * FROM online_booking WHERE id=:id";
                $stmt = $con->prepare($query);
                $stmt->bindParam(":id", $id);

                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // values to fill up our form
                $trip_type = $row['trip_type'];
                $mpv_type = $row['mpv_type'];
                $name = $row['name'];
                $contact_number = $row['contact_number'];
                $email = $row['email'];
                $contact_app = $row['contact_app'];
                $nationality = $row['nationality'];
                $pick_up_date = $row['pick_up_date'];
                $pick_up_time = $row['pick_up_time'];
                $flight = $row['flight'];
                $pick_up_address = $row['pick_up_address'];
                $drop_off_address = $row['drop_off_address'];
                $return_date = $row['return_date'];
                $return_time = $row['return_time'];
                $return_flight = $row['return_flight'];
                $return_pick_up_address = $row['return_pick_up_address'];
                $return_drop_off_address = $row['return_drop_off_address'];
                $adult = $row['adult'];
                $children = $row['children'];
                $luggage = $row['luggage'];
                $enquiry = $row['enquiry'];
                $booking_date = $row['booking_date'];
                // shorter way to do that is extract($row)
            }

            // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
            ?>
            <table class='table table-hover table-responsive table-bordered'>
                <tr class="border-top-1 border-black">
                    <td class="col-3">id</td>
                    <td><?php echo htmlspecialchars($id, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Trip Type</td>
                    <td><?php echo htmlspecialchars($trip_type, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>MPV Type</td>
                    <td><?php echo htmlspecialchars($mpv_type, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><?php echo htmlspecialchars($contact_number, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo htmlspecialchars($email, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Contact App</td>
                    <td><?php echo htmlspecialchars($contact_app, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Nationality</td>
                    <td><?php echo htmlspecialchars($nationality, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Pick Up Date</td>
                    <td><?php echo htmlspecialchars($pick_up_date, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Pick Up Time</td>
                    <td><?php echo htmlspecialchars($pick_up_time, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Flight</td>
                    <td><?php echo htmlspecialchars($flight, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Pick Up Address</td>
                    <td><?php echo htmlspecialchars($pick_up_address, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Drop Off Address</td>
                    <td><?php echo htmlspecialchars($drop_off_address, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Return Date</td>
                    <td><?php echo htmlspecialchars($return_date, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Return Time</td>
                    <td><?php echo htmlspecialchars($return_time, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Return Flight</td>
                    <td><?php echo htmlspecialchars($return_flight, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Return Pick Up Address</td>
                    <td><?php echo htmlspecialchars($return_pick_up_address, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Return Drop Off Address</td>
                    <td><?php echo htmlspecialchars($return_drop_off_address, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Adult</td>
                    <td><?php echo htmlspecialchars($adult, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Children</td>
                    <td><?php echo htmlspecialchars($children, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Luggage</td>
                    <td><?php echo htmlspecialchars($luggage, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Enquiry</td>
                    <td><?php echo htmlspecialchars($enquiry, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <a href='booking_read.php' class='btn btn-danger'>Back to read bookings</a>
                        <button onclick="copyToClipboard()">Copy Text</button>

                    </td>
                </tr>
            </table>

        </div>
        <?php include 'footer.html' ?>
    </div>
    <script src="js/script.js"></script>
    <script>
        function copyToClipboard() {
            var text = "";
            var elements = document.querySelectorAll('#textToCopy');

            elements.forEach(function(element) {
                text += element.innerText.trim().replace(/^\s*/gm, '') + '\n';
            });

            var tempTextArea = document.createElement('textarea');
            tempTextArea.value = text;

            document.body.appendChild(tempTextArea);
            tempTextArea.select();
            document.execCommand('copy');
            document.body.removeChild(tempTextArea);

            alert('Text has been copied to clipboard');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <div id="textToCopy" class="d-none">
        Trip Type: <?php echo $trip_type; ?> <br>
        MPV Type: <?php echo $mpv_type; ?> <br>
        Name: <?php echo $name; ?> <br>
        Contact Number: <?php echo $contact_number; ?> <br>
        Email: <?php echo $email; ?> <br>
        Contact App: <?php echo $contact_app; ?> <br>
        Nationality: <?php echo $nationality; ?> <br>
        Pick Up Detail <br>
        Pick Up Date: <?php echo $pick_up_date; ?> <br>
        Pick Up Time: <?php echo $pick_up_time; ?> <br>
        Pick Up Address: <?php echo $pick_up_address; ?> <br>
        Drop Off Address: <?php echo $drop_off_address; ?> <br>
        <?php if ($trip_type == "Two Way Transfer") { ?>
            Return Detail <br>
            Return Pick Up Date: <?php echo $return_date; ?> <br>
            Return Pick Up Time: <?php echo $return_time; ?> <br>
            Return Pick Up Address: <?php echo $return_pick_up_address; ?> <br>
            Return Drop Off Address: <?php echo $return_drop_off_address; ?> <br>
        <?php } ?>
        Passenger & Luggage
        Adult: <?php echo $adult; ?> <br>
        Children: <?php echo $children; ?> <br>
        Luggage: <?php echo $luggage; ?> <br>
        Unique ID: #<?php echo $id; ?> <br>

        Booking System Date: <?php echo $booking_date; ?> <br>
    </div>
</body>

</html>