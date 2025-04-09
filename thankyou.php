<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You | Raisoni College</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: url('./img/background01.jpeg') no-repeat center center/cover;
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .thankyou-container {
            max-width: 500px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .thankyou-container h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #28a745;
        }

        .thankyou-container p {
            font-size: 1.2rem;
            color: #333;
        }

        .btn-home {
            background: #007bff;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            padding: 12px 25px;
            border-radius: 10px;
            text-decoration: none;
            transition: background 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        .btn-home:hover {
            background: #0056b3;
            transform: scale(1.05);
            box-shadow: 0px 5px 15px rgba(0, 123, 255, 0.4);
        }
    </style>
</head>
<body>
    <div class="thankyou-container">
        <i class="fas fa-check-circle fa-4x text-success"></i>
        <h2>Registration Successful!</h2>
        <p>Thank you for registering. We will notify you with further details soon.</p>
        <a href="index.php" class="btn-home"><i class="fas fa-home"></i> Go to Home</a>
    </div>
</body>
</html>