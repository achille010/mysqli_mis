<?php
session_start();
include "connections.php";

// SECURITY: Only admin can trigger a delete
if(!isset($_SESSION['user_email']) || $_SESSION['user_email'] !== 'adminOfMIS2026@gmail.com' ){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()){
        header("Location: SecureAdminPage.php"); // Return to dashboard
        exit();
    } else {
        echo "Error deleting: " . $conn->error;
    }
}
?>