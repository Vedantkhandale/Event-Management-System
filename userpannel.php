CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user'
);

<?php // db.php
$servername = "localhost";
$username = "root";
$password = "";
$database = "college_event";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php // signup.php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = "user";

    $sql = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $password, $role);
    $stmt->execute();
    header("Location: login.php");
}
?>

<?php // login.php
session_start();
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_role"] = $user["role"];
        if ($user["role"] == "admin") {
            header("Location: admin_panel/dashboard.php");
        } else {
            header("Location: user_panel/dashboard.php");
        }
    } else {
        echo "Invalid credentials!";
    }
}
?>

<?php // admin_panel/dashboard.php
session_start();
if (!isset($_SESSION["user_role"]) || $_SESSION["user_role"] != "admin") {
    header("Location: ../login.php");
    exit();
}
?>
<h2>Admin Dashboard</h2>
<a href="logout.php">Logout</a>

<?php // user_panel/dashboard.php
session_start();
if (!isset($_SESSION["user_role"]) || $_SESSION["user_role"] != "user") {
    header("Location: ../login.php");
    exit();
}
?>
<h2>User Dashboard</h2>
<a href="logout.php">Logout</a>

<?php // logout.php
session_start();
session_destroy();
header("Location: login.php");
?>
