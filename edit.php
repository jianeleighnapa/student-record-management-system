<?php
session_start();
include 'db.php';

if (!isset($_SESSION['teacher'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $stmt = $pdo->prepare("UPDATE students SET name=?, age=?, email=?, course=?, address=? WHERE id=?");

    $stmt->execute([
         $_POST['name'],
        $_POST['age'],
        $_POST['email'],
        $_POST['course'],
        $_POST['address'],
        $id
    ]);

    header("Location: dashboard.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM students WHERE id=?");
$stmt->execute([$id]);
$row = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="card shadow p-4" style="width: 400px;">

        <h3 class="text-center mb-3">Edit Student</h3>

        <form method="POST">

        
            <input type="text" name="name" class="form-control mb-3"
                value="<?= $row['name'] ?>" placeholder="Name" required>

            <input type="number" name="age" class="form-control mb-3"
                value="<?= $row['age'] ?>" placeholder="Age" required>

            <input type="email" name="email" class="form-control mb-3"
                value="<?= $row['email'] ?>" placeholder="Email" required>

            <input type="text" name="course" class="form-control mb-3"
                value="<?= $row['course'] ?>" placeholder="Course" required>

            <input type="text" name="address" class="form-control mb-3"
                value="<?= $row['address'] ?>" placeholder="Address" required>

            <button type="submit" class="btn btn-warning w-100">Update</button>

            <a href="dashboard.php" class="btn btn-secondary w-100 mt-2">Back</a>

        </form>

    </div>

</div>

</body>
</html>