<form method="post" action="">
    <input type="text" name="name">
    <input type="text" name="phone">
    <input type="text" name="email">
    <input type="text" name="service">
    <button name="submit">submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $service = $_POST["service"];

    $url = "https://wa.me/918789529215?text="
        . "Name: " . urlencode($name) . "%0a"
        . "Phone: " . urlencode($phone) . "%0a"
        . "Email: " . urlencode($email) . "%0a"
        . "Service: " . urlencode($service);

    header("Location: $url");
    exit(); // Make sure to exit after redirection

}

?>