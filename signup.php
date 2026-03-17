<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form action="create.php" method="post">
        <fieldset>
            <legend>Personal details</legend>
            
            <label for="firstName">First Name:</label><br>
            <input type="text" name="firstName" id="firstName"><br>

            <label for="lastName">Last Name:</label><br>
            <input type="text" name="lastName" id="lastName"><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email"><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password"><br>

            <p>Gender:</p>
            <input type="radio" name="gender" id="male" value="male" required>
            <label for="male">Male</label>
            
            <input type="radio" name="gender" id="female" value="female">
            <label for="female">Female</label><br><br>

            <input type="submit" name="submit" id="submit" value="Submit">
        </fieldset>
    </form>
</body>
</html>
