<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Waste Management - Home</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css"> <!-- ✅ External CSS added -->
</head>
<body class="bg-gray-100 font-sans">
  
  <nav class="bg-green-600 p-4 flex justify-around text-white">
    <a href="home.php" class="hover:underline font-bold underline">Home</a>
    <a href="profile.php" class="hover:underline">Profile</a>
    <a href="schedule.php" class="hover:underline">Schedule</a>
    <a href="recycling-info.php" class="hover:underline">Recycling Info</a>
    <a href="help.php" class="hover:underline">Help</a>
  </nav>

  <header class="bg-green-700 text-white text-center py-6 text-xl font-bold">
    Waste Management System
  </header>

  <section class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
    <h2 class="text-lg font-semibold">Request for Pickup</h2>
    <form class="mt-4">
      <label class="block">Type of Waste</label>
      <select id="waste-type" class="w-full p-2 border rounded">
        <option>Biodegradable</option>
        <option>Non-Biodegradable</option>
        <option>Recyclable</option>
      </select>

      <label class="block mt-3">Preferred Pickup Date</label>
      <input type="date" id="pickup-date" class="w-full p-2 border rounded">

      <label class="block mt-3">Preferred Pickup Time</label>
      <input type="time" id="pickup-time" class="w-full p-2 border rounded">

      <label class="block mt-3">Pickup Location (Route)</label>
      <input type="text" id="pickup-route" class="w-full p-2 border rounded" placeholder="Enter Pickup Location">
      
      <button type="button" class="w-full bg-green-600 text-white mt-4 p-2 rounded hover:bg-green-700" onclick="submitPickup()">
        Request Pickup
      </button>
    </form>
  </section>

  <script>
    function submitPickup() {
      const wasteType = document.getElementById("waste-type").value;
      const date = document.getElementById("pickup-date").value;
      const time = document.getElementById("pickup-time").value;
      const route = document.getElementById("pickup-route").value;

      if (!date || !time || !route) {
        alert("Please fill out all fields, including the route.");
        return;
      }

      const pickupRequest = {
        wasteType: wasteType,
        date: date,
        time: time,
        route: route,
      };

      const scheduleList = JSON.parse(localStorage.getItem('scheduleList')) || [];
      scheduleList.push(pickupRequest);
      localStorage.setItem('scheduleList', JSON.stringify(scheduleList));

      alert("Your pickup request has been submitted successfully!");
    }
  </script>
</body>
</html>
