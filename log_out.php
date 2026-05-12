<?php
session_start();

// clear session
$_SESSION = [];
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logged Out</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-box {
            background: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            width: 350px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .icon {
            font-size: 60px;
            color: #28a745;
            margin-bottom: 15px;
        }

        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="card-box">

    <div class="icon">
        <i class="fa-solid fa-right-from-bracket"></i>
    </div>

    <h3>You have been logged out</h3>
    <p class="text-muted">Thank you for using the system</p>

    <a href="log_in.php" class="btn btn-primary btn-custom">
        <i class="fa-solid fa-right-to-bracket"></i> Login Again
    </a>

    <a href="index.php" class="btn btn-secondary btn-custom">
        <i class="fa-solid fa-house"></i> Go Home
    </a>

</div>

</body>
</html>