<?php
session_start();

if (isset($_SESSION["user_id"])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Remove the "user_id" cookie
    setcookie("user_id", "", time() - 3600, "/");
}

// Redirect the user to the login page after logging out
header("Location: login.php");
exit();
?>