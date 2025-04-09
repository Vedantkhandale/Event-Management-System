<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = "user"; // Default role

    $query = "INSERT INTO college_events (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    
    if (mysqli_query($conn, $query)) {
        echo json_encode(["status" => "success", "message" => "Signup successful! Now Login."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . mysqli_error($conn)]);
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
            margin: 0 auto 10px;
            height: 80px;
        }
        .message {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <section class="container my-5 text-center">
        <div class="form-container">
            <img src="./img/images01.png" alt="College Logo" class="logo">
            <h2>Create an Account</h2>
            <div id="message" class="message"></div>
            <form id="signupForm">
                <input type="text" id="signupName" placeholder="Full Name" required>
                <input type="email" id="signupEmail" placeholder="Email" required>
                <input type="password" id="signupPassword" placeholder="Password" required>
                <button type="submit">Sign Up</button>
            </form>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $("#signupForm").on("submit", function(e) {
            e.preventDefault();
            let name = $("#signupName").val().trim();
            let email = $("#signupEmail").val().trim();
            let password = $("#signupPassword").val().trim();

            if (name === "" || email === "" || password === "") {
                $("#message").html("<span style='color:red;'>Please fill in all fields!</span>");
                return;
            }

            $.ajax({
                type: "POST",
                url: "signup.php",
                data: { name: name, email: email, password: password },
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        $("#message").html("<span style='color:green;'>" + response.message + "</span>");
                        setTimeout(() => window.location.href = "login.php", 2000);
                    } else {
                        $("#message").html("<span style='color:red;'>" + response.message + "</span>");
                    }
                }
            });
        });
    </script>
</body>
</html>
