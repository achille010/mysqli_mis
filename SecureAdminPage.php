<?php
session_start();
include "connections.php";

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
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Member Management</h1>
        <a href="logout.php" style="color: red;">Logout</a>
    </div>

    <a href="signup.php" class="btn add">+ Add New Member</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['fname'] . " " . $row['lname']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn edit">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn delete"
                        onclick="return confirm('Delete this user?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>

</html>