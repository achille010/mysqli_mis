<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <form action="../server/create.php" method="post">
        <fieldset>
            <legend>Personal details</legend>

            <div class="names">
                <div class="cont">
                    <label for="firstName">First Name:</label>
                    <input type="text" name="firstName" id="firstName"><br>
                </div>

                <div class="cont">
                    <label for="lastName">Last Name:</label>
                    <input type="text" name="lastName" id="lastName"><br>
                </div>
            </div>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email"><br><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password"><br><br>

            <p>Gender:</p>

            <div class="radio">
                <div class="male">
                    <input type="radio" name="gender" id="male" value="male" required>
                    <label for="male">Male</label>
                </div>
                <div class="female">
                    <input type="radio" name="gender" id="female" value="female">
                    <label for="female">Female</label><br><br>
                </div>
            </div>

            <div class="submit">
                <input type="submit" name="submit" id="submit" value="Submit">
                <a href="login.php">Login instead</a>
            </div>
        </fieldset>
    </form>
</body>

</html>



</html>