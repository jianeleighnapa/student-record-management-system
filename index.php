<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['teacher'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>School Record Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            width: 400px;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitle {
            color: gray;
            margin-bottom: 25px;
        }

        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="box">

    <i class="fa-solid fa-school fa-3x text-primary"></i>

    <div class="title mt-3">School Record Management System</div>
    <div class="subtitle">Manage students, records, and profiles easily</div>

    <a href="log_in.php" class="btn btn-primary btn-custom">
        <i class="fa-solid fa-right-to-bracket"></i> Login
    </a>

    <a href="create.php" class="btn btn-success btn-custom">
        <i class="fa-solid fa-user-plus"></i> Register
    </a>

</div>

</body>
</html>