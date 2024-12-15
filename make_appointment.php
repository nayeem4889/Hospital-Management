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

// Fetch doctors from the database
$sql = "SELECT * FROM doctors";
$result = $conn->query($sql);

$doctors = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar -->
  <aside class="bg-white w-64 border-r hidden md:block">
    <div class="p-6">
      <!-- Profile Section -->
      <div class="flex items-center mb-6">
        <div class="ml-4">
          <h2 class="text-lg font-semibold">Abid</h2>
          <p class="text-sm text-gray-500">abid@gmail.com</p>
        </div>
      </div>
      <!-- Log Out Button -->
      <a href="./LogIn.php"><button class="w-full py-2 px-4 bg-blue-500 text-white rounded-md mb-6">Log out</button></a>
      <!-- Navigation -->
      <nav>
        <ul class="space-y-4">
          <li><a href="./make_appointment.php" class="flex items-center p-2 rounded-md hover:bg-gray-100 bg-blue-200"><span class="ml-2">🏠 Home</span></a></li>
          <li><a href="./add_doctors.php" class="flex items-center p-2 rounded-md hover:bg-gray-100"><span class="ml-2">👨‍⚕️ All Doctors</span></a></li>
          <li><a href="./shedule.php" class="flex items-center p-2 rounded-md hover:bg-gray-100"><span class="ml-2">📅 Scheduled Sessions</span></a></li>
          <li><a href="./my_booking.php" class="flex items-center p-2 rounded-md hover:bg-gray-100"><span class="ml-2">🗂️ My Bookings</span></a></li>
          <li><a href="" class="flex items-center p-2 rounded-md hover:bg-gray-100"><span class="ml-2">⚙️ Settings</span></a></li>
        </ul>
      </nav>
    </div>
  </aside>


  <!-- Main Content -->
  <main class="flex-1 p-6">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Make Appointment</h1>
      <div class="text-gray-500">Today's Date: <span class="font-medium">2024-02-28</span></div>
    </div>

    <div class="bg-white p-6 rounded-md shadow-md">
      <h2 class="text-lg font-semibold mb-4">Create a New Appointment</h2>
      <form action="submit_appointment.php" method="POST" class="space-y-4">
        <div>
          <label for="doctor" class="block text-sm font-medium text-gray-700 mb-1">Select Doctor</label>
          <select id="doctor" name="doctor" class="w-full border border-gray-300 rounded-md px-4 py-2" required>
            <option value="">-- Select Doctor --</option>
            <?php foreach ($doctors as $doctor) { ?>
                <option value="<?php echo $doctor['id']; ?>"><?php echo $doctor['doctor_name']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div>
          <label for="session" class="block text-sm font-medium text-gray-700 mb-1">Select Session</label>
          <select id="session" name="session" class="w-full border border-gray-300 rounded-md px-4 py-2" required>
            <option value="">-- Select Session --</option>
            <option value="General Consultation">General Consultation</option>
            <option value="Dental Checkup">Dental Checkup</option>
          </select>
        </div>
        <div>
          <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Select Date</label>
          <input type="date" id="date" name="date" class="w-full border border-gray-300 rounded-md px-4 py-2" required>
        </div>
        <div>
          <label for="time" class="block text-sm font-medium text-gray-700 mb-1">Select Time</label>
          <input type="time" id="time" name="time" class="w-full border border-gray-300 rounded-md px-4 py-2" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md">Book Appointment</button>
      </form>
    </div>
  </main>

  <!-- Popup Modal -->
  <!-- Popup code remains unchanged -->
</body>
</html>
