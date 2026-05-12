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

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .settings-card {
            width: 420px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .icon-circle {
            width: 65px;
            height: 65px;
            background: #4e73df;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin: 0 auto 10px;
        }

        .form-control {
            border-radius: 10px;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78,115,223,.25);
        }

        .btn-primary {
            border-radius: 10px;
            background: #4e73df;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #2e59d9;
            transform: translateY(-1px);
        }

        .btn-outline-secondary {
            border-radius: 10px;
        }

        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="card settings-card shadow-lg p-4">

    <div class="text-center">
        <div class="icon-circle">
            <i class="fa-solid fa-gear"></i>
        </div>
        <h4 class="fw-bold">Account Settings</h4>
        <p class="text-muted small">Update your account details</p>
    </div>

    <?php if ($message): ?>
        <div class="alert alert-success text-center">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="POST">

        <!-- Username -->
        <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control"
                   id="username"
                   value="<?= htmlspecialchars($user['username']) ?>">
            <label for="username"><i class="fa-solid fa-user"></i> Username</label>
        </div>

        <!-- Password -->
        <div class="form-floating mb-3 password-wrapper">
            <input type="password" name="password" class="form-control"
                   id="password" placeholder="New Password">
            <label for="password"><i class="fa-solid fa-lock"></i> New Password</label>
            <i class="fa-solid fa-eye toggle-password" onclick="togglePassword()"></i>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-2">
            <i class="fa-solid fa-floppy-disk"></i> Save Changes
        </button>

    </form>

    <a href="dashboard.php" class="btn btn-outline-secondary w-100">
        <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
    </a>

</div>

<script>
function togglePassword() {
    const pass = document.getElementById("password");
    const icon = document.querySelector(".toggle-password");

    if (pass.type === "password") {
        pass.type = "text";
        icon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
        pass.type = "password";
        icon.classList.replace("fa-eye-slash", "fa-eye");
    }
}
</script>

</body>
</html>