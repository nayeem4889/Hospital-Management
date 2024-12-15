<?php
include 'db_connection.php'; // Include database connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $session_title = $_POST['session_title'];
    $datetime = $_POST['datetime'];
    $doctor_id = $_POST['doctor_id'];
    $max_bookings = $_POST['max_bookings'];

    // Insert session into the database
    $stmt = $conn->prepare("INSERT INTO sessions (session_title, datetime, doctor_id, max_bookings) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $session_title, $datetime, $doctor_id, $max_bookings);

    if ($stmt->execute()) {
        // Refresh page to show updated data
        header("Location: My_sessions.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Fetch existing sessions
$sessions_query = "SELECT s.id, s.title, s.datetime, s.max_bookings, d.name AS doctor_name 
                   FROM sessions s 
                   JOIN doctors d ON s.doctor_id = d.id";
$sessions_result = $conn->query($sessions_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Sessions</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Toggle modal
    function toggleModal() {
      const modal = document.getElementById('addSessionModal');
      modal.classList.toggle('hidden');
    }

    // Fetch doctors dynamically
    async function loadDoctors() {
      const response = await fetch('doctors.php');
      const doctors = await response.json();
      const doctorSelect = document.getElementById('doctor');
      doctorSelect.innerHTML = ''; // Clear existing options

      // Populate options
      doctors.forEach(doctor => {
        const option = document.createElement('option');
        option.value = doctor.id;
        option.textContent = doctor.name;
        doctorSelect.appendChild(option);
      });
    }

    // Load doctors on page load
    document.addEventListener('DOMContentLoaded', loadDoctors);
  </script>
</head>

<body class="bg-gray-100 font-sans">
  <!-- Main Container -->
  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
      <div class="p-4">
        <div class="flex items-center gap-3 mb-6">
          <div class="h-12 w-12 bg-gray-300 rounded-full"></div>
          <div>
            <h2 class="font-medium">Test Doctor</h2>
            <p class="text-sm text-gray-500">doctor@edoc.com</p>
          </div>
        </div>
        <button class="mt-8 w-full px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded">Log out</button>
        <nav>
          <ul class="space-y-4 pt-4">
            <li><a href="./doctor_dashboard.html" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">?? Dashboard</a></li>
            <li><a href="./My_appointment.html" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">?? My Appointments</a></li>
            <li><a href="./My_sessions.html" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2 bg-blue-200">??? My Sessions</a></li>
            <li><a href="./My_patient.html" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">????? My Patients</a></li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-semibold">My Sessions</h1>
        <button onclick="toggleModal()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Add Session</button>
      </div>

      <!-- Session Table -->
      <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Session Title</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Date & Time</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Doctor</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Max Bookings</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php while ($session = $sessions_result->fetch_assoc()): ?>
            <tr>
              <td class="px-6 py-4"><?= htmlspecialchars($session['title']) ?></td>
              <td class="px-6 py-4"><?= htmlspecialchars($session['datetime']) ?></td>
              <td class="px-6 py-4"><?= htmlspecialchars($session['doctor_name']) ?></td>
              <td class="px-6 py-4"><?= htmlspecialchars($session['max_bookings']) ?></td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
  <!-- Dynamic Doctor Selection -->
<div class="mb-4">
    <label for="doctor" class="block text-sm font-medium text-gray-700">Select Doctor</label>
    <select id="doctor" name="doctor" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
        <?php
        $doctor_sql = "SELECT id, name FROM doctors";
        $doctor_result = $conn->query($doctor_sql);

        if ($doctor_result->num_rows > 0) {
            while ($doctor = $doctor_result->fetch_assoc()) {
                echo "<option value='" . $doctor['id'] . "'>" . htmlspecialchars($doctor['name']) . "</option>";
            }
        }
        ?>
    </select>
</div>


  <!-- Add Session Modal -->
  <div id="addSessionModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white w-full max-w-lg rounded-lg shadow-md p-6">
      <h3 class="text-xl font-semibold mb-4">Add New Session</h3>
      <form method="POST">
        <div class="mb-4">
          <label for="session-title" class="block text-sm font-medium text-gray-700">Session Title</label>
          <input type="text" id="session-title" name="session_title" required class="w-full px-4 py-2 border rounded-md">
        </div>
        <div class="mb-4">
          <label for="datetime" class="block text-sm font-medium text-gray-700">Date & Time</label>
          <input type="datetime-local" id="datetime" name="datetime" required class="w-full px-4 py-2 border rounded-md">
        </div>
        <div class="mb-4">
          <label for="doctor" class="block text-sm font-medium text-gray-700">Select Doctor</label>
          <select id="doctor" name="doctor" required class="w-full px-4 py-2 border rounded-md"></select>
        </div>
        <div class="mb-4">
          <label for="max-bookings" class="block text-sm font-medium text-gray-700">Max Bookings</label>
          <input type="number" id="max-bookings" name="max_bookings" min="1" required class="w-full px-4 py-2 border rounded-md">
        </div>
        <div class="flex justify-end space-x-2">
          <button type="button" onclick="toggleModal()" class="px-4 py-2 bg-gray-300 rounded-md">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
