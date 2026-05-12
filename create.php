<?php
session_start();
include 'db.php';

if (!isset($_SESSION['teacher'])) {
    header("Location: log_in.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("
        INSERT INTO students (name, age, email, course, address)
        VALUES (?, ?, ?, ?, ?)
    ");

    if ($stmt->execute([$name, $age, $email, $course, $address])) {
        header("Location: dashboard.php");
        exit();
    } else {
        $message = "Failed to add student!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body{
            margin:0;
            font-family:'Segoe UI',sans-serif;
            background: linear-gradient(135deg, #141e30, #243b55);
            height:100vh;
        }

        .card-box{
            width:460px;
            padding:30px;
            border-radius:18px;
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(15px);
            box-shadow: 0 10px 40px rgba(0,0,0,0.4);
            color:white;
        }

        .title-icon{
            font-size:55px;
            color:#00c6ff;
        }

        .form-control{
            border:none;
            border-radius:10px;
        }

        .form-control:focus{
            box-shadow:0 0 10px #00c6ff;
        }

        .input-group-text{
            background: rgba(255,255,255,0.85);
            border:none;
        }

        .btn-save{
            background: linear-gradient(90deg,#00c6ff,#0072ff);
            border:none;
            color:white;
            font-weight:600;
            border-radius:10px;
            transition:0.3s;
        }

        .btn-save:hover{
            transform:scale(1.03);
            background: linear-gradient(90deg,#ff416c,#ff4b2b);
        }

        .btn-back{
            border-radius:10px;
        }
    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card-box">

        <!-- HEADER -->
        <div class="text-center mb-4">
            <div class="title-icon">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <h3 class="fw-bold">Add Student</h3>
            <p style="opacity:0.8;">Fill student information below</p>
        </div>

        <?php if($message): ?>
            <div class="alert alert-danger text-center">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <form method="POST">

            <!-- NAME -->
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="fa-solid fa-user text-primary"></i>
                </span>
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>

            <!-- AGE -->
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="fa-solid fa-calendar text-primary"></i>
                </span>
                <input type="number" name="age" class="form-control" placeholder="Age" required>
            </div>

            <!-- EMAIL -->
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="fa-solid fa-envelope text-primary"></i>
                </span>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <!-- COURSE -->
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="fa-solid fa-book text-primary"></i>
                </span>
                <input type="text" name="course" class="form-control" placeholder="Course" required>
            </div>

            <!-- ADDRESS -->
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="fa-solid fa-location-dot text-primary"></i>
                </span>
                <textarea name="address" class="form-control" placeholder="Address" required></textarea>
            </div>

            <!-- BUTTONS -->
            <button class="btn btn-save w-100 py-2">
                <i class="fa-solid fa-floppy-disk"></i> Save Student
            </button>

            <a href="dashboard.php" class="btn btn-light w-100 mt-2 btn-back">
                <i class="fa-solid fa-arrow-left"></i> Back
            </a>

        </form>

    </div>

</div>

</body>
</html>