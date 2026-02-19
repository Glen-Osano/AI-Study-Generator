<?php
// Database Configuration
$host = "localhost";
$user = "root";
$pass = "";
$db = "ai_study";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// ===============================
// AI CONFIGURATION
// ===============================

// Demo mode (true = mock AI response, false = real API call)
$DEMO_MODE = true;

// If using real API later
$OPENAI_API_KEY = "YOUR_API_KEY_HERE";

?>
