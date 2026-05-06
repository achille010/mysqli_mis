<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Member Management Portal</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="auth-page-body">
    <div class="container auth-container">
        <div class="auth-header">
            <div class="logo-icon" style="margin: 0 auto 32px; height: 100px;"><img src="assets/logo.png" alt="Edumate Logo"></div>
            <h1>Sign in to Edumate</h1>

            <p style="color: var(--text-muted); font-size: 0.875rem;">Enter your credentials to access your account</p>
        </div>

        <div style="border: 1px solid var(--border); border-radius: var(--radius-md); padding: 32px; background: white;">
            <?php if (isset($_GET['error'])): ?>
                <div style="background: var(--danger-soft); color: var(--danger); border: 1px solid #fecaca; padding: 10px; border-radius: var(--radius-sm); margin-bottom: 24px; font-size: 0.8125rem; text-align: center;">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>
            <form action="../server/verify.php" method="post">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="name@company.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                </div>

                <div style="margin-top: 32px;">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary" style="width: 100%; padding: 10px;">Sign In</button>
                </div>
            </form>
        </div>

        <div style="text-align: center; margin-top: 24px;">
            <p style="font-size: 0.875rem; color: var(--text-muted);">
                New here? <a href="signup.php" style="color: var(--accent); font-weight: 600; text-decoration: none;">Create an account</a>
            </p>
        </div>
    </div>
</body>

</html>