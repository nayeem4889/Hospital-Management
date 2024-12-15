<?php
// header.php: Contains the header for the site
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hospital Management System</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<?php
// End of header.php
?>

<?php
// home.php: Main content for the Home Page
?>
<div class="relative bg-cover bg-center h-screen" style="background-image: url('./Images/coronavirus-outbreak-leisure-quarantine-social-distancing-emotions-concept-confident-young-woman-checked-shirt-wear-medical-mask-cross-arms-chest-determined-look-camera.jpg');">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>

    <!-- Content -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-6">
      <h1 class="text-4xl md:text-5xl font-bold mb-4">Ease process, save time.</h1>
      <p class="text-lg md:text-xl mb-6">
        Feeling under the weather today? No need to fret. With HMS, you can easily connect with healthcare professionals and schedule appointments online.
      </p>
      <a href="./login.php">
        <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition">
            Make Appointment
        </button>
      </a>
    </div>

    <!-- Header -->
    <div class="absolute top-0 left-0 w-full flex justify-between items-center p-6">
      <div class="text-white text-lg font-bold">ZAMS | Hospital Management System</div>
      <a href="./signup.php" class="text-white font-medium hover:underline">REGISTER</a>
    </div>
</div>
<?php
// End of home.php
?>

<?php
// footer.php: Contains the footer for the site
?>
</body>
</html>
<?php
// End of footer.php
?>
