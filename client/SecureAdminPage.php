<?php
session_start();
include "../server/connections.php";

if (!isset($_SESSION['user_email']) || $_SESSION['user_email'] !== 'adminOfMIS2026@gmail.com') {
    header("Location: login.php");
    exit();
}

$sql = "SELECT id, fname, lname, email, gender FROM members";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management | Admin Console</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <header class="header-minimal">
            <div>
                <span class="badge" style="background: #000; color: #fff; margin-bottom: 1rem; display: inline-block;">System Admin</span>
                <h1 class="text-gradient">Member<br>Management</h1>
                <p style="font-size: 1.1rem; max-width: 400px;">A refined overview of your organizational reach and member engagement.</p>
            </div>
            <div style="display: flex; align-items: center; gap: 2rem;">
                <div style="text-align: right;">
                    <p style="font-weight: 600; margin-bottom: 0;">Administrator</p>
                    <a href="../server/logout.php" style="font-size: 0.85rem; color: #ef4444; font-weight: 500; text-decoration: none;">Sign Out</a>
                </div>
                <div class="avatar-circle">AD</div>
            </div>
        </header>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
            <div style="display: flex; gap: 1rem;">
                <a href="signup.php" class="btn btn-primary">Create New Profile</a>
                <button class="btn btn-outline">Export Data</button>
            </div>
            <div style="color: var(--text-muted); font-size: 0.9rem; font-family: var(--font-heading);">
                Total Members: <strong><?php echo $result->num_rows; ?></strong>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Full Name</th>
                        <th>Email Identity</th>
                        <th>Gender</th>
                        <th style="text-align: right;">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td style="font-family: var(--font-heading); font-weight: 600; color: #94a3b8;">
                                #<?php echo str_pad($row['id'], 3, '0', STR_PAD_LEFT); ?>
                            </td>
                            <td>
                                <div style="font-weight: 600; font-family: var(--font-heading); font-size: 1.05rem;">
                                    <?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?>
                                </div>
                            </td>
                            <td style="color: var(--text-muted);"><?php echo htmlspecialchars($row['email']); ?></td>
                            <td>
                                <span class="badge" style="background: #f1f5f9; color: #475569; font-size: 0.65rem;">
                                    <?php echo strtoupper($row['gender']); ?>
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <div style="display: flex; gap: 1.5rem; justify-content: flex-end;">
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" style="color: var(--text-main); font-weight: 600; text-decoration: none; font-size: 0.85rem;">Edit</a>
                                    <a href="../server/delete.php?id=<?php echo $row['id']; ?>" 
                                       style="color: #ef4444; font-weight: 600; text-decoration: none; font-size: 0.85rem;"
                                       onclick="return confirm('Archive this record?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
