<?php
include 'connections.php';

if (isset($_POST['submit'])) {
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $email = $_POST['email'];
    $passWord = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $gender = $_POST['gender'];

    $fetchMail = $conn->prepare("SELECT * FROM members WHERE email = ?");
    $fetchMail->bind_param("s", $email);
    $fetchMail->execute();
    $fetchMail->store_result();

    if ($fetchMail->num_rows > 0) {
        echo "Error: User Already registered";
        $fetchMail->close();
        header("Location: ../client/signup.php", true, 302);
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO members ( fname, lname, email, password, gender) VALUES 
            (
                ?, 
                ?,
                ?,
                ?,
                ? 
            )"
        );

        $stmt->bind_param("sssss", $first_name, $last_name, $email, $passWord, $gender);

        if ($stmt->execute()) {
            header("Location: ../client/signupSuccess.php", true, 302);
            exit();
        } else {
            echo "Signup Failed";
        }
    }
}