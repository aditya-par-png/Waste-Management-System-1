<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Waste Management - Profile</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Navbar -->
  <nav class="bg-green-600 p-4 flex flex-wrap justify-center gap-6 text-white text-lg font-medium">
    <a href="home.php" class="hover:underline">Home</a>
    <a href="profile.php" class="hover:underline">Profile</a>
    <a href="schedule.php" class="hover:underline">Schedule</a>
    <a href="help.php" class="hover:underline">Help</a>
  </nav>

  <!-- Header -->
  <header class="bg-green-700 text-white text-center py-6 text-3xl font-bold shadow">
    User Profile
  </header>

  <!-- Profile Container -->
  <section class="max-w-4xl mx-auto bg-white p-8 mt-8 rounded-lg shadow-lg">
    <div class="flex flex-col items-center mb-6">
      <label for="profile-pic" class="cursor-pointer relative">
        <img id="profileImage" src="profile-placeholder.png" alt="Profile Picture" class="w-40 h-40 object-cover rounded-full border-4 border-gray-300 shadow-md transition hover:opacity-90">
        <input type="file" id="profile-pic" class="hidden" accept="image/*" onchange="previewImage(event)" disabled>
      </label>
      <button onclick="document.getElementById('profile-pic').click()" id="changePicBtn" class="mt-3 text-sm text-blue-600 hover:underline hidden">Change Profile Picture</button>
    </div>

    <!-- Profile Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Full Name</label>
        <input id="name" type="text" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" value="John Doe" disabled>
      </div>
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Email</label>
        <input id="email" type="email" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" value="johndoe@example.com" disabled>
      </div>
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Phone</label>
        <input id="phone" type="tel" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" value="+1234567890" disabled>
      </div>
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Address</label>
        <input id="address" type="text" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" value="123 Street, City, Country" disabled>
      </div>
      <div class="md:col-span-2">
        <label class="block text-gray-700 font-semibold mb-1">Bio</label>
        <textarea id="bio" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" rows="3" disabled>Passionate about sustainability and waste management.</textarea>
      </div>
      <div>
        <label class="block text-gray-700 font-semibold mb-1">Date of Birth</label>
        <input id="dob" type="date" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" disabled>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="text-center mt-8">
      <button id="editProfileBtn" onclick="toggleEdit(true)" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
        Edit Profile
      </button>
      <button id="saveChangesBtn" onclick="saveChanges()" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-200 hidden">
        Save Changes
      </button>
    </div>
  </section>

  <!-- JavaScript -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      if (localStorage.getItem("profileImage")) {
        document.getElementById("profileImage").src = localStorage.getItem("profileImage");
      }
      ["name", "email", "phone", "address", "bio", "dob"].forEach(id => {
        if (localStorage.getItem(id)) {
          document.getElementById(id).value = localStorage.getItem(id);
        }
      });
    });

    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function () {
        document.getElementById("profileImage").src = reader.result;
        localStorage.setItem("profileImage", reader.result);
      };
      reader.readAsDataURL(event.target.files[0]);
    }

    function toggleEdit(enable) {
      const fields = ["name", "email", "phone", "address", "bio", "dob"];
      fields.forEach(id => document.getElementById(id).disabled = !enable);
      document.getElementById("profile-pic").disabled = !enable;
      document.getElementById("changePicBtn").classList.toggle("hidden", !enable);
      document.getElementById("editProfileBtn").classList.toggle("hidden", enable);
      document.getElementById("saveChangesBtn").classList.toggle("hidden", !enable);
    }

    function saveChanges() {
      ["name", "email", "phone", "address", "bio", "dob"].forEach(id => {
        localStorage.setItem(id, document.getElementById(id).value);
      });
      alert("Profile updated successfully!");
      toggleEdit(false);
    }
  </script>
</body>
</html>
