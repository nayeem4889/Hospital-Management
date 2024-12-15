<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="bg-white w-full max-w-md p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-center mb-4">Welcome Back!</h1>
    <p class="text-gray-600 text-center mb-6">Login with your details to continue</p>

    <!-- Login Form -->
    <form action="authenticate.php" method="POST">
      <!-- Email Input -->
      <div class="mb-4">
        <label for="email" class="block text-gray-700 font-medium mb-2">Email:</label>
        <input
          type="email"
          id="email"
          name="email"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Email Address"
          required
        />
      </div>

      <!-- Password Input -->
      <div class="mb-6">
        <label for="password" class="block text-gray-700 font-medium mb-2">Password:</label>
        <input
          type="password"
          id="password"
          name="password"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          placeholder="Password"
          required
        />
      </div>

      <!-- Login Button -->
      <button
        type="submit"
        class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 font-semibold"
      >
        Login
      </button>
    </form>

    <!-- Sign Up Link -->
    <p class="text-gray-600 text-center mt-6">
      Don't have an account? 
      <a href="signup.html" class="text-blue-500 font-medium hover:underline">Sign Up</a>
    </p>
  </div>
</body>
</html>
