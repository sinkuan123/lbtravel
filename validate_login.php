<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: admin_login.php?action=warning");
    exit();
}

$logout = isset($_GET['logout']) ? $_GET['logout'] : "";
if ($logout == "true") {
    session_unset();
    session_destroy();
    header("Location: admin_login.php");
    exit();
}
