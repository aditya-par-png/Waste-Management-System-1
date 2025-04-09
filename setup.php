<?php
// Database configuration
$server = "localhost";
$username = "root";
$password = "";
$db = "garbage_management";

// Establish connection to MySQL server
$conn = new mysqli($server, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $db";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Connect to the newly created database
$conn->select_db($db);

// Create User table
$sql_user = "CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    contact_number VARCHAR(20),
    address VARCHAR(255)
)";
if ($conn->query($sql_user) === TRUE) {
    echo "User table created successfully.<br>";
} else {
    die("Error creating User table: " . $conn->error);
}

// Create Login table
$sql_login = "CREATE TABLE IF NOT EXISTS login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNIQUE KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id)
)";
if ($conn->query($sql_login) === TRUE) {
    echo "Login table created successfully.<br>";
} else {
    die("Error creating Login table: " . $conn->error);
}

// Create Route table
$sql_route = "CREATE TABLE IF NOT EXISTS route (
    id INT AUTO_INCREMENT PRIMARY KEY,
    route_name VARCHAR(100) NOT NULL,
    description TEXT
)";
if ($conn->query($sql_route) === TRUE) {
    echo "Route table created successfully.<br>";
} else {
    die("Error creating Route table: " . $conn->error);
}

// Create Schedule table
$sql_schedule = "CREATE TABLE IF NOT EXISTS schedule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    pickup_date DATE NOT NULL,
    pickup_time TIME NOT NULL,
    waste_type VARCHAR(50) NOT NULL,
    route_id INT NOT NULL,
    status ENUM('Pending', 'Completed') DEFAULT 'Pending',
    FOREIGN KEY (user_id) REFERENCES user(id),
    FOREIGN KEY (route_id) REFERENCES route(id)
)";
if ($conn->query($sql_schedule) === TRUE) {
    echo "Schedule table created successfully.<br>";
} else {
    die("Error creating Schedule table: " . $conn->error);
}

// Close connection
$conn->close();
?>
