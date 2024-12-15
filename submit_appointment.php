<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitalmanagement";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$doctor_id = $_POST['doctor'];
$session = $_POST['session'];
$date = $_POST['date'];
$time = $_POST['time'];

// Prepare and bind the statement
$stmt = $conn->prepare("INSERT INTO appointments (doctors_id, session, appointment_date, appointment_time) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $doctor_id, $session, $date, $time);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "Appointment booked successfully.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
