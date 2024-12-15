<?php
// Include the database connection
include('db_connection.php');

// Query to fetch appointments and corresponding doctor names using prepared statements
$query = "
    SELECT 
      m.doctor_id, 
      d.doctor_name, 
      m.appointment_time, 
      m.appointment_date 
    FROM make_appointment m 
    INNER JOIN add_doctors d ON m.doctor_id = d.id
";

// Prepare the statement
$stmt = $conn->prepare($query);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();


// Check for query errors
if (!$result) {
    die("Error in query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Appointments</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar -->
  <aside class="bg-white w-64 border-r hidden md:block">
    <div class="p-6">
      <!-- Profile Section -->
      <div class="flex items-center mb-6">
        <div class="ml-4">
          <h2 class="text-lg font-semibold">Md Kazi Musfiqur</h2>
          <p class="text-sm text-gray-500">musfiqrohoman1@gmail.com</p>
        </div>
      </div>
      <!-- Navigation -->
      <nav>
        <ul class="space-y-4">
          <li>
            <a href="#" class="flex items-center p-2 rounded-md hover:bg-gray-100 bg-blue-200">
              <span class="ml-2">🏠 Home</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-2 rounded-md hover:bg-gray-100">
              <span class="ml-2">👨‍⚕️ All Doctors</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-2 rounded-md hover:bg-gray-100">
              <span class="ml-2">📅 Scheduled Sessions</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-2 rounded-md hover:bg-gray-100">
              <span class="ml-2">🗂️ My Bookings</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">My Appointments</h1>
      <div class="text-gray-500">Today's Date: <span class="font-medium">2024-02-28</span></div>
    </div>

    <!-- Appointments Table -->
    <div class="bg-white p-6 rounded-md shadow-md">
      <h2 class="text-lg font-semibold mb-4">Appointments List</h2>
      <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300 bg-white">
          <thead class="bg-gray-100">
            <tr>
              <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Doctor ID</th>
              <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Doctor Name</th>
              <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Appointment Time</th>
              <th class="border border-gray-300 px-4 py-2 text-left text-gray-600 font-medium">Appointment Date</th>
            </tr>
          </thead>
          <tbody>
            <!-- Fetching and displaying data from the result -->
            <?php if ($result->num_rows > 0): ?>
              <?php while ($row = $result->fetch_assoc()): ?>
                <tr class="hover:bg-gray-50">
                  <td class="border border-gray-300 px-4 py-2 text-gray-700"><?php echo $row['doctor_id']; ?></td>
                  <td class="border border-gray-300 px-4 py-2 text-gray-700"><?php echo $row['doctor_name']; ?></td>
                  <td class="border border-gray-300 px-4 py-2 text-gray-700"><?php echo $row['appointment_time']; ?></td>
                  <td class="border border-gray-300 px-4 py-2 text-gray-700"><?php echo $row['appointment_date']; ?></td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="border border-gray-300 px-4 py-2 text-gray-700 text-center">No appointments found</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <?php
    // Close the database connection
    $conn->close();
  ?>
</body>
</html>
