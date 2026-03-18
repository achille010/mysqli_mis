<?php
    include 'connections.php';

    if (isset($_POST['submit'])){
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];
        $email = $_POST['email'];
        $passWord = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $gender = $_POST['gender'];

        $stmt = $conn -> prepare(
        "INSERT INTO members ( fname, lname, email, password, gender) VALUES 
            (
                ?, 
                ?,
                ?,
                ?,
                ? 
            )");

        $stmt->bind_param("sssss", $first_name, $last_name, $email, $passWord, $gender);

        if($stmt->execute()){
            header("Location: signupSuccess.php", true, 302);
            exit();
        }
        else {
            echo "Signup Failed";
        }
    }