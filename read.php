<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read From Database</title>
</head>
<body>
    <?php
        include "connections.php";

        $fetchFName = "SELECT fname FROM members";
        $fetchLName = "SELECT lname FROM members";
        $fetchEmail = "SELECT email FROM members";
        $fetchGender = "SELECT gender FROM members";

        
    ?>
</body>
</html>