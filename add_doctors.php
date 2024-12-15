<?php
// Include the database connection
include 'db_connection.php';

// Handle form submission for adding or updating a doctor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctor_name = $_POST['doctor_name'];
    $email = $_POST['email'];
    $specialties = $_POST['specialties'];

    if (isset($_POST['id']) && $_POST['id'] !== '') {
        // Update an existing doctor
        $id = $_POST['id'];
        $sql = "UPDATE doctors SET doctor_name = '$doctor_name', email = '$email', specialties = '$specialties' WHERE id = $id";
    } else {
        // Add a new doctor
        $sql = "INSERT INTO doctors (doctor_name, email, specialties) VALUES ('$doctor_name', '$email', '$specialties')";
    }

    if ($conn->query($sql) !== TRUE) {
        $error = "Error: " . $conn->error;
    }
}

// Handle delete request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM doctors WHERE id = $id";
    if ($conn->query($sql) !== TRUE) {
        $error = "Error: " . $conn->error;
    }
}

// Fetch all doctors from the database
$sql = "SELECT * FROM doctors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctors</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // JavaScript to toggle the modal
    function toggleModal(id = '', doctorName = '', email = '', specialties = '') {
      const modal = document.getElementById('addDoctorModal');
      modal.classList.toggle('hidden');

      document.getElementById('id').value = id;
      document.getElementById('doctor-name').value = doctorName;
      document.getElementById('email').value = email;
      document.getElementById('specialties').value = specialties;
    }
  </script>
</head>
<body class="bg-gray-100 min-h-screen flex">
  <!-- Sidebar -->
  <aside class="bg-white w-64 border-r hidden md:block">
    <div class="p-6">
      <!-- Profile Section -->
      <div class="flex items-center mb-6">
        <div class="ml-4">
          <h2 class="text-lg font-semibold">Abid</h2>
          <p class="text-sm text-gray-500">abid@gmail.com</p>
        </div>
      </div>
      <!-- Log Out Button -->
      <a href="./LogIn.php"><button class="w-full py-2 px-4 bg-blue-500 text-white rounded-md mb-6">Log out</button></a>
      <!-- Navigation -->
      <nav>
        <ul class="space-y-4">
          <li><a href="./make_appointment.php" class="flex items-center p-2 rounded-md hover:bg-gray-100"><span class="ml-2">🏠 Home</span></a></li>
          <li><a href="./add_doctors.php" class="flex items-center p-2 rounded-md hover:bg-gray-100 bg-blue-200"><span class="ml-2">👨‍⚕️ All Doctors</span></a></li>
          <li><a href="./shedule.php" class="flex items-center p-2 rounded-md hover:bg-gray-100"><span class="ml-2">📅 Scheduled Sessions</span></a></li>
          <li><a href="./my_booking.php" class="flex items-center p-2 rounded-md hover:bg-gray-100"><span class="ml-2">🗂️ My Bookings</span></a></li>
          <li><a href="" class="flex items-center p-2 rounded-md hover:bg-gray-100"><span class="ml-2">⚙️ Settings</span></a></li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 bg-gray-100 p-6">
    <header class="flex justify-between items-center mb-6">
      <p class="text-xl font-semibold">Doctors</p>
    </header>

    <!-- Add Doctor Section -->
    <section class="bg-white rounded-md shadow-md p-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Manage Doctors</h2>
        <button onclick="toggleModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md">+ Add New</button>
      </div>

      <!-- Display error message -->
      <?php if (isset($error)): ?>
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
          <?php echo htmlspecialchars($error); ?>
        </div>
      <?php endif; ?>

      <!-- Doctors Table -->
      <table class="w-full border-collapse border border-gray-300">
        <thead>
          <tr class="bg-gray-100">
            <th class="border border-gray-300 px-4 py-2 text-left">Doctor Name</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Specialties</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['doctor_name']); ?></td>
                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['email']); ?></td>
                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['specialties']); ?></td>
                <td class="border border-gray-300 px-4 py-2">
                  <button onclick="toggleModal('<?php echo $row['id']; ?>', '<?php echo htmlspecialchars($row['doctor_name']); ?>', '<?php echo htmlspecialchars($row['email']); ?>', '<?php echo htmlspecialchars($row['specialties']); ?>')" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                  <a href="?delete=<?php echo $row['id']; ?>" class="px-2 py-1 bg-red-500 text-white rounded">Delete</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="border border-gray-300 px-4 py-2 text-center">No doctors found</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </section>
  </main>

  <!-- Add Doctor Modal -->
  <div id="addDoctorModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center">
    <div class="bg-white w-full max-w-lg rounded-lg shadow-md p-6">
      <h3 class="text-xl font-semibold mb-4">Manage Doctor</h3>
      <form action="add_doctors.php" method="POST">
        <!-- Doctor ID (hidden for editing) -->
        <input type="hidden" id="id" name="id">

        <!-- Doctor Name -->
        <div class="mb-4">
          <label for="doctor-name" class="block text-sm font-medium text-gray-700">Doctor Name</label>
          <input type="text" id="doctor-name" name="doctor_name" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <!-- Doctor Email -->
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input type="email" id="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <!-- Specialties -->
        <div class="mb-4">
          <label for="specialties" class="block text-sm font-medium text-gray-700">Specialties</label>
          <input type="text" id="specialties" name="specialties" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-2">
          <button type="button" onclick="toggleModal()" class="px-4 py-2 bg-gray-300 rounded-md">Cancel</button>
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Save</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>