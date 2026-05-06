<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
include "../server/connections.php";

$email = $_SESSION['user_email'];

if ($email == "adminOfMIS2026@gmail.com") {
    header("Location: SecureAdminPage.php");
    exit();
}

$fname = '';
$lname = '';

$stmt = $conn->prepare("SELECT fname, lname FROM members WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$res = $stmt->get_result();

if ($row = $res->fetch_assoc()) {
    $fname = $row['fname'];
    $lname = $row['lname'];

    $fullname = $fname . " " . $lname;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard | Member Portal</title>
</head>

<body>

    <div class="container" style="max-width: 800px;">
        <header class="nav-header">
            <h1><div class="logo-icon"><img src="assets/logo.png" alt="Edumate Logo"></div> Edumate</h1>

            <div style="display: flex; align-items: center; gap: 12px;">
                <span class="status-online">Online</span>
                <div class="user-avatar" style="background: var(--primary);"><?php echo strtoupper(substr($fname, 0, 1)); ?></div>
            </div>
        </header>

        <div class="section-flat" style="padding-top: 24px;">
            <div style="margin-bottom: 48px;">
                <h2 style="font-size: 2.5rem; margin-bottom: 8px;">Welcome, <?php echo htmlspecialchars($fname); ?></h2>
                <p style="color: var(--text-muted); font-size: 1.125rem;"><?php echo htmlspecialchars($email); ?></p>
            </div>

            <div style="border: 1px solid var(--border); border-radius: var(--radius-md); padding: 32px; margin-bottom: 48px;">
                <h4 style="margin-bottom: 12px; font-size: 1rem; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted);">Account Status</h4>
                <p style="font-size: 1rem; color: var(--text-main); line-height: 1.6;">
                    Your account is currently in good standing. You can access all system features and manage your
                    personal records from this dashboard.
                </p>
            </div>

            <div style="display: flex; gap: 16px;">
                <a href="profile_edit.php" class="btn btn-primary" style="padding: 12px 32px;">Update Profile</a>
                <a href="../server/logout.php" class="btn btn-ghost" style="padding: 12px 32px;">Sign Out</a>
            </div>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class="badge badge-success" style="width: 100%; justify-content: center; padding: 12px; margin-top: 16px;">
                <?php echo htmlspecialchars($_GET['msg']); ?>
            </div>
        <?php endif; ?>
    </div>

</body>

</html>