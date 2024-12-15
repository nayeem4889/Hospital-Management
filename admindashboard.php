<?php
// Mock data for the admin dashboard
$admin = [
    'name' => 'Administrator',
    'email' => 'admin@edoc.com',
];

$dashboard_stats = [
    'doctors' => 1,
    'patients' => 3,
    'new_bookings' => 0,
    'today_sessions' => 0,
];

$current_date = date('Y-m-d');

// HTML starts here
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Main Container -->
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
      <div class="p-4">
        <!-- User Info -->
        <div class="flex items-center gap-3 mb-6">
          <div class="h-12 w-12 bg-gray-300 rounded-full"></div>
          <div>
            <h2 class="text-lg font-medium"><?php echo htmlspecialchars($admin['name']); ?></h2>
            <p class="text-sm text-gray-500"><?php echo htmlspecialchars($admin['email']); ?></p>
          </div>
        </div>
        <!-- Logout Button -->
        <button class="mt-8 w-full px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded">
          Log out
        </button>

        <!-- Navigation Links -->
        <nav>
          <ul class="space-y-4 pt-4">
            <li>
              <a href="./admindashboard.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2 bg-blue-200">
                <span class="ml-3">🏠 Dashboard</span> 
              </a>
            </li>
            <li>
              <a href="./add_doctors.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                <span class="ml-3">👨‍⚕️ Doctors</span> 
              </a>
            </li>
            <li>
              <a href="./shedule.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                <span class="ml-3">🗂️ Schedule</span> 
              </a>
            </li>
            <li>
              <a href="./adminappointment.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                <span class="ml-3">📅 Appointment</span> 
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                <span class="ml-3">⚙️ Settings</span> 
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
        <div class="flex items-center space-x-2">
          <form method="GET" action="">
            <input type="text" placeholder="Search Doctor name or Email" name="search" class="border-gray-300 border rounded p-2 text-gray-600 w-64">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Search</button>
          </form>
        </div>
        <div class="text-gray-600">
          <span>Today's Date: </span>
          <span class="font-medium"><?php echo $current_date; ?></span>
        </div>
      </div>

      <!-- Status Cards -->
      <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 shadow rounded-lg text-center">
          <h3 class="text-lg font-medium text-gray-600">Doctors</h3>
          <p class="text-2xl font-bold text-blue-500"><?php echo $dashboard_stats['doctors']; ?></p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg text-center">
          <h3 class="text-lg font-medium text-gray-600">Patients</h3>
          <p class="text-2xl font-bold text-blue-500"><?php echo $dashboard_stats['patients']; ?></p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg text-center">
          <h3 class="text-lg font-medium text-gray-600">New Booking</h3>
          <p class="text-2xl font-bold text-blue-500"><?php echo $dashboard_stats['new_bookings']; ?></p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg text-center">
          <h3 class="text-lg font-medium text-gray-600">Today Sessions</h3>
          <p class="text-2xl font-bold text-blue-500"><?php echo $dashboard_stats['today_sessions']; ?></p>
        </div>
      </div>

      <!-- Upcoming Appointments and Sessions -->
      <div class="grid grid-cols-2 gap-6">
        <!-- Appointments Section -->
        <div class="bg-white p-4 shadow rounded-lg">
          <h2 class="text-lg font-semibold text-gray-700 mb-4">Upcoming Appointments until Next Wednesday</h2>
          <p class="text-sm text-gray-600 mb-6">
            Here's Quick access to Upcoming Appointments until 7 days.
            More details available in <strong>@Appointment</strong> section.
          </p>
          <div class="border-t pt-4">
            <div class="flex justify-center items-center">
              <img src="https://via.placeholder.com/150" alt="Placeholder" class="w-16 h-16">
            </div>
          </div>
          <div class="mt-4 text-center">
            <a href="./adminappointment.php"><button class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Show all Appointments</button></a>
          </div>
        </div>

        <!-- Sessions Section -->
        <div class="bg-white p-4 shadow rounded-lg">
          <h2 class="text-lg font-semibold text-gray-700 mb-4">Upcoming Sessions until Next Wednesday</h2>
          <p class="text-sm text-gray-600 mb-6">
            Here's Quick access to Upcoming Sessions that Scheduled until 7 days.
            Add, Remove and Many features available in <strong>@Schedule</strong> section.
          </p>
          <div class="border-t pt-4">
            <div class="flex justify-center items-center">
              <img src="https://via.placeholder.com/150" alt="Placeholder" class="w-16 h-16">
            </div>
          </div>
          <div class="mt-4 text-center">
            <a href="./shedule.php"><button class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Show all Sessions</button></a>
          </div>
        </div>
      </div>
    </main>
  </div>
</body>
</html>
