<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
// This file is currently being refactored into the main Admin Dashboard.
// Redirecting for consistency...
header("Location: SecureAdminPage.php");
exit();
?>