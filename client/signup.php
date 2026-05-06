<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | Member Management Portal</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="auth-page-body">
    <div class="container auth-container" style="max-width: 500px;">
        <div class="auth-header">
            <div class="logo-icon" style="margin: 0 auto 32px; height: 100px;"><img src="assets/logo.png" alt="Edumate Logo"></div>
            <h1>Join Edumate</h1>

            <p style="color: var(--text-muted); font-size: 0.875rem;">Fill in the details below to join</p>
        </div>

        <div style="border: 1px solid var(--border); border-radius: var(--radius-md); padding: 32px; background: white;">
            <form action="../server/create.php" method="post">
                <div style="display: flex; gap: 12px; margin-bottom: 24px;">
                    <div style="flex: 1;">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName" placeholder="John" required>
                    </div>
                    <div style="flex: 1;">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName" placeholder="Doe" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="john@example.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <div style="display: flex; gap: 12px; margin-top: 12px;">
                        <label class="btn btn-ghost" style="flex: 1; font-weight: 400; cursor: pointer;">
                            <input type="radio" name="gender" value="male" required style="width: auto; margin-right: 8px;">
                            Male
                        </label>
                        <label class="btn btn-ghost" style="flex: 1; font-weight: 400; cursor: pointer;">
                            <input type="radio" name="gender" value="female" style="width: auto; margin-right: 8px;">
                            Female
                        </label>
                    </div>
                </div>

                <div style="margin-top: 32px;">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary" style="width: 100%; padding: 10px;">Create Account</button>
                </div>
            </form>
        </div>

        <div style="text-align: center; margin-top: 24px;">
            <p style="font-size: 0.875rem; color: var(--text-muted);">
                Already registered? <a href="login.php" style="color: var(--accent); font-weight: 600; text-decoration: none;">Sign in</a>
            </p>
        </div>
    </div>
</body>

</html>