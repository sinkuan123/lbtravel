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
    <title>Online Booking</title>
    <style>
        @media screen and (max-width: 515px) {

            .form-select,
            .form-control {
                font-size: 10px !important;
            }
        }

        @media screen and (max-width: 380px) {

            .form-select,
            .form-control {
                font-size: 8px !important;
            }

        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <?php include "menu.html"; ?>
        <div class="container">
            <h2 class="my-3 my-sm-5"><span class="border-5 border-bottom border-danger">Online Booking</span></h2>
            <?php

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // include database connection
                include 'config/database.php';
                date_default_timezone_set('Asia/Kuala_Lumpur');
                $trip_type = $_POST['trip_type'];
                $mpv_type = $_POST['mpv_type'];
                $name = $_POST['name'];
                $contact_number = $_POST['contact_number'];
                $email = $_POST['email'];
                $contact_app = $_POST['contact_app'];
                $nationality = $_POST['nationality'];
                $pick_up_date = $_POST['pick_up_date'];
                $pick_up_time = $_POST['pick_up_time'];
                $flight = $_POST['flight'];
                $pick_up_address = $_POST['pick_up_address'];
                $drop_off_address = $_POST['drop_off_address'];
                $return_date = $_POST['return_date'];
                $return_time = $_POST['return_time'];
                $return_flight = $_POST['return_flight'];
                $return_pick_up_address = $_POST['return_pick_up_address'];
                $return_drop_off_address = $_POST['return_drop_off_address'];
                $adult = $_POST['adult'];
                $children = $_POST['children'];
                $luggage = $_POST['luggage'];
                $enquiry = $_POST['enquiry'];
                $booking_date = date('Y-m-d H:i:s');
                try {
                    // insert query
                    $query = "INSERT INTO online_booking SET trip_type=:trip_type, mpv_type=:mpv_type, name=:name,
                 contact_number=:contact_number,email=:email, contact_app=:contact_app, nationality=:nationality, pick_up_date=:pick_up_date, 
                 pick_up_time=:pick_up_time, flight=:flight, pick_up_address=:pick_up_address, drop_off_address=:drop_off_address, adult=:adult,
                  children=:children, luggage=:luggage, enquiry=:enquiry, booking_date=:booking_date";
                    if ($trip_type == "Two Way Transfer") {
                        $query .= ", return_date=:return_date, return_time=:return_time, return_flight=:return_flight, return_pick_up_address=:return_pick_up_address, return_drop_off_address=:return_drop_off_address";
                    }

                    // prepare query for execution
                    $stmt = $con->prepare($query);

                    $errorMessage = array();

                    if (empty($trip_type)) {
                        $errorMessage[] = "Trip Type field is empty.";
                    }
                    if (empty($mpv_type)) {
                        $errorMessage[] = "MPV Type field is empty.";
                    }
                    if (empty($name)) {
                        $errorMessage[] = "Name field is empty.";
                    }
                    if (empty($contact_number)) {
                        $errorMessage[] = "Contact Number field is empty.";
                    }
                    if (empty($email)) {
                        $errorMessage[] = "Email field is empty.";
                    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errorMessage[] = "Please follow the Email format.";
                    }
                    if (empty($pick_up_date)) {
                        $errorMessage[] = "Pick Up Date field is empty.";
                    }
                    if (empty($adult)) {
                        $errorMessage[] = "Adult field is empty.";
                    } else if (!is_numeric($adult)) {
                        $errorMessage[] = "Only Numbers allowed in Adult field.";
                    }


                    if (!empty($errorMessage)) {
                        echo "<div class='alert alert-danger m-3'>";
                        foreach ($errorMessage as $displayErrorMessage) {
                            echo $displayErrorMessage . "<br>";
                        }
                        echo "</div>";
                    } else {
                        // Bind the parameters
                        $stmt->bindParam(':trip_type', $trip_type);
                        $stmt->bindParam(':mpv_type', $mpv_type);
                        $stmt->bindParam(':name', $name);
                        $stmt->bindParam(':contact_number', $contact_number);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':contact_app', $contact_app);
                        $stmt->bindParam(':nationality', $nationality);
                        $stmt->bindParam(':pick_up_date', $pick_up_date);
                        $stmt->bindParam(':pick_up_time', $pick_up_time);
                        $stmt->bindParam(':flight', $flight);
                        $stmt->bindParam(':pick_up_address', $pick_up_address);
                        $stmt->bindParam(':drop_off_address', $drop_off_address);
                        if ($trip_type == "Two Way Transfer") {
                            $stmt->bindParam(':return_date', $return_date);
                            $stmt->bindParam(':return_time', $return_time);
                            $stmt->bindParam(':return_flight', $return_flight);
                            $stmt->bindParam(':return_pick_up_address', $return_pick_up_address);
                            $stmt->bindParam(':return_drop_off_address', $return_drop_off_address);
                        }
                        $stmt->bindParam(':adult', $adult);
                        $stmt->bindParam(':children', $children);
                        $stmt->bindParam(':luggage', $luggage);
                        $stmt->bindParam(':enquiry', $enquiry);
                        $stmt->bindParam(":booking_date", $booking_date);

                        // Execute the query
                        if ($stmt->execute()) {
                            if ($trip_type !== "Two Way Transfer") {
                                $url = "https://wa.me/601128258565?text="
                                    . "Trip Type: " . urlencode($trip_type) . "%0a"
                                    . "MPV Type: " . urlencode($mpv_type) . "%0a"
                                    . "Name: " . urlencode($name) . "%0a"
                                    . "Contact Number: " . urlencode($contact_number) . "%0a"
                                    . "Email: " . urlencode($email) . "%0a"
                                    . "Contact App: " . urlencode($contact_app) . "%0a"
                                    . "Nationality: " . urlencode($nationality) . "%0a"
                                    . "Pick Up Date: " . urlencode($pick_up_date) . "%0a"
                                    . "Pick Up Time: " . urlencode($pick_up_time) . "%0a"
                                    . "Flight Detail: " . urlencode($flight) . "%0a"
                                    . "Pick Up Address: " . urlencode($pick_up_address) . "%0a"
                                    . "Drop Off Address: " . urlencode($drop_off_address) . "%0a"
                                    . "Adult: " . urlencode($adult) . "%0a"
                                    . "Children: " . urlencode($children) . "%0a"
                                    . "Luggage: " . urlencode($luggage) . "%0a"
                                    . "Special Enquiry: " . urlencode($enquiry);
                            } else {
                                $url = "https://wa.me/601128258565?text="
                                    . "Trip Type: " . urlencode($trip_type) . "%0a"
                                    . "MPV Type: " . urlencode($mpv_type) . "%0a"
                                    . "Name: " . urlencode($name) . "%0a"
                                    . "Contact Number: " . urlencode($contact_number) . "%0a"
                                    . "Email: " . urlencode($email) . "%0a"
                                    . "Contact App: " . urlencode($contact_app) . "%0a"
                                    . "Nationality: " . urlencode($nationality) . "%0a"
                                    . "Pick Up Date: " . urlencode($pick_up_date) . "%0a"
                                    . "Pick Up Time: " . urlencode($pick_up_time) . "%0a"
                                    . "Flight Detail: " . urlencode($flight) . "%0a"
                                    . "Pick Up Address: " . urlencode($pick_up_address) . "%0a"
                                    . "Drop Off Address: " . urlencode($drop_off_address) . "%0a"
                                    . "Return Date: " . urlencode($return_date) . "%0a"
                                    . "Return Time: " . urlencode($return_time) . "%0a"
                                    . "Return Flight Detail: " . urlencode($return_flight) . "%0a"
                                    . "Return Pick Up Address: " . urlencode($return_pick_up_address) . "%0a"
                                    . "Return Drop Off Address: " . urlencode($return_drop_off_address) . "%0a"
                                    . "Adult: " . urlencode($adult) . "%0a"
                                    . "Children: " . urlencode($children) . "%0a"
                                    . "Luggage: " . urlencode($luggage) . "%0a"
                                    . "Special Enquiry: " . urlencode($enquiry);
                            }

                            echo "<script>window.open('$url', '_blank');</script>";
                        } else {
                            echo "<div class='alert alert-danger m-3'>Unable to save the record.</div>";
                        }
                    }
                }
                // show error
                catch (PDOException $exception) {
                    die('ERROR: ' . $exception->getMessage());
                }
            }

            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            ?>
                <form id="bookingForm" method="post" action="">
                    <div id="errorMessages" class="error-messages"></div>
                    <div class="row mt-4">
                        <div class="col-sm my-sm-0 my-2">
                            <label for="trip_type">Trip Type <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="tripTypeError"></span>
                            <select class="fs-6 form-select form-select-lg" id="trip_type" name="trip_type" aria-label=".form-select-lg example" onchange="toggleFunction()">
                                <option value="" selected disabled hidden>Select Your Trip Type</option>
                                <option value="One Way Transfer">One Way Transfer</option>
                                <option value="Two Way Transfer" name="haha">Two Way Transfer</option>
                                <option value="Day Trip Services">Day trip Services</option>
                            </select>
                        </div>
                        <div class="col-sm my-sm-0 my-2">
                            <label for="mpv_type">MPV Type <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="mpvTypeError"></span>
                            <select class="form-select form-select-lg fs-6" id="mpv_type" name="mpv_type">
                                <option value="" class="opacity-50" selected disabled hidden>Select Your MPV Type</option>
                                <option value="Toyota Innova">Toyota Innova</option>
                                <option value="Toyota Alphard">Toyota Alphard</option>
                                <option value="Hyundai Starex">Hyundai Starex</option>
                            </select>
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-sm my-sm-0 my-2">
                            <label for="name">Name <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="nameError"></span>
                            <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
                        </div>

                        <div class="col">
                            <label for="contact_number">Contact Number <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="contactNumberError"></span>
                            <input type="text" name="contact_number" id="contact_number" class="form-control" value="<?php echo isset($_POST['contact_number']) ? $_POST['contact_number'] : ''; ?>">
                        </div>
                    </div>
                    <div class="col my-3">
                        <label for="email">Email <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="emailError"></span>
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                    </div>
                    <div class="row my-3">
                        <div class="col">
                            <label for="contact_app">Contact App Prefence <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="contactAppError"></span>
                            <select name="contact_app" id="contact_app" class="form-select form-select-lg fs-6">
                                <option value="" selected hidden disabled>Select an Option</option>
                                <option value="WhatsApp">WhatsApp</option>
                                <option value="Wechat">Wechat</option>
                                <option value="Facebook Messenger">Facebook Messenger</option>
                                <option value="Line">Line</option>
                                <option value="SMS">SMS</option>
                                <option value="Email">Email</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="nationality">Nationality <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="nationalityError"></span>
                            <input type="text" name="nationality" id="nationality" class="form-control" value="<?php echo isset($_POST['nationality']) ? $_POST['nationality'] : ''; ?>">
                        </div>
                    </div>
                    <legend class="my-3 text-primary">Pick Up Detail</legend>

                    <div class="row row-cols-2 row-cols-sm-3 my-3">
                        <div class="col-6 col-sm-4">
                            <label for="pick_up_date">Pick Up Date <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="pickUpDateError"></span>
                            <input type="date" name="pick_up_date" id="pick_up_date" class="form-control" value="<?php echo isset($_POST['pick_up_date']) ? $_POST['pick_up_date'] : ''; ?>">
                        </div>
                        <div class="col-6 col-sm-4">
                            <label for="pick_up_time">Pick Up Time <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="pickUpTimeError"></span>
                            <input type="time" name="pick_up_time" id="pick_up_time" class="form-control" value="<?php echo isset($_POST['pick_up_time']) ? $_POST['pick_up_time'] : ''; ?>">
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="flight">Flight Detail</label>
                            <input type="text" name="flight" id="flight" class="form-control" value="<?php echo isset($_POST['flight']) ? $_POST['flight'] : ''; ?>">
                        </div>
                    </div>
                    <div class="col my-3">
                        <label for="pick_up_address">Pick Up Address<span class="text-danger">*</span> </label><span class="text-danger float-end error" id="pickUpAddressError"></span>
                        <input type="text" name="pick_up_address" id="pick_up_address" class="form-control" value="<?php echo isset($_POST['pick_up_address']) ? $_POST['pick_up_address'] : ''; ?>">
                    </div>
                    <div class="col my-3">
                        <label for="drop_off_address">Drop Off Address <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="dropOffAddressError"></span>
                        <input type="text" name="drop_off_address" id="drop_off_address" class="form-control" value="<?php echo isset($_POST['drop_off_address']) ? $_POST['drop_off_address'] : ''; ?>">
                    </div>

                    <div style="display:none" id="return_detail">
                        <legend class="my-3 text-primary">Return Detail</legend>
                        <div class="row my-3">
                            <div class="col">
                                <label for="return_date">Return Date <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="returnDateError"></span>
                                <input type="date" class="form-control" name="return_date" id="return_date" value="<?php echo isset($_POST['return_date']) ? $_POST['return_date'] : ''; ?>">
                            </div>
                            <div class="col"><label for="return_time">Return Time <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="returnTimeError"></span>
                                <input type="time" class="form-control" name="return_time" id="return_time" value="<?php echo isset($_POST['return_time']) ? $_POST['return_time'] : ''; ?>">
                            </div>
                            <div class="col">
                                <label for="return_flight">Flight Detail </label>
                                <input type="text" class="form-control" name="return_flight" id="return_flight" value="<?php echo isset($_POST['return_flight']) ? $_POST['return_flight'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col my-3">
                            <label for="return_pick_up_address">Return Pick Up Address <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="returnPickUpAddressError"></span>
                            <input type="text" class="form-control" name="return_pick_up_address" id="return_pick_up_address" value="<?php echo isset($_POST['return_pick_up_address']) ? $_POST['return_pick_up_address'] : ''; ?>">
                        </div>
                        <div class="col my-3">
                            <label for="return_drop_off_address">Return Drop Off Address <span class="text-danger">*</span> </label><span class="text-danger float-end error" id="returnDropOffAddressError"></span>
                            <input type="text" class="form-control" name="return_drop_off_address" id="return_drop_off_address" value="<?php echo isset($_POST['return_drop_off_address']) ? $_POST['return_drop_off_address'] : ''; ?>">
                        </div>
                    </div>

                    <legend class="my-3 text-primary">Passenger and Luggage</legend>
                    <div class="row my-3">
                        <div class="col">
                            <label for="adult">Adult<span class="text-danger">*</span> </label><span class="text-danger float-end error" id="adultError"></span>
                            <input type="number" name="adult" id="adult" class="form-control" value="<?php echo isset($_POST['adult']) ? $_POST['adult'] : ''; ?>">
                        </div>
                        <div class="col">
                            <label for="children">Children<span class="text-danger">*</span> </label><span class="text-danger float-end error" id="childrenError"></span>
                            <input type="number" name="children" id="children" class="form-control" value="<?php echo isset($_POST['children']) ? $_POST['children'] : ''; ?>">
                        </div>
                        <div class="col">
                            <label for="luggage">Luggage</label>
                            <input type="number" name="luggage" id="luggage" class="form-control" value="<?php echo isset($_POST['luggage']) ? $_POST['luggage'] : ''; ?>">
                        </div>
                    </div>
                    <div class="col my-3">
                        <label for="enquiry">Special Enquiry</label>
                        <textarea name="enquiry" id="enquiry" cols="30" rows="2" class="form-control"><?php echo isset($_POST['enquiry']) ? $_POST['enquiry'] : ''; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary my-2" name="submitBtn">Submit</button>
                </form>
            <?php } else {
                echo "<div class='alert alert-success my-3'>Form was submitted.</div>";
            } ?>
        </div>
        <div class="container-fluid mt-3 py-5 bg-body-secondary">
            <div class="container">
                <h1 class="text-danger text-center my-1">For Fast Response</h1>
                <p class="text-center">Book Now For Your Trip With Us</p>
                <div class="row row-cols-2 row-cols-sm-4 my-sm-5 my-3">
                    <div class="col">
                        <h2 class="text-center">Call Us</h2>
                        <p class="text-center">+65 8913 4901 <br>(English, Mandarin, and Malay)</p>
                    </div>
                    <div class="col">
                        <h2 class="text-center">Whatsapp Us</h2>
                        <p class="text-center">+65 8913 4901</p>
                    </div>
                    <div class="col">
                        <h2 class="text-center">Wechat / Line ID</h2>
                        <p class="text-center">+65 8913 4901</p>
                    </div>
                    <div class="col">
                        <h2 class="text-center">Email Us</h2>
                        <p class="text-center text-break">Lbtraveltransport@gmail.com</p>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.html' ?>
    </div>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        function toggleFunction() {
            var x = document.getElementById("trip_type").value;
            if (x === "Two Way Transfer") {
                document.getElementById("return_detail").style.display = "block";
            } else {
                document.getElementById("return_detail").style.display = "none";
            }
        }

        function validateEmailFormat(email) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
        }

        // Function to display email validation error
        function displayEmailError() {
            const userEmail = document.getElementById('email').value;
            const emailError = document.getElementById('emailError');

            if (!validateEmailFormat(userEmail)) {
                emailError.textContent = 'Please enter a valid email address.';
            } else {
                emailError.textContent = '';
            }
        }

        // Event listener to trigger validation onBlur (when focus leaves the email field)
        document.getElementById('email').addEventListener('blur', function() {
            displayEmailError();
        });
        document.getElementById("bookingForm").addEventListener("submit", function(event) {
            event.preventDefault();

            var tripType = document.getElementById("trip_type").value;
            var mpvType = document.getElementById("mpv_type").value;
            var name = document.getElementById("name").value;
            var contactNumber = document.getElementById("contact_number").value;
            var email = document.getElementById("email").value;
            var contactApp = document.getElementById("contact_app").value;
            var nationality = document.getElementById("nationality").value;
            var pickUpDate = document.getElementById("pick_up_date").value;
            var pickUpTime = document.getElementById("pick_up_time").value;
            var pickUpAddress = document.getElementById("pick_up_address").value;
            var dropOffAddress = document.getElementById("drop_off_address").value;
            var returnPickUpDate = document.getElementById("return_date").value;
            var returnPickUpTime = document.getElementById("return_time").value;
            var returnPickUpAddress = document.getElementById("return_pick_up_address").value;
            var returnDropOffAddress = document.getElementById("return_drop_off_address").value;
            var adult = document.getElementById("adult").value;
            var children = document.getElementById("children").value;

            var errorMessage = [];

            if (tripType === "") {
                errorMessage.push("Trip Type");
                document.getElementById("tripTypeError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("Trip Type");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("tripTypeError").textContent = "";
            }
            if (mpvType === "") {
                errorMessage.push("MPV Type");
                document.getElementById("mpvTypeError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("MPV Type");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("mpvTypeError").textContent = "";
            }
            if (name === "") {
                errorMessage.push("name");
                document.getElementById("nameError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("name");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("nameError").textContent = "";
            }
            if (contactNumber === "") {
                errorMessage.push("Contact Number");
                document.getElementById("contactNumberError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("Contact Number");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("contactNumberError").textContent = "";
            }
            if (email === "") {
                errorMessage.push("Email");
                document.getElementById("emailError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("Email");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("emailError").textContent = "";
            }

            if (contactApp === "") {
                errorMessage.push("Contact App");
                document.getElementById("contactAppError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("Contact App");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("contactAppError").textContent = "";
            }
            if (nationality === "") {
                errorMessage.push("Nationality");
                document.getElementById("nationalityError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("Nationality");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("nationalityError").textContent = "";
            }
            if (pickUpDate === "") {
                errorMessage.push("Pick Up Date");
                document.getElementById("pickUpDateError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("Pick Up Date");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("pickUpDateError").textContent = "";
            }
            if (pickUpTime === "") {
                errorMessage.push("Pick Up Time");
                document.getElementById("pickUpTimeError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("Pick Up Time");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("pickUpTimeError").textContent = "";
            }
            if (pickUpAddress === "") {
                errorMessage.push("Pick Up Address");
                document.getElementById("pickUpAddressError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("Pick Up Address");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("pickUpAddressError").textContent = "";
            }
            if (dropOffAddress === "") {
                errorMessage.push("Drop Off Address");
                document.getElementById("dropOffAddressError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("Drop Off Address");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("dropOffAddressError").textContent = "";
            }
            if (tripType === "Two Way Transfer") {
                if (returnPickUpDate === "") {
                    errorMessage.push("Return Pick Up Date");
                    document.getElementById("returnDateError").textContent = "Required";
                } else {
                    var index = errorMessage.indexOf("Return Pick Up Date");
                    if (index !== -1) {
                        errorMessage.splice(index, 1); // Remove the error message at the found index
                    }
                    document.getElementById("returnDateError").textContent = "";

                }
                if (returnPickUpTime === "") {
                    errorMessage.push("Return Pick Up Time");
                    document.getElementById("returnTimeError").textContent = "Required";
                } else {
                    var index = errorMessage.indexOf("Return Pick Up Time");
                    if (index !== -1) {
                        errorMessage.splice(index, 1); // Remove the error message at the found index
                    }
                    document.getElementById("returnTimeError").textContent = "";

                }
                if (returnPickUpAddress === "") {
                    errorMessage.push("Return Pick Up Address");
                    document.getElementById("returnPickUpAddressError").textContent = "Required";
                } else {
                    var index = errorMessage.indexOf("Return Pick Up Address");
                    if (index !== -1) {
                        errorMessage.splice(index, 1); // Remove the error message at the found index
                    }
                    document.getElementById("returnPickUpAddressError").textContent = "";

                }
                if (returnDropOffAddress === "") {
                    errorMessage.push("Return Drop Off Address");
                    document.getElementById("returnDropOffAddressError").textContent = "Required";
                } else {
                    var index = errorMessage.indexOf("Return Drop Off Address");
                    if (index !== -1) {
                        errorMessage.splice(index, 1); // Remove the error message at the found index
                    }
                    document.getElementById("returnDropOffAddressError").textContent = "";

                }

            }
            if (adult === "") {
                errorMessage.push("Adult");
                document.getElementById("adultError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("Adult");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("adultError").textContent = "";
            }

            if (children === "") {
                errorMessage.push("Children");
                document.getElementById("childrenError").textContent = "Required";
            } else {
                var index = errorMessage.indexOf("Children");
                if (index !== -1) {
                    errorMessage.splice(index, 1); // Remove the error message at the found index
                }
                document.getElementById("childrenError").textContent = "";
            }

            // Display error messages if any
            if (errorMessage.length > 0) {
                // Scroll to the top of the form to show error messages
                var firstErrorElement = document.querySelector(".error");
                if (firstErrorElement) {
                    // Get the top position of the first error element
                    var errorTopPosition = firstErrorElement.getBoundingClientRect().top;

                    // Scroll a bit higher (50px) than the error element
                    window.scrollTo({
                        top: window.scrollY + errorTopPosition - 150,
                        behavior: "smooth"
                    });
                }
                return false;
            } else {
                event.target.submit();
            }
        });
        // Function to clear specific error message by ID
        function clearSpecificErrorMessage(errorId) {
            document.getElementById(errorId).textContent = "";
        }
        // Event listeners to clear specific error messages on input change
        var tripTypeInput = document.getElementById("trip_type");
        tripTypeInput.addEventListener("input", function() {
            clearSpecificErrorMessage("tripTypeError");
        });
        var mpvTypeInput = document.getElementById("mpv_type");
        mpvTypeInput.addEventListener("input", function() {
            clearSpecificErrorMessage("mpvTypeError");
        });
        var contactNumberInput = document.getElementById("contact_number");
        contactNumberInput.addEventListener("input", function() {
            clearSpecificErrorMessage("contactNumberError");
        });
        var nameInput = document.getElementById("name");
        nameInput.addEventListener("input", function() {
            clearSpecificErrorMessage("nameError");
        });
        var emailInput = document.getElementById("email");
        emailInput.addEventListener("input", function() {
            clearSpecificErrorMessage("emailError");
        });
        var contactAppInput = document.getElementById("contact_app");
        contactAppInput.addEventListener("input", function() {
            clearSpecificErrorMessage("contactAppError");
        });
        var nationalityInput = document.getElementById("nationality");
        nationalityInput.addEventListener("input", function() {
            clearSpecificErrorMessage("nationalityError");
        });
        var pickUpDateInput = document.getElementById("pick_up_date");
        pickUpDateInput.addEventListener("input", function() {
            clearSpecificErrorMessage("pickUpDateError");
        });
        var pickUpTimeInput = document.getElementById("pick_up_time");
        pickUpTimeInput.addEventListener("input", function() {
            clearSpecificErrorMessage("pickUpTimeError");
        });
        var pickUpAddressInput = document.getElementById("pick_up_address");
        pickUpAddressInput.addEventListener("input", function() {
            clearSpecificErrorMessage("pickUpAddressError");
        });
        var dropOffAddressInput = document.getElementById("drop_off_address");
        dropOffAddressInput.addEventListener("input", function() {
            clearSpecificErrorMessage("dropOffAddressError");
        });
        var returnPickUpDateInput = document.getElementById("return_date");
        returnPickUpDateInput.addEventListener("input", function() {
            clearSpecificErrorMessage("returnDateError");
        });
        var returnTimeInput = document.getElementById("return_time");
        returnTimeInput.addEventListener("input", function() {
            clearSpecificErrorMessage("returnTimeError");
        });
        var returnPickUpAddressInput = document.getElementById("return_pick_up_address");
        returnPickUpAddressInput.addEventListener("input", function() {
            clearSpecificErrorMessage("returnPickUpAddressError");
        });
        var returnDropOffAddressInput = document.getElementById("return_drop_off_address");
        returnDropOffAddressInput.addEventListener("input", function() {
            clearSpecificErrorMessage("returnDropOffAddressError");
        });

        var adultInput = document.getElementById("adult");
        adultInput.addEventListener("input", function() {
            clearSpecificErrorMessage("adultError");
        });
        var childrenInput = document.getElementById("children");
        childrenInput.addEventListener("input", function() {
            clearSpecificErrorMessage("childrenError");
        });


        function openWhatsApp() {
            // Your WhatsApp URL
            var whatsappURL = "https://wa.me/601128258565";

            // Open WhatsApp in a new tab
            window.open(whatsappURL, '_blank');
        }
    </script>
</body>

</html>