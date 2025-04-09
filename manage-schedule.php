<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Schedules</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f9;
      margin: 0;
      display: flex;
    }

    .sidebar {
      width: 220px;
      background-color: #333;
      padding: 20px;
      height: 100vh;
      color: white;
      position: sticky;
      top: 0;
    }

    .sidebar h3 {
      font-size: 20px;
      margin-bottom: 20px;
    }

    .sidebar a {
      display: block;
      color: white;
      text-decoration: none;
      padding: 12px;
      border-radius: 6px;
      margin-bottom: 10px;
      transition: background-color 0.3s ease;
    }

    .sidebar a:hover {
      background-color: #45a049;
    }

    .content {
      flex-grow: 1;
      padding: 20px;
      overflow-x: auto;
    }

    .container {
      max-width: 1000px;
      margin: auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    h3 {
      margin-top: 0;
      text-align: center;
      color: #333;
    }

    .button {
      padding: 10px 16px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .button:hover {
      background-color: #45a049;
      transform: scale(1.03);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
      font-size: 15px;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    td input, td select {
      width: 100%;
      padding: 6px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .assign-form {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-top: 20px;
      justify-content: center;
    }

    .assign-form input {
      flex: 1 1 30%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .assign-form button {
      flex: 1 1 100%;
      max-width: 200px;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .assign-form input {
        flex: 1 1 100%;
      }
    }
  </style>

  <script>
    function loadPickupRequests() {
      const scheduleTable = document.getElementById("scheduleTable").getElementsByTagName("tbody")[0];
      const requests = JSON.parse(localStorage.getItem("scheduleList")) || [];

      scheduleTable.innerHTML = "";

      requests.forEach((request, index) => {
        const newRow = scheduleTable.insertRow();
        newRow.innerHTML = `
          <td>${request.date}</td>
          <td>${request.time}</td>
          <td>${request.wasteType}</td>
          <td>
            <input type="text" placeholder="Driver Name" id="driver-${index}" value="${request.driver || ''}" />
          </td>
          <td>
            <input type="text" placeholder="Vehicle ID" id="vehicle-${index}" value="${request.vehicle || ''}" />
          </td>
          <td>
            <input type="text" placeholder="Route" id="route-${index}" value="${request.route || ''}" />
          </td>
          <td>
            <select id="status-${index}">
              <option value="Pending" ${request.status === "Pending" ? "selected" : ""}>Pending</option>
              <option value="Assigned" ${request.status === "Assigned" ? "selected" : ""}>Assigned</option>
            </select>
          </td>
          <td><button class="button" onclick="assignDriver(${index})">Assign</button></td>
        `;
      });
    }

    function assignDriver(index) {
      const requests = JSON.parse(localStorage.getItem("scheduleList")) || [];

      requests[index].driver = document.getElementById(`driver-${index}`).value;
      requests[index].vehicle = document.getElementById(`vehicle-${index}`).value;
      requests[index].route = document.getElementById(`route-${index}`).value;
      requests[index].status = document.getElementById(`status-${index}`).value;

      localStorage.setItem("scheduleList", JSON.stringify(requests));

      alert("Driver assigned successfully!");
      loadPickupRequests();
    }

    document.addEventListener("DOMContentLoaded", loadPickupRequests);
  </script>
</head>

<body>
  <div class="sidebar">
    <h3>Admin Panel</h3>
    <a href="homeadmin.html">Home</a>
    <a href="manage-schedule.html">Manage Schedules</a>
  </div>

  <div class="content">
    <div class="container">
      <h3>Manage Garbage Pickup Schedules</h3>
      <table id="scheduleTable">
        <thead>
          <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Waste Type</th>
            <th>Driver</th>
            <th>Vehicle</th>
            <th>Route</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>

      <h3>Assign Driver and Vehicle (Optional)</h3>
      <form id="assignForm" class="assign-form">
        <input type="date" id="scheduleDate" required disabled />
        <input type="time" id="scheduleTime" required disabled />
        <input type="text" id="wasteType" placeholder="Waste Type" required disabled />
        <input type="text" id="driverName" placeholder="Driver Name" required />
        <input type="text" id="vehicleID" placeholder="Vehicle ID" required />
        <input type="text" id="route" placeholder="Route" required />
        <button type="submit" class="button">Assign Task</button>
      </form>
    </div>
  </div>
</body>
</html>
