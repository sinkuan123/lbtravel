<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="js/script.js">
    <title>Online Booking</title>
</head>

<body>
    <div class="container-fluid">
        <div class="d-flex justify-content-around align-items-center">
            <div><a href="index.php"><img src="img/logo.png" width="35%" alt=""></a></div>
            <div class="w-25">
                <a href="booking.php" class="bg-danger border-0 rounded-3 p-3 px-5 link-light link-underline-opacity-0 fs-4">
                    <img src="img/car.svg" width="7%" class="mx-2" alt="">Online Booking</a>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item dropdown mx-4 px-2">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            HOME
                        </a>
                        <ul class="dropdown-menu bg-danger">
                            <li><a class="dropdown-item" href="aboutus.php">ABOUT US</a></li>
                            <li><a class="dropdown-item" href="#">TERMS AND CONDITION</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown mx-4 px-2">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            MALAYSIA
                        </a>
                        <ul class="dropdown-menu bg-danger">
                            <li><a class="dropdown-item" href="aboutus.php">JOHOR BAHRU</a></li>
                            <li><a class="dropdown-item" href="#">LEGOLAND</a></li>
                            <li><a class="dropdown-item" href="#">MALACCA</a></li>
                            <li><a class="dropdown-item" href="#">DESARU</a></li>
                            <li><a class="dropdown-item" href="#">MERSING</a></li>
                            <li><a class="dropdown-item" href="#">TANJONG GEMOK</a></li>
                            <li><a class="dropdown-item" href="#">PORT DICKSON</a></li>
                            <li><a class="dropdown-item" href="#">GENTING HIGHLAND</a></li>
                            <li><a class="dropdown-item" href="#">KUALA LUMPUR</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mx-4 px-2">
                        <a class="nav-link active" aria-current="page" href="#">MPV CAR</a>
                    </li>
                    <li class="nav-item dropdown mx-4 px-2">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            RATES
                        </a>
                        <ul class="dropdown-menu bg-danger">
                            <li><a class="dropdown-item" href="aboutus.php">SINGAPORE TO MALAYSIA</a></li>
                            <li><a class="dropdown-item" href="#">SINGAPORE TO MALAYSIA</a></li>
                            <li><a class="dropdown-item" href="#">AIRPORT TRANSFER RATES</a></li>
                            <li><a class="dropdown-item" href="#">DAY TRIP HOUR SERVICE</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mx-4 px-2">
                        <a class="nav-link active" href="#">BOOKING</a>
                    </li>
                    <li class="nav-item dropdown mx-4 px-2">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            FAQ
                        </a>
                        <ul class="dropdown-menu bg-danger">
                            <li><a class="dropdown-item" href="aboutus.php">HOW TO BOOK</a></li>
                        </ul>
                    </li>
                    <li class="nav-item mx-4 px-2">
                        <a class="nav-link active" href="#">REVIEW</a>
                    </li>
                    <li class="nav-item mx-4 px-2">
                        <a class="nav-link active" href="#">BLOG</a>
                    </li>
                    <li class="nav-item mx-4 px-2">
                        <a class="nav-link active" href="#">CONTACT US</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <h2 class="my-5">Online Booking</h2>
            <?php
            if (isset($_POST['submit'])) {
                // include database connection
                include 'config/database.php';
                try {
                    // insert query
                    $query = "INSERT INTO online_booking SET trip_type=:trip_type, mpv_type=:mpv_type, name=:name,
                 contact_number=:contact_number,email=:email, contact_app=:contact_app, nationality=:nationality, pick_up_date=:pick_up_date, 
                 pick_up_time=:pick_up_time, flight=:flight, pick_up_address=:pick_up_address, drop_off_address=:drop_off_address, adult=:adult,
                  children=:children, luggage=:luggage, enquiry=:enquiry";
                    // prepare query for execution
                    $stmt = $con->prepare($query);
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
                    $adult = $_POST['adult'];
                    $children = $_POST['children'];
                    $luggage = $_POST['luggage'];
                    $enquiry = $_POST['enquiry'];

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

                        header("Location: $url");
                        exit();
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
                        $stmt->bindParam(':adult', $adult);
                        $stmt->bindParam(':children', $children);
                        $stmt->bindParam(':luggage', $luggage);
                        $stmt->bindParam(':enquiry', $enquiry);

                        // Execute the query
                        if ($stmt->execute()) {
                            echo "<div class='alert alert-success m-3'>Record was saved.</div>";
                            $_POST = array();
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
            ?>
            <form method="post" action="" target="_blank">
                <div class="row mt-4">
                    <div class="col-sm my-sm-0 my-2">
                        <label for="trip_type">Trip Type</label>
                        <select class="fs-6 form-select form-select-lg" id="trip_type" name="trip_type" aria-label=".form-select-lg example" onchange="toggleFunction()" required>
                            <option value="" selected disabled hidden>Select Your Trip Type</option>
                            <option value="One Way Transfer">One Way Transfer</option>
                            <option value="Two Way Transfer" name="haha">Two Way Transfer</option>
                            <option value="Day Trip Services">Day trip Services</option>
                        </select>
                    </div>
                    <div class="col-sm my-sm-0 my-2">
                        <label for="mpv_type">MPV Type</label>
                        <select class="form-select form-select-lg fs-6" id="mpv_type" name="mpv_type" required>
                            <option value="" class="opacity-50" selected disabled hidden>Select Your MPV Type</option>
                            <option value="Toyota Innova">Toyota Innova</option>
                            <option value="Toyota Alphard">Toyota Alphard</option>
                            <option value="Hyundai Starex">Hyundai Starex</option>
                        </select>
                    </div>
                </div>

                <div class="row my-3">
                    <div class="col-sm my-sm-0 my-2">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required>
                    </div>

                    <div class="col">
                        <label for="contact_number">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control" value="<?php echo isset($_POST['contact_number']) ? $_POST['contact_number'] : ''; ?>" required>
                    </div>
                </div>
                <div class="col my-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
                </div>
                <div class="row my-3">
                    <div class="col">
                        <label for="contact_app">Contact App Prefence</label>
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
                        <label for="nationality">Nationality</label>
                        <input type="text" name="nationality" id="nationality" class="form-control" value="<?php echo isset($_POST['nationality']) ? $_POST['nationality'] : ''; ?>">
                    </div>
                </div>
                <legend class="my-3 text-primary">Pick Up Detail</legend>

                <div class="row my-3">
                    <div class="col">
                        <label for="pick_up_date">Pick Up Date</label>
                        <input type="date" name="pick_up_date" id="pick_up_date" class="form-control" value="<?php echo isset($_POST['pick_up_date']) ? $_POST['pick_up_date'] : ''; ?>" required>
                    </div>
                    <div class="col">
                        <label for="pick_up_time">Pick Up Time</label>
                        <input type="time" name="pick_up_time" id="pick_up_time" class="form-control" value="<?php echo isset($_POST['pick_up_time']) ? $_POST['pick_up_time'] : ''; ?>" required>
                    </div>
                    <div class="col">
                        <label for="flight">Flight Detail</label>
                        <input type="text" name="flight" id="flight" class="form-control" value="<?php echo isset($_POST['flight']) ? $_POST['flight'] : ''; ?>">
                    </div>
                </div>
                <div class="col my-3">
                    <label for="pick_up_address">Pick Up Address</label>
                    <input type="text" name="pick_up_address" id="pick_up_address" class="form-control" value="<?php echo isset($_POST['pick_up_address']) ? $_POST['pick_up_address'] : ''; ?>">
                </div>
                <div class="col my-3">
                    <label for="drop_off_address">Drop Off Address</label>
                    <input type="text" name="drop_off_address" id="drop_off_address" class="form-control" value="<?php echo isset($_POST['drop_off_address']) ? $_POST['drop_off_address'] : ''; ?>">
                </div>

                <div style="display:none" id="return_detail">
                    <legend class="my-3 text-primary">Return Detail</legend>
                    <div class="row my-3">
                        <div class="col">
                            <label for="return_date">Return Date</label>
                            <input type="date" class="form-control" name="return_date" id="return_date" value="<?php echo isset($_POST['return_date']) ? $_POST['return_date'] : ''; ?>">
                        </div>
                        <div class="col"><label for="return_time">Return Time</label>
                            <input type="time" class="form-control" name="return_time" id="return_time" value="<?php echo isset($_POST['return_time']) ? $_POST['return_time'] : ''; ?>">
                        </div>
                        <div class="col">
                            <label for="return_flight">Flight Detail</label>
                            <input type="text" class="form-control" name="return_flight" id="return_flight" value="<?php echo isset($_POST['return_flight']) ? $_POST['return_flight'] : ''; ?>">
                        </div>
                    </div>
                    <div class="col my-3">
                        <label for="return_pick_up_address">Return Pick Up Address</label>
                        <input type="text" class="form-control" name="return_pick_up_address" id="return_pick_up_address" value="<?php echo isset($_POST['return_pick_up_address']) ? $_POST['return_pick_up_address'] : ''; ?>">
                    </div>
                    <div class="col my-3">
                        <label for="return_drop_off_address">Return Drop Off Address</label>
                        <input type="text" class="form-control" name="return_drop_off_address" id="return_drop_off_address" value="<?php echo isset($_POST['return_drop_off_address']) ? $_POST['return_drop_off_address'] : ''; ?>">
                    </div>
                </div>

                <legend class="my-3 text-primary">Passenger and Luggage</legend>
                <div class="row my-3">
                    <div class="col">
                        <label for="adult">Adult</label>
                        <input type="text" name="adult" id="adult" class="form-control" value="<?php echo isset($_POST['adult']) ? $_POST['adult'] : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="children">Children(Include Infrants)</label>
                        <input type="text" name="children" id="children" class="form-control" value="<?php echo isset($_POST['children']) ? $_POST['children'] : ''; ?>">
                    </div>
                    <div class="col">
                        <label for="luggage">Luggage</label>
                        <input type="text" name="luggage" id="luggage" class="form-control" value="<?php echo isset($_POST['luggage']) ? $_POST['luggage'] : ''; ?>">
                    </div>
                </div>
                <div class="col my-3">
                    <label for="enquiry">Special Enquiry</label>
                    <textarea name="enquiry" id="enquiry" cols="30" rows="2" class="form-control"><?php echo isset($_POST['enquiry']) ? $_POST['enquiry'] : ''; ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary my-2" name="submit">Submit</button>
            </form>
        </div>
        <div class="container-fluid mt-3 py-5 bg-body-secondary">
            <h1 class="text-danger text-center my-1">For Fast Response</h1>
            <p class="text-center">Book Now For Your Trip With Us</p>
            <div class="row my-5">
                <div class="col">
                    <h3 class="text-center">Call Us</h3>
                    <p class="text-center">(+60)11 2825 8565 (English, Mandarin, and Malay)</p>
                </div>
                <div class="col">
                    <h3 class="text-center">Whatsapp Us</h3>
                    <p class="text-center">(+60)11 2825 8565</p>
                </div>
                <div class="col">
                    <h3 class="text-center">Wechat / Line ID</h3>
                    <p class="text-center">(+60)11 2825 8565</p>
                </div>
                <div class="col">
                    <h3 class="text-center">Email Us</h3>
                    <p class="text-center">Lbtraveltransport@gmail.com</p>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-5">
            <h1 class="text-danger text-center">Our Social media Channels</h1>
            <p class="text-center">For online booking, give us 24 hours to send you the latest quotation after you have submitted your booking details</p>
            <div class="row my-5">
                <div class="col">
                    <h3 class="text-center">Facebook</h3>
                    <p class="text-center">LB Travel Transport</p>
                </div>
                <div class="col">
                    <h3 class="text-center">Instagram</h3>
                    <p class="text-center">LB Travel Transport</p>
                </div>
                <div class="col">
                    <h3 class="text-center">Twitter</h3>
                    <p class="text-center">LB Travel Transport</p>
                </div>
                <div class="col">
                    <h3 class="text-center">Linkedin</h3>
                    <p class="text-center">LB Travel Transport</p>
                </div>
                <div class="col">
                    <h3 class="text-center">Youtube</h3>
                    <p class="text-center">LB Travel Transport</p>
                </div>
            </div>
            <?php include 'footer.php' ?>
        </div>
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
        </script>
</body>

</html>