<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .form-container {
            max-width: 400px;
            margin: auto;
            padding: 30px;
            background: white;
            color: #4A148C;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        .form-container h2 {
            margin-bottom: 20px;
            font-weight: 600;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #6A1B9A;
        }
        .form-container button {
            width: 100%;
            padding: 12px;
            background: #6A1B9A;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }
        .form-container button:hover {
            background: #4A148C;
            transform: scale(1.05);
        }
        .logo {
            display: block;
            margin: 0 auto 10px; /* Space below the logo */
            height: 80px;
        }
        .signup-link {
            margin-top: 15px;
            display: block;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <section class="container my-5 text-center">
        <div class="form-container">
            <img src="./img/images01.png" alt="College Logo" class="logo"> <!-- Logo yaha aayega -->
            <h2>Login to Your Account</h2>
            <form id="loginForm">
                <input type="email" id="loginEmail" placeholder="Email" required>
                <input type="password" id="loginPassword" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
            <a href="signup.html" class="signup-link">Don't have an account? Sign up</a>
        </div>
    </section>

    <script>
        document.getElementById("loginForm").addEventListener("submit", function(e) {
            e.preventDefault();
            
            let email = document.getElementById("loginEmail").value.trim();
            let password = document.getElementById("loginPassword").value.trim();

            if (email === "" || password === "") {
                alert("Please fill in all fields!");
                return;
            }

            alert("Login successful! Welcome ...");
            window.location.href = "index.php"; // Redirect to dashboard
        });
        <!-- AJax -->
$.ajax({
    type: "POST",
    url: "signup.php",
    data: { 
        name: name, 
        email: email, 
        password: password 
    },
    dataType: "json",
    success: function(response) {
        if (response.status === "success") {
            $("#message").html("<span style='color:green;'>" + response.message + "</span>");
            setTimeout(() => window.location.href = "login.php", 2000);
        } else {
            $("#message").html("<span style='color:red;'>" + response.message + "</span>");
        }
    },
    error: function(xhr, status, error) {
        console.error(xhr.responseText); // Error debugging
    }
});

    </script>

<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid Email or Password!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Login</h2>
    <form method="post">
        <input type="email" name="email" class="form-control" placeholder="Email" required><br>
        <input type="password" name="password" class="form-control" placeholder="Password" required><br>
        <button type="submit" class="btn btn-warning">Login</button>
    </form>
    <p>Don't have an account? <a href="signup.php">Signup here</a></p>
</div>


</body>
</html>


</body>
</html>
