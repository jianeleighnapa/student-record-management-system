<?php
session_start();
include 'db.php';

// If already logged in, redirect
if (isset($_SESSION['teacher'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // check if user exists (optional but recommended)
    $check = $pdo->prepare("SELECT * FROM teachers WHERE username = ?");
    $check->execute([$username]);

    if ($check->rowCount() > 0) {
        $error = "Username already exists!";
    } else {

        $stmt = $pdo->prepare("INSERT INTO teachers (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);

        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 400px;">

        <h3 class="text-center mb-3">
            <i class="fa-solid fa-user-plus"></i> Register
        </h3>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <input type="text" name="username" class="form-control"
                       placeholder="Username" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control"
                       placeholder="Password" required>
            </div>

            <button type="submit" class="btn btn-success w-100">
                <i class="fa-solid fa-floppy-disk"></i> Register
            </button>

            <a href="log_in.php" class="btn btn-secondary w-100 mt-2">
                <i class="fa-solid fa-arrow-left"></i> Back to Login
            </a>

        </form>

    </div>

</div>

</body>
</html>