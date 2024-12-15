<?php
// Include database connection
include 'db_connection.php';

// Handle doctor list fetching
$doctorQuery = "SELECT id, name FROM doctors";
$doctorResult = $conn-> query($doctorQuery);

// Handle appointment cancellation
if (isset($_GET['cancel_id'])) {
    $cancelId = intval($_GET['cancel_id']);
    $deleteAppointmentQuery = "DELETE FROM appointments WHERE id = $cancelId";

    if ($conn->query($deleteAppointmentQuery) === TRUE) {
        echo "<script>alert('Appointment canceled successfully!'); window.location.href='Admin_Appointment.php';</script>";
    } else {
        echo "<script>alert('Error canceling appointment: " . $conn->error . "');</script>";
    }
}

// Handle filtering by doctor or date
$whereClause = [];
if (isset($_GET['filter_date']) && !empty($_GET['filter_date'])) {
    $filterDate = $_GET['filter_date'];
    $whereClause[] = "appointment_date = '$filterDate'";
}
if (isset($_GET['filter_doctor']) && !empty($_GET['filter_doctor'])) {
    $filterDoctor = intval($_GET['filter_doctor']);
    $whereClause[] = "doctor_id = $filterDoctor";
}

$whereSQL = "";
if (!empty($whereClause)) {
    $whereSQL = "WHERE " . implode(" AND ", $whereClause);
}

// Fetch appointments
$appointmentQuery = "
    SELECT 
        a.id, a.patient_name, a.appointment_number, d.name AS doctor_name, 
        a.session_title, a.session_datetime, a.appointment_date 
    FROM appointments a
    JOIN doctors d ON a.doctor_id = d.id
    $whereSQL
";
$appointmentResult = $conn->query($appointmentQuery);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Appointment</title>
</head>
<body class="bg-gray-100 h-screen">

<div class="flex h-full">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-full">
        <div class="p-4">
            <div class="text-center mb-4">
                <div class="w-16 h-16 rounded-full bg-gray-300 mx-auto"></div>
                <p class="mt-2 font-semibold">Administrator</p>
                <p class="text-sm text-gray-500">admin@edoc.com</p>
            </div>
            <button class="w-full bg-blue-500 text-white py-2 rounded-md">Log out</button>
        </div>
        <nav class="">
            <ul class="space-y-4">
                <li>
                    <a href="./admin_Dashboard.html" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                        <span class="material-icons ml-2">?? Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="./Add_doctors.html" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                        <span class="material-icons ml-2">????? Doctors</span>
                    </a>
                </li>
                <li>
                    <a href="./Admin_schedule.html" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                        <span class="material-icons ml-2">??? Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="./Admin_Appointment.html" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2 bg-blue-200">
                        <span class="material-icons ml-2">?? Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center text-gray-700 rounded-md hover:bg-gray-100 p-2">
                        <span class="material-icons ml-2">?? settings</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-gray-100 p-6">
        <header class="flex justify-between items-center mb-6">
            <button class="flex items-center bg-blue-100 text-blue-600 px-4 py-2 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back
            </button>
            <div class="flex items-center space-x-2">
                <p class="text-xl font-semibold">Appointment</p>
            </div>
            <div class="flex items-center space-x-4">
                <p class="text-gray-500">Today's Date: <span class="font-semibold"><?= date('Y-m-d'); ?></span></p>
            </div>
        </header>

        <section class="bg-white rounded-md shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold">Appointment Manager</h2>
            </div>

            <form method="GET" class="flex items-center space-x-4 mb-6">
                <input type="date" name="filter_date" class="border border-gray-300 rounded-md py-2 px-4" value="<?= htmlspecialchars($_GET['filter_date'] ?? ''); ?>">
                <select name="filter_doctor" class="border border-gray-300 rounded-md py-2 px-4">
                    <option value="">Choose Doctor Name from the list</option>
                    <?php while ($doctor = $doctorResult->fetch_assoc()): ?>
                        <option value="<?= $doctor['id']; ?>" <?= (isset($_GET['filter_doctor']) && $_GET['filter_doctor'] == $doctor['id']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($doctor['name']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Filter</button>
            </form>

            <table class="w-full border-collapse border border-gray-300">
                <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2 text-left">Patient Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Appointment Number</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Doctor</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Session Title</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Session Date & Time</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Appointment Date</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Events</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($appointmentResult->num_rows > 0): ?>
                    <?php while ($appointment = $appointmentResult->fetch_assoc()): ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($appointment['patient_name']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($appointment['appointment_number']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($appointment['doctor_name']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($appointment['session_title']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($appointment['session_datetime']); ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($appointment['appointment_date']); ?></td>
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="?cancel_id=<?= $appointment['id']; ?>" class="text-red-500 hover:underline">Cancel</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="border border-gray-300 px-4 py-2 text-center">No appointments found</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>

</div>

</body>
</html>
