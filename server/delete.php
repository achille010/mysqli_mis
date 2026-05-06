<?php
session_start();
include "connections.php";

if(!isset($_SESSION['user_email']) || $_SESSION['user_email'] !== 'adminOfMIS2026@gmail.com' ){
    header("Location: ../server/login.php");
    exit();
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM members WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()){
        header("Location: ../client/SecureAdminPage.php?msg=Member Deleted Successfully");
        exit();
    } else {
        echo "Error deleting: " . $conn->error;
    }
}
?>