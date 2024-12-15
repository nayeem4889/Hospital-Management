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

// Delete session
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM sessions WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: My_sessions.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
