<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'service_providers';
// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    echo "<div class='failure-message'>Database connection failure!</div>";
} else {
    echo "<div class='success-message'>Connected to database successfully!</div>";
}
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $reg_num = $_POST["reg_num"];
    $service_type = $_POST["service_type"];

    // Insert data into table
    $sql = "INSERT INTO servicepro (full_name, email, phone, reg_num, service_type) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $full_name, $email, $phone, $reg_num, $service_type);
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to a success page or display a success message
    echo "<div class='success-message'>Data saved successfully!</div>";
    exit;
}

?>