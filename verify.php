<?php
    if(isset($_POST["submit"])){
        $email = $_POST["email"];
        $password = $_POST["password"];

        $command = "SELECT password FROM members WHERE email = '$email'";

        $retrievedPass = $conn -> query($command);
        
        if($password == $retrievedPass) $queryDone = true;
        
        if($queryDone){
            header("Location: home.html", true, 301);
            exit();
        }
    }