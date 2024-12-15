<?php
// Start session
session_start();

// Static variables for demonstration purposes (replace with actual database values)
$_SESSION['user_name'] = "Md. Kazi Musfiqur";
$_SESSION['user_email'] = "musfiqrohoman1@gmail.com";

// Example doctors array (Replace this with a dynamic database query result)
$doctors = [
    [
        'name' => 'Test Doctor',
        'email' => 'doctor@edoc.com',
        'specialties' => 'Accident and Emergency',
    ]
];

// Today's date
$today_date = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Doctors</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar -->
  <aside class="bg-white w-64 border-r hidden md:block">
    <div class="p-6">
      <!-- Profile Section -->
      <div class="flex items-center mb-6">
        <div class="ml-4">
          <h2 class="text-lg font-semibold"><?php echo $_SESSION['user_name']; ?></h2>
          <p class="text-sm text-gray-500"><?php echo $_SESSION['user_email']; ?></p>
        </div>
      </div>
      <!-- Log Out Button -->
      <a href="logout.php"><button class="w-full py-2 px-4 bg-blue-500 text-white rounded-md mb-6">Log out</button></a>
      <!-- Navigation -->
      <nav>
        <ul class="space-y-4">
          <li>
            <a href="patientdashboard.php" class="flex items-center p-2 rounded-md hover:bg-gray-100">
              <span class="ml-2">🏠 Home</span>
            </a>
          </li>
          <li>
            <a href="alldoctors.php" class="flex items-center p-2 rounded-md hover:bg-gray-100 bg-blue-200">
              <span class="ml-2">👨‍⚕️ All Doctors</span>
            </a>
          </li>
          <li>
            <a href="sessions.php" class="flex items-center p-2 rounded-md hover:bg-gray-100">
              <span class="ml-2">📅 Scheduled Sessions</span>
            </a>
          </li>
          <li>
            <a href="bookings.php" class="flex items-center p-2 rounded-md hover:bg-gray-100">
              <span class="ml-2">🗂️ My Bookings</span>
            </a>
          </li>
          <li>
            <a href="settings.php" class="flex items-center p-2 rounded-md hover:bg-gray-100">
              <span class="ml-2">⚙️ Settings</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
      <button class="flex items-center bg-blue-100 text-blue-600 px-4 py-2 rounded-md">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Back
      </button>
      <div class="flex items-center space-x-2">
        <input type="text" placeholder="Search Doctor name or Email" class="border border-gray-300 rounded-l-md px-4 py-2 w-full md:w-80">
        <button class="px-4 py-2 bg-blue-500 text-white rounded-r-md">Search</button>
      </div>
      <div class="text-gray-500">
        <span class="font-medium">Today's Date:</span> <?php echo $today_date; ?>
      </div>
    </div>

    <!-- Table Section -->
    <section>
      <h2 class="text-lg font-semibold mb-4">All Doctors (<?php echo count($doctors); ?>)</h2>
      <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead class="bg-gray-100">
            <tr>
              <th class="py-3 px-4 border-b text-sm text-gray-600">Doctor Name</th>
              <th class="py-3 px-4 border-b text-sm text-gray-600">Email</th>
              <th class="py-3 px-4 border-b text-sm text-gray-600">Specialties</th>
              <th class="py-3 px-4 border-b text-sm text-gray-600">Events</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($doctors as $doctor): ?>
            <tr class="hover:bg-gray-50">
              <td class="py-3 px-4 border-b text-sm"><?php echo $doctor['name']; ?></td>
              <td class="py-3 px-4 border-b text-sm"><?php echo $doctor['email']; ?></td>
              <td class="py-3 px-4 border-b text-sm"><?php echo $doctor['specialties']; ?></td>
              <td class="py-3 px-4 border-b text-sm">
                <button class="px-4 py-2 bg-blue-100 text-blue-500 rounded-md mr-2">View</button>
                <button class="px-4 py-2 bg-blue-500 text-white rounded-md">Sessions</button>
              </td>
            </tr>
            <?php endforeach; ?>
            <?php if (empty($doctors)): ?>
            <tr>
              <td colspan="4" class="py-3 px-4 text-center text-gray-500">No doctors found.</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
</body>
</html>
