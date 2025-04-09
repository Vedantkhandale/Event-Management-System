<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Events | Explore & Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            font-family: 'Poppins', sans-serif;
            color: white;
        }

        /* Animated Header */
        .header {
            background: rgba(0, 0, 0, 0.7);
            padding: 25px;
            text-align: center;
            font-size: 2rem;
            font-weight: bold;
            color: white;
            text-shadow: 2px 2px 20px rgba(255, 255, 255, 0.3);
            animation: fadeIn 1.2s ease-in-out;
        }

        /* Event Card Styling */
        .event-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.3);
            transition: transform 0.4s ease-in-out, box-shadow 0.4s ease-in-out;
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0px 12px 30px rgba(0, 0, 0, 0.5);
        }

        .event-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-bottom: 5px solid #ff4b5c;
        }

        .event-details {
            padding: 25px;
            text-align: center;
        }

        .event-title {
            font-size: 1.6rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }

        .event-date {
            color: #ff4b5c;
            font-size: 1.1rem;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .event-description {
            font-size: 1rem;
            color: #555;
            height: 60px;
            overflow: hidden;
        }

        /* Register Button */
        .btn-register {
            background: #ff4b5c;
            color: white;
            font-size: 1.1rem;
            font-weight: bold;
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            display: block;
            margin-top: 15px;
            text-decoration: none;
            transition: background 0.3s ease-in-out, transform 0.2s ease-in-out;
        }

        .btn-register:hover {
            background: #e63950;
            transform: scale(1.05);
            box-shadow: 0px 8px 20px rgba(255, 75, 92, 0.4);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

    </style>
</head>

<body>

    <header class="header">
        <i class="fas fa-calendar-alt"></i> Upcoming College Events
    </header>

    <div class="container mt-4">
        <div class="row">
            <?php
            // Database Connection
            $conn = new mysqli("localhost", "root", "", "college_events");

            // Connection Error Handling
            if ($conn->connect_error) {
                die("<div class='alert alert-danger text-center'>Connection failed: " . $conn->connect_error . "</div>");
            }

            // Fetch Events
            $sql = "SELECT id, event_name, event_date, event_description, event_image FROM events ORDER BY event_date DESC";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-md-4 mb-4">
                        <div class="event-card">
                            <?php if (!empty($row['event_image'])) { ?>
                                <img src="uploads/<?php echo htmlspecialchars($row['event_image']); ?>" class="event-img" alt="Event Image">
                            <?php } else { ?>
                                <img src="uploads/default.jpg" class="event-img" alt="Default Event Image">
                            <?php } ?>
                            <div class="event-details">
                                <h5 class="event-title"><i class="fas fa-microphone"></i> <?php echo htmlspecialchars($row['event_name']); ?></h5>
                                <p class="event-date"><i class="fas fa-calendar-day"></i> <?php echo htmlspecialchars($row['event_date']); ?></p>
                                <p class="event-description"><?php echo nl2br(htmlspecialchars($row['event_description'])); ?></p>
                                <a href="register.php?event_id=<?php echo $row['id']; ?>" class="btn-register">
                                    <i class="fas fa-user-plus"></i> Register Now
                                </a>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>
                <div class="col-12 text-center">
                    <p class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> No events found!</p>
                </div>
            <?php }
            ?>
        </div>
    </div>

</body>
</html>
