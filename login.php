<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S M S - Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="verify.php" method="post">
        <fieldset>
            <legend>Login</legend>
            email: <br>
            <input type="email" name="email" id="email"><br><br>

            password: <br>
            <input type="password" name="password" id="password"><br><br>

            <div style="display: flex; flex-direction: row; gap: 5px;">
                <input type="submit" name="submit" id="submit"><br>
                <a class="sign-a" href="signup.php">Signup instead</a>
            </div>
        </fieldset>
    </form>
</body>
</html>