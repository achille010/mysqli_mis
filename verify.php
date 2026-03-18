<?php
session_start();
include "connections.php";

if (isset($_POST["submit"])) {

    $email = $_POST["email"];
    $inputPassword = $_POST["password"];

    $stmt = $conn->prepare("SELECT password FROM members WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $hashedPassword = $row['password'];

        if (password_verify($inputPassword, $hashedPassword)) {
            $_SESSION['user_email'] = $email;

            if($email == 'adminOfMIS2026@gmail.com'){
                header("Location: SecureAdminPage.php");
                exit();
            } else {
                header("Location: landingPage.php");
                exit();
            }
        } else {
            echo "Invalid email or password!";
        }
    } else {
        echo "Invalid email or password!";
    }

    $stmt->close();
}