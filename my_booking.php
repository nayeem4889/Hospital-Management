<?php
// Database connection
$servername = "localhost";
$username = "root"; // Replace with your DB username
$password = "";     // Replace with your DB password
$dbname = "hospitalmanagement"; // Replace with your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM appointments WHERE id = $id";
    if ($conn->query($sql) !== TRUE) {
        $error = "Error: " . $conn->error;
    }
}

// Handle edit form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];
    $doctor_id = $_POST['doctors_id'];
    $session = $_POST['session'];
    $appointment_time = $_POST['appointment_time'];

    $sql = "UPDATE appointments SET doctors_id = '$doctor_id', session = '$session', appointment_time = '$appointment_time' WHERE id = $id";
    if ($conn->query($sql) !== TRUE) {
        $error = "Error: " . $conn->error;
    }
}

// Fetch appointments for a specific date
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$sql = "SELECT * FROM appointments WHERE appointment_date = '$date'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments by Date</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function toggleEditModal(id, doctorId, session, email, time) {
            const modal = document.getElementById('editModal');
            modal.classList.toggle('hidden');

            document.getElementById('edit_id').value = id;
            document.getElementById('doctors_id').value = doctorId;
            document.getElementById('session').value = session;
            document.getElementById('appointment_time').value = time;
        }
    </script>
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
          <li class="mb-4">
                <a href="./make_appointment.php" class="flex items-center p-2 rounded-md hover:bg-gray-100" >
                    <span class="ml-2">🏠 Home</span>
                </a>
            </li>
            <li class="mb-4">
                <a href="./add_doctors.php" class="flex items-center p-2 rounded-md hover:bg-gray-100">
                    <span class="ml-2">👨‍⚕️ All Doctors</span>
                </a>
            </li>
            <li class="mb-4">
                <a href="./shedule.php" class="flex items-center p-2 rounded-md hover:bg-gray-100">
                    <span class="ml-2">📅 Scheduled Sessions</span>
                </a>
            </li>
            <li class="mb-4">
                <a href="./my_booking.php" class="flex items-center p-2 rounded-md hover:bg-gray-100 bg-blue-200">
                    <span class="ml-2">🗂️ My Bookings</span>
                </a>
            </li>
            <li class="mb-4">
                <a href="" class="flex items-center p-2 rounded-md hover:bg-gray-100">
                    <span class="ml-2">⚙️ Settings</span>
                </a>
            </li>
        </ul>
      </nav>
    </div>
  </aside>

    <!-- Main Content -->
    <div class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-4">My Bookings</h1>

        <!-- Date Picker -->
        <form method="GET" class="mb-4">
            <label for="date" class="block text-sm font-medium text-gray-700">Select Date:</label>
            <input type="date" id="date" name="date" value="<?= htmlspecialchars($date) ?>" class="border rounded-md p-2">
            <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md">Filter</button>
        </form>

        <!-- Appointments Table -->
        <div class="bg-white p-6 rounded-md shadow-md">
            <h2 class="text-lg font-semibold mb-4">Appointments for <?= htmlspecialchars($date) ?></h2>
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2 text-left">Doctor ID</th>
                        <th class="border px-4 py-2 text-left">Session</th>
                        <th class="border px-4 py-2 text-left">Time</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="border px-4 py-2"><?= htmlspecialchars($row['doctors_id']) ?></td>
                                <td class="border px-4 py-2"><?= htmlspecialchars($row['session']) ?></td>
                                <td class="border px-4 py-2"><?= htmlspecialchars($row['appointment_time']) ?></td>
                                <td class="border px-4 py-2">
                                    
                                    <a href="?date=<?= htmlspecialchars($date) ?>&delete=<?= $row['id'] ?>" class="px-2 py-1 bg-red-500 text-white rounded">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="border px-4 py-2 text-center">No appointments found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-md shadow-md w-full max-w-lg">
            <h3 class="text-xl font-semibold mb-4">Edit Appointment</h3>
            <form method="POST">
                <input type="hidden" id="edit_id" name="edit_id">

                <div class="mb-4">
                    <label for="doctor_id" class="block text-sm font-medium text-gray-700">Doctor ID</label>
                    <input type="text" id="doctor_id" name="doctor_id" required class="w-full p-2 border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="session" class="block text-sm font-medium text-gray-700">Session</label>
                    <input type="text" id="session" name="session" required class="w-full p-2 border rounded-md">
                </div>

                <div class="mb-4">
                    <label for="appointment_time" class="block text-sm font-medium text-gray-700">Time</label>
                    <input type="time" id="appointment_time" name="appointment_time" required class="w-full p-2 border rounded-md">
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="toggleEditModal()" class="px-4 py-2 bg-gray-300 rounded-md">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>
