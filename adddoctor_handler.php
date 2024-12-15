<?php
// Include the database connection file
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $doctor_name = $_POST['doctor_name'];
    $email = $_POST['email'];
    $specialties = $_POST['specialties'];

    // Insert data into the database
    $sql = "INSERT INTO doctors (doctor_name, email, specialties) VALUES ('$doctor_name', '$email', '$specialties')";

    if ($conn->query($sql) === TRUE) {
        header("Location: adddoctors.php?success=Doctor added successfully");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
