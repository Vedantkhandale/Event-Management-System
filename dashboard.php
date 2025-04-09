<?php
session_start();

// Hardcoded admin credentials
$admin_username = "admin";
$admin_password = "123456";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: Admindashboard.php");
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('./img/background.jpg') no-repeat center center/cover;
            font-family: 'Poppins', sans-serif;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }
        .login-container {
            background: rgba(255, 255, 255, 0.2);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 2;
        }
        .btn-login {
            background: #6A1B9A;
            color: white;
            transition: 0.3s;
        }
        .btn-login:hover {
            background: #4A148C;
        }
        .logo {
            width: 80px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="overlay"></div>
    <div class="login-container">
        <img src="./img/images.png" alt="Admin Logo" class="logo">  
        <h3 class="mb-3 text-white">Admin Login</h3>
        <?php if (isset($error)) echo "<p class='text-danger'>$error</p>"; ?>   
        <form method="POST">
            <div class="mb-3 text-start">
                <label class="form-label text-white">Username</label>
                <input type="text" name="username" class="form-control" required placeholder="Enter Username">
            </div>
            <div class="mb-3 text-start">
                <label class="form-label text-white">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Enter Password">
            </div>
            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>
    </div>
</body>
</html>
