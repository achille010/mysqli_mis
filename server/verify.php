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

            if ($email == 'adminOfMIS2026@gmail.com') {
                header("Location: ../client/SecureAdminPage.php");
                exit();
            } else {
                header("Location: ../client/landingPage.php");
                exit();
            }
        } else {
            echo "Invalid email or password!<br>";
            echo "<pre style='display: inline;'>&nbsp;</pre><a href='../client/login.php'>Login</a>";
            echo "<pre style='display: inline;'>&Tab;&Tab;</pre>";
            echo "<a href='../client/signup.php'>Signup</a>";
        }
    } else {
        echo "Invalid email or password!<br>";
        echo "&nbsp;&nbsp;&nbsp;<a href='../client/login.php'>Login</a>";
        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        echo "<a href='../client/signup.php'>Signup</a>";
    }

    $stmt->close();
}