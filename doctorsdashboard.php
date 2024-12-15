<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Main container -->
  <div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg">
      <div class="p-4">
        <!-- User Info -->
        <div class="flex items-center gap-3 mb-6">
          <div class="h-12 w-12 bg-gray-300 rounded-full"></div>
          <div>
            <h2 class="font-medium">Test Doctor</h2>
            <p class="text-sm text-gray-500">doctor@doc.com</p>
          </div>
        </div>
        <!-- Log Out Button -->
		<a href="./logout.php">        <button class="w-full py-2 px-4 bg-blue-500 text-white rounded-md mb-6">Log out</button></a>


        <!-- Navigation Links -->
        <nav>
          <ul class="space-y-4">
            <li>
              <a href="./doctor_dashboard.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2 bg-blue-200">
                <span class="ml-3">🏠 Dashboard</span> 
              </a>
            </li>
            <li>
              <a href="./my_appointments.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                <span class="ml-3">📅 My Appointments</span> 
              </a>
            </li>
            <li>
              <a href="./my_sessions.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                <span class="ml-3">🗂️ My Sessions</span> 
              </a>
            </li>
            <li>
              <a href="./my_patients.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                <span class="ml-3">👨‍⚕️ My Patients</span> 
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
        <h1 class="text-2xl font-bold text-gray-700">Dashboard</h1>
        <p class="text-gray-500">Today's Date: <span class="font-medium"><?php echo date('Y-m-d'); ?></span></p>
      </div>

      <!-- Welcome Section -->
      <div class="bg-white rounded shadow p-6 mb-6 flex justify-between items-center">
        <div>
          <h2 class="text-xl font-bold text-gray-700">Welcome!</h2>
          <p class="text-gray-600">Test Doctor.</p>
          <p class="mt-2 text-sm text-gray-500">Thanks for joining with us. We are always trying to get you a complete service. You can view your daily schedule, reach patients' appointments at home!</p>
          <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">View My Appointments</button>
        </div>
        <div>
          <img src="https://via.placeholder.com/200x100" alt="Placeholder" class="rounded">
        </div>
      </div>

      <!-- Status Section -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <?php
        // Hardcoded status values
        $statuses = [
          'All Doctors' => 1,
          'All Patients' => 3,
          'New Booking' => 0,
          'Today Sessions' => 0,
        ];
        foreach ($statuses as $label => $count): ?>
          <div class="bg-white rounded shadow p-4 text-center">
            <h3 class="text-lg font-bold text-gray-700"><?php echo $count; ?></h3>
            <p class="text-sm text-gray-500"><?php echo $label; ?></p>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Upcoming Sessions -->
      <div class="bg-white rounded shadow p-6">
        <h2 class="text-lg font-bold text-gray-700 mb-4">Your Upcoming Sessions until Next Week</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full text-left">
            <thead>
              <tr>
                <th class="px-4 py-2 text-gray-500 font-medium">Session Title</th>
                <th class="px-4 py-2 text-gray-500 font-medium">Scheduled Date</th>
                <th class="px-4 py-2 text-gray-500 font-medium">Time</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // Hardcoded session data
              $upcomingSessions = [
                // Add session data here if needed
              ];

              if (empty($upcomingSessions)): ?>
                <tr>
                  <td colspan="3" class="px-4 py-2 text-center text-gray-500">No upcoming sessions available.</td>
                </tr>
              <?php else: 
                foreach ($upcomingSessions as $session): ?>
                  <tr>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($session['title']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($session['date']); ?></td>
                    <td class="px-4 py-2"><?php echo htmlspecialchars($session['time']); ?></td>
                  </tr>
                <?php endforeach; 
              endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

</body>
</html>
