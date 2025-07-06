<?php
include("db_config.php");

// Retrieve POST values safely
$name = $_POST['name'] ?? '';
$age = $_POST['age'] ?? 0;
$gender = $_POST['gender'] ?? '';
$contact = $_POST['contact'] ?? '';
$address = $_POST['address'] ?? '';
$medical_history = $_POST['medical_history'] ?? '';
$doctor_id = $_POST['doctor_id'] ?? null;

// Basic validation
if (empty($name) || empty($age) || empty($gender) || empty($contact) || empty($address) || empty($doctor_id)) {
    die("❌ Required fields missing");
}

// Prepare SQL for only those 7 columns
$sql = "INSERT INTO patients 
(name, age, gender, contact, address, medical_history, doctor_id) 
VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sissssi", $name, $age, $gender, $contact, $address, $medical_history, $doctor_id);

// Execute and redirect
if ($stmt->execute()) {
    header("Location: http://localhost/hospital-hms/patients.php");
    exit();
} else {
    echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
