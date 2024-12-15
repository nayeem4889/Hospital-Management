<?php
// Assuming user information and bookings are fetched from a database
$user = [
    'name' => 'Md. Kazi Musfiqur',
    'email' => 'musfiqrohoman1@gmail.com'
];

$bookings = []; // Replace this with a database query to fetch bookings
$current_date = date('Y-m-d');

// HTML Starts
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Bookings History</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar -->
  <aside class="bg-white w-64 border-r hidden md:block">
    <div class="p-6">
      <!-- Profile Section -->
      <div class="flex items-center mb-6">
        <div class="ml-4">
          <h2 class="text-lg font-semibold"><?php echo htmlspecialchars($user['name']); ?></h2>
          <p class="text-sm text-gray-500"><?php echo htmlspecialchars($user['email']); ?></p>
        </div>
      </div>
      <!-- Log Out Button -->
      <button class="w-full py-2 px-4 bg-blue-500 text-white rounded-md mb-6">Log out</button>
      <!-- Navigation -->
      <nav>
        <ul class="space-y-4">
          <li>
            <a href="./patientdashboard.html" class="flex items-center p-2 rounded-md hover:bg-gray-100">
              <span class="ml-2">🏠 Home</span>
            </a>
          </li>
          <li>
            <a href="./All doctors.html" class="flex items-center p-2 rounded-md hover:bg-gray-100">
              <span class="ml-2">👨‍⚕️ All Doctors</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center p-2 rounded-md hover:bg-gray-100">
              <span class="ml-2">📅 Scheduled Sessions</span>
            </a>
          </li>
          <li>
            <a href="./Booking.html" class="flex items-center p-2 rounded-md hover:bg-gray-100 bg-blue-200">
              <span class="ml-2">🗂️ My Bookings</span>
            </a>
          </li>
          <li>
            <a href="./settings.html" class="flex items-center p-2 rounded-md hover:bg-gray-100">
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
      <h1 class="text-lg font-semibold">My Bookings History</h1>
      <div class="text-gray-500">
        <span class="font-medium">Today's Date:</span> <?php echo $current_date; ?>
      </div>
    </div>

    <!-- Filter Section -->
    <section class="mb-6">
      <h2 class="text-lg font-semibold mb-4">My Bookings (<?php echo count($bookings); ?>)</h2>
      <div class="flex items-center space-x-4">
        <form method="GET" action="">
          <input type="text" name="date" placeholder="dd-mm-yyyy" class="border border-gray-300 rounded-md px-4 py-2 w-full md:w-80">
          <button type="submit" class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m4-4v8" />
            </svg>
            Filter
          </button>
        </form>
      </div>
    </section>

    <!-- No Results Section -->
    <?php if (empty($bookings)) : ?>
      <section class="bg-white shadow-md rounded-lg p-6 text-center">
        <img src="https://via.placeholder.com/150" alt="No Data Illustration" class="mx-auto mb-4">
        <p class="text-gray-600">We couldn't find anything related to your keywords!</p>
        <button class="mt-4 px-6 py-2 bg-blue-500 text-white rounded-md">Show all Appointments</button>
      </section>
    <?php else : ?>
      <section class="bg-white shadow-md rounded-lg p-6">
        <ul>
          <?php foreach ($bookings as $booking) : ?>
            <li class="mb-4 p-4 border rounded-md">
              <h3 class="font-semibold"><?php echo htmlspecialchars($booking['title']); ?></h3>
              <p class="text-gray-500">Date: <?php echo htmlspecialchars($booking['date']); ?></p>
            </li>
          <?php endforeach; ?>
        </ul>
      </section>
    <?php endif; ?>
  </main>
</body>
</html>
