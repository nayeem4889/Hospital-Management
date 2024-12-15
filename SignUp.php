<?php
// Start the session
session_start();

// Database configuration
$host = 'localhost'; // Database host
$dbname = 'hospitalmanagement'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

// Create a connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $fullName = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validate passwords
    if ($password !== $confirmPassword) {
        echo "Passwords do not match!";
        exit();
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "Email is already registered!";
        exit();
    }

    // Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (:full_name, :email, :password)");
    $stmt->bindParam(':full_name', $fullName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);

    if ($stmt->execute()) {
        echo "Signup successful!";
        header("Location: LogIn.php"); // Redirect to the login page
        exit();
    } else {
        echo "Something went wrong. Please try again!";
    }
}
?>
