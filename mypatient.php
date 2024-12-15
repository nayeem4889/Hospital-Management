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
          <ul class="space-y-3 pt-4">
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
              <a href="./my_sessions.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                <span class="ml-3">🗂️ My Sessions</span> 
              </a>
            </li>
            <li>
              <a href="./my_patients.php" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2 bg-blue-200">
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
        <button class="flex items-center bg-blue-100 text-blue-600 px-4 py-2 rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
          </button>
        <div class="flex items-center space-x-2">
          <p class="text-xl font-semibold">My Patients</p>
        </div>
        <div class="text-gray-600">
          <span>Today's Date: </span>
          <span class="font-medium"><?php echo date("Y-m-d"); ?></span>
        </div>
      </div>

      <!-- Filters -->
      <div class="flex justify-between items-center mb-6">
        <div class="flex items-center space-x-2">
          <label for="details" class="text-gray-600">Show Details About:</label>
          <select id="details" class="border-gray-300 border rounded p-2 text-gray-600">
            <option>My patients Only</option>
            <option>All Patients</option>
          </select>
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Filter</button>
      </div>

      <!-- Table -->
      <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Name</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">NIC</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Telephone</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Email</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Date of Birth</th>
              <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Events</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <?php
            // Example patient data
            $patients = [
                [
                    'name' => 'Test Patient',
                    'nic' => '0000000000',
                    'telephone' => '0120000000',
                    'email' => 'patient@edoc.com',
                    'dob' => '2000-01-01'
                ],
                [
                    'name' => 'Jane Doe',
                    'nic' => '1234567890',
                    'telephone' => '0130000001',
                    'email' => 'jane.doe@edoc.com',
                    'dob' => '1990-05-12'
                ],
                [
                    'name' => 'John Smith',
                    'nic' => '0987654321',
                    'telephone' => '0140000002',
                    'email' => 'john.smith@edoc.com',
                    'dob' => '1985-10-30'
                ]
            ];

            if (empty($patients)): ?>
              <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No patients found.</td>
              </tr>
            <?php else:
              foreach ($patients as $patient): ?>
                <tr>
                  <td class="px-6 py-4 text-gray-700"><?php echo htmlspecialchars($patient['name']); ?></td>
                  <td class="px-6 py-4 text-gray-700"><?php echo htmlspecialchars($patient['nic']); ?></td>
                  <td class="px-6 py-4 text-gray-700"><?php echo htmlspecialchars($patient['telephone']); ?></td>
                  <td class="px-6 py-4 text-gray-700"><?php echo htmlspecialchars($patient['email']); ?></td>
                  <td class="px-6 py-4 text-gray-700"><?php echo htmlspecialchars($patient['dob']); ?></td>
                  <td class="px-6 py-4">
                    <button class="text-blue-500 hover:underline">View</button>
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
