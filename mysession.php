<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sessions</title>
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
            <h2 class="font-medium">Test Doctor</h2>
            <p class="text-sm text-gray-500">doctor@edoc.com</p>
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
              <a href="./doctor_dashboard.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                <span class="ml-3">🏠 Dashboard</span> 
              </a>
            </li>
            <li>
              <a href="./my_appointments.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                <span class="ml-3">📅 My Appointments</span> 
              </a>
            </li>
            <li>
              <a href="./my_sessions.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2 bg-blue-200">
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
      <div class="flex justify-between items-center mb-6">
        <button class="flex items-center bg-blue-100 text-blue-600 px-4 py-2 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
          </button>
        <h1 class="text-xl font-semibold">My Sessions</h1>
        <div class="flex items-center space-x-2">
          <label for="date" class="text-gray-600">Date:</label>
          <input type="date" id="date" class="border-gray-300 border rounded p-2 text-gray-600">
          <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
        </div>
      </div>

      <!-- Table -->
      <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Session Title</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Scheduled Date & Time</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Max num that can be booked</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Events</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php
            // Example session data
            $sessions = [
                [
                    'title' => 'Test Session',
                    'scheduled_date_time' => '2050-01-01 18:00',
                    'max_bookings' => 50
                ],
                [
                    'title' => 'Session 1',
                    'scheduled_date_time' => '2022-06-10 20:36',
                    'max_bookings' => 1
                ],
                [
                    'title' => 'Session 12',
                    'scheduled_date_time' => '2022-06-24 13:33',
                    'max_bookings' => 1
                ]
            ];

            if (empty($sessions)): ?>
              <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No sessions available.</td>
              </tr>
            <?php else:
              foreach ($sessions as $session): ?>
                <tr>
                  <td class="px-6 py-4 text-gray-700"><?php echo htmlspecialchars($session['title']); ?></td>
                  <td class="px-6 py-4 text-gray-700"><?php echo htmlspecialchars($session['scheduled_date_time']); ?></td>
                  <td class="px-6 py-4 text-gray-700"><?php echo htmlspecialchars($session['max_bookings']); ?></td>
                  <td class="px-6 py-4">
                    <button class="text-blue-500 hover:underline mr-4">View</button>
                    <button class="text-red-500 hover:underline">Cancel Session</button>
                  </td>
                </tr>
              <?php endforeach;
            endif; ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
