<?php
session_start();
include 'db.php';

if (!isset($_SESSION['teacher'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['teacher'];

$stmt = $pdo->prepare("SELECT * FROM teachers WHERE username=?");
$stmt->execute([$username]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light">

<div class="container mt-5 d-flex justify-content-center">

    <div class="card shadow p-4" style="width: 400px;">

        <div class="text-center">
            <i class="fa-solid fa-user-circle fa-5x text-primary"></i>
            <h3 class="mt-3">Teacher Profile</h3>
        </div>

        <hr>

        <p><strong><i class="fa-solid fa-user"></i> Username:</strong> <?= $user['username'] ?></p>
        <p><strong><i class="fa-solid fa-id-card"></i> ID:</strong> <<?= $user['id'] ?? 'N/A' ?></p>

        <a href="dashboard.php" class="btn btn-secondary w-100 mt-2">
            <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
        </a>

    </div>

</div>

</body>
</html>