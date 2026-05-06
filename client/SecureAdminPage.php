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
    <title>Admin Console | Member Management</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container">
        <header class="nav-header">
            <h1><div class="logo-icon"><img src="assets/logo.png" alt="Edumate Logo"></div> Edumate</h1>

            <div class="user-profile">
                <div style="text-align: right; margin-right: 12px;">
                    <p style="font-weight: 600; font-size: 0.875rem; margin-bottom: 0;">System Admin</p>
                    <a href="../server/logout.php" style="font-size: 0.75rem; text-decoration: none; font-weight: 600; color: var(--danger);">Sign Out</a>
                </div>
                <div class="user-avatar">AD</div>
            </div>
        </header>

        <div class="stats-grid">
            <div class="stat-item">
                <p class="stat-label">Total Members</p>
                <h3 class="stat-value"><?php echo $result->num_rows; ?></h3>
            </div>
            <div class="stat-item">
                <p class="stat-label">System Status</p>
                <h3 class="stat-value" style="color: var(--success); display: flex; align-items: center; gap: 8px;">
                    <span class="status-online"></span>
                    Active
                </h3>
            </div>
            <div class="stat-item">
                <p class="stat-label">Pending</p>
                <h3 class="stat-value">0</h3>
            </div>
        </div>

        <div class="section-flat">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                <h2 style="font-size: 1.25rem;">Member Directory</h2>
                <a href="signup.php" class="btn btn-primary">+ Add New Member</a>
            </div>

            <div class="table-wrapper">
                <table>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>Gender</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td style="color: var(--text-muted); font-weight: 500;">#<?php echo $row['id']; ?></td>
                                <td style="font-weight: 600;"><?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td>
                                    <span class="badge badge-neutral"><?php echo ucfirst($row['gender']); ?></span>
                                </td>
                                <td style="text-align: right;">
                                    <div class="flex gap-2" style="justify-content: flex-end;">
                                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-ghost" style="padding: 6px 12px; font-size: 0.75rem;">Edit</a>
                                        <a href="../server/delete.php?id=<?php echo $row['id']; ?>" 
                                           class="btn btn-danger" 
                                           style="padding: 6px 12px; font-size: 0.75rem;"
                                           onclick="return confirm('Delete this record?')">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center" style="padding: 40px; color: var(--text-muted);">No members found in the directory.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
