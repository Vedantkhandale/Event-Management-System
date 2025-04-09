<?php
session_start();
$conn = new mysqli("localhost", "root", "", "college_events");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;
$event_name = "Unknown Event"; // Default name

// ✅ Fetch event name if event_id is valid
if ($event_id > 0) {
    $sql = "SELECT event_name FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
    if ($event) {
        $event_name = $event['event_name'];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = isset($_POST['event_id']) ? intval($_POST['event_id']) : 0;
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    if (empty($name) || empty($email) || empty($phone) || $event_id == 0) {
        echo "<script>alert('All fields are required!'); window.history.back();</script>";
        exit();
    }

    // ✅ Check if user already registered
    $check_sql = "SELECT id FROM registrations WHERE email = ? AND event_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("si", $email, $event_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "<script>alert('You are already registered for this event!'); window.location.href='events.php';</script>";
        exit();
    }

    // ✅ Insert registration
    $sql = "INSERT INTO registrations (event_id, name, email, phone) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $event_id, $name, $email, $phone);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='thankyou.php';</script>";
    } else {
        echo "<script>alert('Registration failed! Please try again.'); window.history.back();</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event | Raisoni College</title>
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

        .register-container {
            max-width: 520px;
            padding: 45px;
            background: rgba(255, 255, 255, 0.90);
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            backdrop-filter: blur(8px);
            text-align: left;
            color: black;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo {
            width: 100px;
            display: block;
            margin: 0 auto 20px;
            animation: bounce 1.5s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        h3 {
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            color: #222;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid #ccc;
            color: #333;
            font-size: 1rem;
            padding: 14px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
        }

        .form-control:focus {
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 1);
            color: black;
        }

        .btn-register {
            background: #ff4b5c;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            transition: background 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        .btn-register:hover {
            background: #e63950;
            transform: scale(1.05);
            box-shadow: 0px 5px 15px rgba(255, 75, 92, 0.4);
        }
    </style>
</head>

<body>

    <div class="register-container">
        <img src="./img/images.png" alt="Raisoni Logo" class="logo">
        <h3><i class="fas fa-calendar-check"></i> Register for: <?php echo htmlspecialchars($event_name); ?></h3>
        <form action="register.php" method="POST">
            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
            <div class="mb-3">
                <label><i class="fas fa-user"></i> Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label><i class="fas fa-envelope"></i> Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label><i class="fas fa-phone"></i> Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
            <button type="submit" class="btn-register"><i class="fas fa-paper-plane"></i> Register Now</button>
        </form>
    </div>

</body>

</html>
