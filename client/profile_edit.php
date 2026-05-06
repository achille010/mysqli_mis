<?php
session_start();
include "../server/connections.php";

if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['user_email'];
$msg = "";

$stmt = $conn->prepare("SELECT * FROM members WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user) {
    die("User not found.");
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $new_email = $_POST['email'];
    $gender = $_POST['gender'];

    $stmt = $conn->prepare("UPDATE members SET fname=?, lname=?, email=?, gender=? WHERE id=?");
    $stmt->bind_param("ssssi", $fname, $lname, $new_email, $gender, $id);

    if ($stmt->execute()) {
        $_SESSION['user_email'] = $new_email;
        header("Location: landingPage.php?msg=Profile Updated Successfully");
        exit();
    } else {
        $msg = "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | Member Portal</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container" style="max-width: 600px;">
        <header class="nav-header">
            <h1><div class="logo-icon"><img src="assets/logo.png" alt="Edumate Logo"></div> Edumate</h1>
            <a href="landingPage.php" class="btn btn-ghost" style="font-size: 0.8125rem;">&larr; Back to Home</a>
        </header>

        <div style="border: 1px solid var(--border); border-radius: var(--radius-md); padding: 32px; background: white;">
            <?php if ($msg): ?>
                <div class="badge badge-danger" style="width: 100%; justify-content: center; padding: 12px; margin-bottom: 24px;">
                    <?= $msg ?>
                </div>
            <?php endif ?>

            <form method="post">
                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                
                <div style="display: flex; gap: 12px; margin-bottom: 24px;">
                    <div style="flex: 1;">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" value="<?= htmlspecialchars($user['fname']) ?>" required>
                    </div>
                    <div style="flex: 1;">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" value="<?= htmlspecialchars($user['lname']) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Gender</label>
                    <div style="display: flex; gap: 12px; margin-top: 12px;">
                        <label class="btn btn-ghost" style="flex: 1; font-weight: 400; cursor: pointer;">
                            <input type="radio" name="gender" value="Male" <?= ($user['gender'] == 'Male' ? 'checked' : '') ?> required style="width: auto; margin-right: 8px;">
                            Male
                        </label>
                        <label class="btn btn-ghost" style="flex: 1; font-weight: 400; cursor: pointer;">
                            <input type="radio" name="gender" value="Female" <?= ($user['gender'] == 'Female' ? 'checked' : '') ?> style="width: auto; margin-right: 8px;">
                            Female
                        </label>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 32px;">
                    <button type="submit" name="update" class="btn btn-primary" style="flex: 2; padding: 10px;">Save Changes</button>
                    <a href="landingPage.php" class="btn btn-ghost" style="flex: 1; padding: 10px; text-align: center;">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>