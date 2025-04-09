<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raisoni - Events</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    
    <style>
        .gallery-img {
            height: 250px;
            object-fit: cover;
            width: 100%;
            border-radius: 10px;
        }

        .gallery-item {
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .event-slide-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        .welcome-box {
            background: url('./img/background01.jpeg') no-repeat center center/cover;
            padding: 100px 20px;
            border-radius: 15px;
            color: white;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8);
            position: relative;
            overflow: hidden;
        }

        .welcome-box::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .welcome-box h2,
        .welcome-box p,
        .welcome-box a {
            position: relative;
            z-index: 2;
        }
    </style>
</head>

<body>
    <header class="bg-dark text-white p-3 d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <img src="./img/images.png" alt="Raisoni College Logo" class="navbar-logo me-3" style="height: 60px;">
            
        </div>
        <nav>
            <ul class="navbar-nav d-flex flex-row gap-3">
                <li class="nav-item"><a href="index.php" class="nav-link text-white"><i class="fas fa-home"></i> Home</a></li>
                <li class="nav-item"><a href="events.php" class="nav-link text-white"><i class="fas fa-calendar-alt"></i> Events</a></li>
                <li class="nav-item"><a href="dashboard.php" class="nav-link text-white"><i class="fas fa-user"></i> Dashboard</a></li>
                <li class="nav-item"><a href="login.php" class="btn btn-warning text-dark"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <li class="nav-item"><a href="signup.php" class="btn btn-primary text-white"><i class="fas fa-user-plus"></i> Sign Up</a></li>
            </ul>
        </nav>
    </header>

    <section class="container my-5 text-center">
        <div class="welcome-box">
            <h2>Welcome to Raisoni Events</h2>
            <p>Join us for an amazing event full of fun, learning, and excitement!</p>
            <a href="events.php" class="btn btn-primary mt-3">View Events</a>
        </div>
    </section>

    <!-- Event Highlights Slider -->
    <section class="container my-5">
        <h2 class="text-center mb-4">🎭 Event Highlights 🎭</h2>
        <div id="eventSlider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="./img/CulturalEvent.jpg" class="d-block w-100 event-slide-img" alt="Cultural Event">
                </div>
                <div class="carousel-item">
                    <img src="./img/TechEvent.jpg" class="d-block w-100 event-slide-img" alt="Technical Event">
                </div>
                <div class="carousel-item">
                    <img src="./img/sports.jpeg" class="d-block w-100 event-slide-img" alt="Sports Event">
                </div>
                <div class="carousel-item">
                    <img src="./img/Techono.jpeg" class="d-block w-100 event-slide-img" alt="Tech Fest">
                </div>
                <div class="carousel-item">
                    <img src="./img/indian.jpeg" class="d-block w-100 event-slide-img" alt="Indian Fest">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#eventSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#eventSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- Event galllaryy -->
         <!-- Event Gallery -->
<section class="container my-5">
    <h2 class="text-center mb-4">🎉 Event Gallery 🎉</h2>
    <div class="row g-4">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="gallery-item">
                <img src="./img/CulturalEvent.jpg" class="img-fluid rounded shadow gallery-img" alt="Cultural Event">
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="gallery-item">
                <img src="./img/TechEvent.jpg" class="img-fluid rounded shadow gallery-img" alt="Technical Event">
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="gallery-item">
                <img src="./img/sports.jpeg" class="img-fluid rounded shadow gallery-img" alt="Sports Event">
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="gallery-item">
                <img src="./img/Techono.jpeg" class="img-fluid rounded shadow gallery-img" alt="Fest Event">
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="gallery-item">
                <img src="./img/indian.jpeg" class="img-fluid rounded shadow gallery-img" alt="Workshop Event">
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="gallery-item">
                <img src="./img/india.jpeg" class="img-fluid rounded shadow gallery-img" alt="Dance Event">
            </div>
        </div>
    </div>
</section>
  <!-- Footer Section -->
  <footer class="footer text-white text-center p-4 bg-dark">
        <div class="container">
            <img src="./img/images.png" alt="Raisoni College Logo" class="footer-logo mb-3" style="height: 80px;">
            <p class="fw-bold">GH Raisoni College of Arts, Commerce & Science</p>
            <p><i class="fas fa-map-marker-alt"></i> Mangalwari Complex Sadar, Nagpur, India</p>
            <p><i class="fas fa-phone"></i> +91 9876543210</p>
            <p><i class="fas fa-envelope"></i> info@Ghrcacs.edu.in</p>
            <div class="footer-icons mt-3">
                <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                <a href="https://x.com/raisoniworld/status/1762696628400505230" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/raisoni.com/#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/school/raisoniworld/posts/?feedView=all" class="text-white"><i class="fab fa-linkedin"></i></a>
            </div>
            <p class="mt-3">&copy; 2025 GHRCACS. All Rights Reserved.
               <h4> &#128526; Developed By Vedant ..</h4>
            </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>
</html>
