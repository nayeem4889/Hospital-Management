<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Appointment Manager</title>
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
              <a href="./my_appointments.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2 bg-blue-200">
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
        <div class="flex items-center space-x-4">
            <button class="flex items-center bg-blue-100 text-blue-600 px-4 py-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
              </button>
          <h1 class="text-2xl font-bold text-gray-700">Appointment Manager</h1>
        </div>
        <p class="text-gray-500">Today's Date: <span class="font-medium"><?php echo date('Y-m-d'); ?></span></p>
      </div>

      <!-- Filter Section -->
      <div class="bg-white p-4 rounded shadow mb-6 flex items-center space-x-4">
        <label for="date" class="text-gray-500">Date:</label>
        <input
          type="date"
          id="date"
          class="px-4 py-2 border rounded w-full md:w-1/3 text-gray-700"
          placeholder="dd-mm-yyyy"
        />
        <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
          Filter
        </button>
      </div>

      <!-- Appointments Table -->
      <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full text-left">
          <thead>
            <tr class="bg-gray-100">
              <th class="px-4 py-2 text-gray-500 font-medium">Patient Name</th>
              <th class="px-4 py-2 text-gray-500 font-medium">Appointment Number</th>
              <th class="px-4 py-2 text-gray-500 font-medium">Session Title</th>
              <th class="px-4 py-2 text-gray-500 font-medium">Session Date & Time</th>
              <th class="px-4 py-2 text-gray-500 font-medium">Appointment Date</th>
              <th class="px-4 py-2 text-gray-500 font-medium">Events</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Example data
            $appointments = [
              [
                'patient_name' => 'Test Patient',
                'appointment_number' => '1',
                'session_title' => 'Test Session',
                'session_date_time' => '2050-01-01 @18:00',
                'appointment_date' => '2022-06-03',
              ],
              // Add more appointments as needed
            ];

            if (empty($appointments)): ?>
              <tr>
                <td colspan="6" class="px-4 py-2 text-center text-gray-500">No appointments available.</td>
              </tr>
            <?php else: 
              foreach ($appointments as $appointment): ?>
                <tr class="border-b">
                  <td class="px-4 py-2 text-gray-700"><?php echo htmlspecialchars($appointment['patient_name']); ?></td>
                  <td class="px-4 py-2 text-gray-700"><?php echo htmlspecialchars($appointment['appointment_number']); ?></td>
                  <td class="px-4 py-2 text-gray-700"><?php echo htmlspecialchars($appointment['session_title']); ?></td>
                  <td class="px-4 py-2 text-gray-700"><?php echo htmlspecialchars($appointment['session_date_time']); ?></td>
                  <td class="px-4 py-2 text-gray-700"><?php echo htmlspecialchars($appointment['appointment_date']); ?></td>
                  <td class="px-4 py-2">
                    <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                      Cancel
                    </button>
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
