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
    if ($conn->query($sql) === TRUE) {
        $message = "Appointment deleted successfully";
    } else {
        $error = "Error deleting appointment: " . $conn->error;
    }
}

// Handle update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];
    $appointment_time = $_POST['appointment_time'];
    $appointment_date = $_POST['appointment_date'];

    $sql = "UPDATE appointments SET appointment_time = '$appointment_time', appointment_date = '$appointment_date' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        $message = "Appointment updated successfully";
    } else {
        $error = "Error updating appointment: " . $conn->error;
    }
}

// Fetch appointments from the database
$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Appointments</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function editAppointment(id, time, date) {
            document.getElementById('edit_id').value = id;
            document.getElementById('appointment_time').value = time;
            document.getElementById('appointment_date').value = date;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
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
          <li><a href="./make_appointment.php" class="flex items-center p-2 rounded-md hover:bg-gray-100"><span class="ml-2">🏠 Home</span></a></li>
          <li><a href="./add_doctors.php" class="flex items-center p-2 rounded-md hover:bg-gray-100"><span class="ml-2">👨‍⚕️ All Doctors</span></a></li>
          <li><a href="./shedule.php" class="flex items-center p-2 rounded-md hover:bg-gray-100 bg-blue-200"><span class="ml-2">📅 Scheduled Sessions</span></a></li>
          <li><a href="./my_booking.php" class="flex items-center p-2 rounded-md hover:bg-gray-100"><span class="ml-2">🗂️ My Bookings</span></a></li>
          <li><a href="" class="flex items-center p-2 rounded-md hover:bg-gray-100"><span class="ml-2">⚙️ Settings</span></a></li>
        </ul>
      </nav>
    </div>
  </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">My Appointments</h1>
            <div class="text-gray-500">Today's Date: <span class="font-medium"><?= date('Y-m-d'); ?></span></div>
        </div>

        <?php if (isset($message)): ?>
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                <?= htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="bg-white p-6 rounded-md shadow-md">
            <h2 class="text-lg font-semibold mb-4">Appointments List</h2>
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300 bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">ID</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Appointment Time</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Appointment Date</th>
                            <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='hover:bg-gray-50'>
                                    <td class='border border-gray-300 px-4 py-2 text-gray-700'>{$row['id']}</td>
                                    <td class='border border-gray-300 px-4 py-2 text-gray-700'>{$row['appointment_time']}</td>
                                    <td class='border border-gray-300 px-4 py-2 text-gray-700'>{$row['appointment_date']}</td>
                                    <td class='border border-gray-300 px-4 py-2 text-gray-700'>
                                        <button class='px-2 py-1 bg-yellow-500 text-white rounded' onclick=\"editAppointment('{$row['id']}', '{$row['appointment_time']}', '{$row['appointment_date']}')\">Edit</button>
                                        <a href='?delete={$row['id']}' class='px-2 py-1 bg-red-500 text-white rounded'>Delete</a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr>
                                <td colspan='4' class='border border-gray-300 px-4 py-2 text-center text-gray-700'>No appointments found</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Edit Appointment Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white w-full max-w-lg rounded-lg shadow-md p-6">
            <h3 class="text-xl font-semibold mb-4">Edit Appointment</h3>
            <form action="" method="POST">
                <input type="hidden" id="edit_id" name="edit_id">

                <div class="mb-4">
                    <label for="appointment_time" class="block text-sm font-medium text-gray-700">Appointment Time</label>
                    <input type="text" id="appointment_time" name="appointment_time" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="mb-4">
                    <label for="appointment_date" class="block text-sm font-medium text-gray-700">Appointment Date</label>
                    <input type="date" id="appointment_date" name="appointment_date" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 rounded-md">Cancel</button>
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