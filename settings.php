<?php
session_start();
include 'db.php';

if (!isset($_SESSION['teacher'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['teacher'];

// Get current teacher data
$stmt = $pdo->prepare("SELECT * FROM teachers WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit();
}

// UPDATE SETTINGS
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Update username
    if (!empty($_POST['username'])) {
        $newUsername = $_POST['username'];

        $update = $pdo->prepare("UPDATE teachers SET username = ? WHERE id = ?");
        $update->execute([$newUsername, $user['id']]);

        $_SESSION['teacher'] = $newUsername;
        $message = "Username updated successfully!";
    }

    // Update password
    if (!empty($_POST['password'])) {
        $newPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $update = $pdo->prepare("UPDATE teachers SET password = ? WHERE id = ?");
        $update->execute([$newPassword, $user['id']]);

        $message = "Password updated successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">

<div class="container mt-5 d-flex justify-content-center">

    <div class="card shadow p-4" style="width: 450px;">

        <h3 class="text-center mb-3">
            <i class="fa-solid fa-gear"></i> Settings
        </h3>

        <?php if ($message): ?>
            <div class="alert alert-success text-center">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <!-- Username -->
            <label>Username</label>
            <input type="text" name="username" class="form-control mb-3"
                   value="<?= htmlspecialchars($user['username']) ?>">

            <!-- Password -->
            <label>New Password</label>
            <input type="password" name="password" class="form-control mb-3"
                   placeholder="Enter new password">

            <button type="submit" class="btn btn-primary w-100">
                <i class="fa-solid fa-floppy-disk"></i> Save Changes
            </button>

        </form>

        <a href="dashboard.php" class="btn btn-secondary w-100 mt-2">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>

    </div>

</div>

</body>
</html>