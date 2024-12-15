<?php
// Static variables for demonstration (Replace these with dynamic data from your backend)
$all_doctors = 10; // Total number of doctors
$all_patients = 50; // Total number of patients
$new_bookings = 3; // Total new bookings for today
$today_sessions = 2; // Total sessions scheduled for today

// Example user session details (Replace with actual session variables)
session_start();
$_SESSION['user_name'] = "John Doe"; // Replace with dynamic user name
$_SESSION['user_email'] = "john.doe@example.com"; // Replace with dynamic user email

// Example bookings array (Replace with dynamic database values)
$upcoming_bookings = [
    [
        'appointment_number' => '001',
        'session_title' => 'General Consultation',
        'doctor' => 'Dr. John',
        'scheduled_datetime' => '2024-03-01, 10:00 AM',
    ],
    [
        'appointment_number' => '002',
        'session_title' => 'Dental Checkup',
        'doctor' => 'Dr. Jane',
        'scheduled_datetime' => '2024-03-02, 1:00 PM',
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar -->
  <aside class="bg-white w-64 border-r hidden md:block">
    <div class="p-6">
      <!-- Profile Section -->
      <div class="flex items-center mb-6">
        <div class="ml-4">
          <h2 class="text-lg font-semibold">Welcome, <?php echo $_SESSION['user_name']; ?></h2>
          <p class="text-sm text-gray-500"><?php echo $_SESSION['user_email']; ?></p>
        </div>
      </div>
      <!-- Log Out Button -->
      <a href="logout.php"><button class="w-full py-2 px-4 bg-blue-500 text-white rounded-md mb-6">Log out</button></a>

      <!-- Navigation -->
      <nav>
        <ul class="space-y-4">
          <li>
            <a href="dashboard.php" class="flex items-center p-2 rounded-md hover:bg-gray-100 bg-blue-200">
              <span class="ml-2">🏠 Home</span>
            </a>
          </li>
          <li>
            <a href="doctors.php" class="flex items-center p-2 rounded-md hover:bg-gray-100">
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
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">Home</h1>
      <div class="text-gray-500">Today's Date: <span class="font-medium"><?php echo date("Y-m-d"); ?></span></div>
    </div>
    <!-- Welcome Section -->
    <div class="bg-blue-100 p-6 rounded-md shadow-md mb-6">
      <h2 class="text-lg font-semibold mb-2">Welcome! <?php echo $_SESSION['user_name']; ?></h2>
      <p class="text-gray-600">
        Haven’t any idea about doctors? No problem, let’s jump to "All Doctors" section or "Sessions."
        Track your past and future appointments here.
      </p>
      <div class="flex mt-4">
        <input type="text" placeholder="Search Doctor Here" class="flex-1 border border-gray-300 rounded-l-md px-4 py-2">
        <button class="px-6 py-2 bg-blue-500 text-white rounded-r-md">Search</button>
      </div>
    </div>

    <!-- Status Section -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-6">
      <div class="bg-white p-4 rounded-lg shadow-md text-center">
        <h3 class="text-2xl font-semibold"><?php echo $all_doctors; ?></h3>
        <p class="text-sm text-gray-500">All Doctors</p>
      </div>
      <div class="bg-white p-4 rounded-lg shadow-md text-center">
        <h3 class="text-2xl font-semibold"><?php echo $all_patients; ?></h3>
        <p class="text-sm text-gray-500">All Patients</p>
      </div>
      <div class="bg-white p-4 rounded-lg shadow-md text-center">
        <h3 class="text-2xl font-semibold"><?php echo $new_bookings; ?></h3>
        <p class="text-sm text-gray-500">New Booking</p>
      </div>
      <div class="bg-white p-4 rounded-lg shadow-md text-center">
        <h3 class="text-2xl font-semibold"><?php echo $today_sessions; ?></h3>
        <p class="text-sm text-gray-500">Today Sessions</p>
      </div>
    </div>

    <!-- Upcoming Bookings -->
    <div>
      <h2 class="text-lg font-semibold mb-4">Your Upcoming Bookings</h2>
      <div class="bg-white rounded-lg shadow-md p-6">
        <table class="w-full border-collapse">
          <thead>
            <tr class="bg-gray-100 text-gray-600">
              <th class="py-2 px-4 text-left">Appoint. Number</th>
              <th class="py-2 px-4 text-left">Session Title</th>
              <th class="py-2 px-4 text-left">Doctor</th>
              <th class="py-2 px-4 text-left">Scheduled Date & Time</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($upcoming_bookings as $booking): ?>
              <tr class="hover:bg-gray-50">
                <td class="py-2 px-4"><?php echo $booking['appointment_number']; ?></td>
                <td class="py-2 px-4"><?php echo $booking['session_title']; ?></td>
                <td class="py-2 px-4"><?php echo $booking['doctor']; ?></td>
                <td class="py-2 px-4"><?php echo $booking['scheduled_datetime']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php if (empty($upcoming_bookings)): ?>
          <div class="mt-6 flex justify-center">
            <img src="https://via.placeholder.com/100" alt="No Data Illustration" class="opacity-50">
          </div>
        <?php endif; ?>
      </div>
    </div>
  </main>
</body>
</html>
