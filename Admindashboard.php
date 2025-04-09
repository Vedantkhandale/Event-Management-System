<?php
session_start();

// Check if admin is logged in, if not redirect to login page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "college_events");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch events with all required fields
$events = $conn->query("SELECT id, event_name, title, event_date, event_description, event_image FROM events");

// Fetch registrations with event names
$registrations = $conn->query("
    SELECT registrations.id, registrations.name, registrations.email, events.event_name 
    FROM registrations 
    JOIN events ON registrations.event_id = events.id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: url('admin-bg.jpg') no-repeat center center/cover;
            font-family: 'Poppins', sans-serif;
        }
        .dashboard-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-logout {
            background: #d9534f;
            color: white;
        }
        .btn-logout:hover {
            background: #c9302c;
        }
        .logo {
            width: 120px;
            display: block;
            margin: 0 auto 20px;
        }
        .event-image {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-4 dashboard-container">
        <img src="./img/images.png" alt="Admin Logo" class="logo">
        <div class="d-flex justify-content-between align-items-center">
            <h2><i class="fas fa-user-shield"></i> Admin Dashboard</h2>
            <a href="logout.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
        <hr>
        
        <h3><i class="fas fa-calendar-alt"></i> Events</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Event Name</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($event = $events->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $event['id'] ?></td>
                        <td><?= $event['event_name'] ?></td>
                        <td><?= $event['title'] ?></td>
                        <td><?= $event['event_date'] ?></td>
                        <td><?= substr($event['event_description'], 0, 50) . '...' ?></td>
                        <td>
                            <img src="uploads/<?= $event['event_image'] ?>" alt="Event Image" class="event-image">
                        </td>
                        <td>
                            <a href="edit_event.php?id=<?= $event['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <a href="delete_event.php?id=<?= $event['id'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h3><i class="fas fa-users"></i> Registrations</h3>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Event</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($reg = $registrations->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $reg['id'] ?></td>
                        <td><?= $reg['name'] ?></td>
                        <td><?= $reg['email'] ?></td>
                        <td><?= $reg['event_name'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
