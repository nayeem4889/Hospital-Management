<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitalmanagement";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add a new session
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['session_title'];
    $datetime = $_POST['datetime'];
    $doctor = $_POST['doctor'];
    $max_bookings = $_POST['max_bookings'];

    $sql = "INSERT INTO sessions (title, datetime, doctor, max_bookings) VALUES ('$title', '$datetime', '$doctor', '$max_bookings')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: My_sessions.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
