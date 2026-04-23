<?php
session_start();
include 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM teachers WHERE username=? AND password=?");
    $stmt->execute([$username, $password]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['teacher'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
    body {
        background: linear-gradient(135deg, #667eea, #764ba2);
        height: 100vh;
        color: white;
    }

    .login-card {
        backdrop-filter: blur(15px);
        background: rgba(255, 255, 255, 0.15);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    }

    .form-control {
        border-radius: 10px;
        border: none;
    }

    .form-control:focus {
        box-shadow: 0 0 5px #a29bfe;
    }

    .input-group-text {
        border-radius: 10px 0 0 10px;
        background: rgba(255,255,255,0.3);
        color: white;
        border: none;
    }

    .btn-custom {
        border-radius: 10px;
        background: linear-gradient(to right, #ff7e5f, #feb47b);
        color: white;
        font-weight: bold;
        transition: 0.3s;
        border: none;
    }

    .btn-custom:hover {
        background: linear-gradient(to right, #ff6a4d, #fda763);
        transform: scale(1.02);
    }

    .title-icon {
        font-size: 35px;
        margin-bottom: 10px;
        color: #ffd369;
    }

    .toggle-password {
        cursor: pointer;
        background: rgba(255,255,255,0.3);
        border: none;
        color: white;
    }

    .alert {
        border-radius: 10px;
    }
</style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center vh-100">

    <div class="login-card" style="width: 350px;">

        <div class="text-center">
            <div class="title-icon">
                <i class="fa-solid fa-user-lock"></i>
            </div>
            <h3>Teacher Login</h3>
        </div>

        <?php if($error): ?>
            <div class="alert alert-danger text-center mt-3"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" class="mt-3">

            <!-- Username -->
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="fa-solid fa-user"></i>
                </span>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>

            <!-- Password -->
            <div class="input-group mb-3">
                <span class="input-group-text">
                    <i class="fa-solid fa-lock"></i>
                </span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

                <!-- Show/Hide -->
                <span class="input-group-text toggle-password" onclick="togglePassword()">
                    <i class="fa-solid fa-eye" id="eyeIcon"></i>
                </span>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn btn-custom w-100">
                <i class="fa-solid fa-right-to-bracket"></i> Login
            </button>

        </form>

    </div>

</div>

<script>
function togglePassword() {
    let pass = document.getElementById("password");
    let icon = document.getElementById("eyeIcon");

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