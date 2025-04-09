<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Waste Management - Schedule</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Navigation -->
  <nav class="bg-green-600 p-4 flex flex-wrap justify-center gap-6 text-white font-medium text-lg">
    <a href="home.php" class="hover:underline">Home</a>
    <a href="profile.php" class="hover:underline">Profile</a>
    <a href="schedule.php" class="underline font-semibold">Schedule</a>
    <a href="help.php" class="hover:underline">Help</a>
  </nav>

  <!-- Header -->
  <header class="bg-green-700 text-white text-center py-6 shadow-md">
    <h1 class="text-3xl font-bold">Weekly Schedule</h1>
  </header>

  <!-- Schedule List Section -->
  <section class="max-w-3xl mx-auto bg-white p-8 mt-8 rounded-xl shadow-lg">
    <h2 class="text-2xl font-semibold text-green-700 mb-4">Your Scheduled Pickups</h2>

    <div id="schedule-list" class="space-y-4">
      <!-- Schedule items will be injected here -->
    </div>
  </section>

  <!-- Optional Footer -->
  <footer class="text-center text-gray-600 text-sm py-6">
    © 2025 Waste Management System. All rights reserved.
  </footer>

  <script>
    // Load all schedule data from localStorage
    window.onload = function() {
      const scheduleList = JSON.parse(localStorage.getItem('scheduleList')) || [];
      const scheduleContainer = document.getElementById("schedule-list");

      if (scheduleList.length === 0) {
        scheduleContainer.innerHTML = `
          <div class="text-gray-500 text-center py-8">
            No pickups scheduled yet.
          </div>`;
        return;
      }

      scheduleList.forEach((request) => {
        const scheduleItem = document.createElement("div");
        scheduleItem.className = "p-4 bg-green-100 border border-green-200 rounded-xl shadow-sm hover:shadow-md transition duration-300";
        scheduleItem.innerHTML = `
          <p class="text-lg font-semibold text-green-800">${new Date(request.date).toDateString()}</p>
          <p><span class="font-medium text-gray-700">Waste Type:</span> ${request.wasteType}</p>
          <p><span class="font-medium text-gray-700">Time:</span> ${request.time}</p>
          <p><span class="font-medium text-gray-700">Route:</span> ${request.route}</p>
          <p class="mt-2 text-green-700 font-semibold">Status: Scheduled</p>
        `;
        scheduleContainer.appendChild(scheduleItem);
      });
    };
  </script>

</body>
</html>
