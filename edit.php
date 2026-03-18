<?php
session_start();
include "connections.php";

if (!isset($_SESSION['user_email']) || $_SESSION['user_email'] !== 'adminOfMIS2026@gmail.com') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM members WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE members SET fname=?, lname=?, email=? WHERE id=?");
    $stmt->bind_param("sssi", $fname, $lname, $email, $id);

    if ($stmt->execute()) {
        header("Location: SecureAdminPage.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
</head>

<body>
    <h2>Edit Member Details</h2>
    <form method="POST">
        <fieldset>
            <legend>Edit User form</legend>
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            First Name: <br>
            <input type="text" name="fname" value="<?php echo $user['fname']; ?>"><br><br>
            Last Name: <br>
            <input type="text" name="lname" value="<?php echo $user['lname']; ?>"><br><br>
            Email: <br>
            <input type="email" name="email" value="<?php echo $user['email']; ?>"><br><br>
            <button type="submit" name="update">Save Changes</button>
            <a href="SecureAdminPage.php">Cancel</a>
        </fieldset>
    </form>
</body>

</html>