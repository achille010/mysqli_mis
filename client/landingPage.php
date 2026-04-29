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
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>

<body>

    <div class="panel">
        <label>Account Active</label>
        <h1><?php echo htmlspecialchars($fullname); ?></h1>
        <span class="user-email"><?php echo htmlspecialchars($email); ?></span>

        <p style="margin-bottom: 30px; line-height: 1.6; color: #94a3b8;">
            You've successfully accessed the system. All your personal records are secured and up to date.
        </p>

        <div style="display: flex; flex-direction: column; gap: 10px;">
            <a href="profile_edit.php" class="btn">Update Profile</a>
            <a href="../sever/logout.php" class="btn btn-logout">Sign Out</a>
        </div>
    </div>

</body>

</html>


</html>