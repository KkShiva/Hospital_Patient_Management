<?php
include("db_config.php");

// Get patient ID and validate
$patient_id = isset($_POST['patient_id']) ? intval($_POST['patient_id']) : 0;
if ($patient_id <= 0) {
    die("❌ Invalid patient ID.");
}

// Gather form data
$admitted_in = $_POST['admitted_in'] ?? null;
$room_no = $_POST['room_no'] ?? null;
$services_used = isset($_POST['services_used']) ? implode(",", $_POST['services_used']) : "";
$consultation_charges = floatval($_POST['consultation_charges'] ?? 0);
$treatment_charges = floatval($_POST['treatment_charges'] ?? 0);
$room_charges = floatval($_POST['room_charges'] ?? 0);
$pharmacy_charges = floatval($_POST['pharmacy_charges'] ?? 0);
$discharge_datetime = $_POST['discharge_datetime'] ?? null;
$estimated_discharge = $_POST['estimated_discharge'] ?? null;

// Prepare SQL
$sql = "UPDATE patients SET 
            admitted_in = ?, 
            room_no = ?, 
            services_used = ?, 
            consultation_charges = ?, 
            treatment_charges = ?, 
            room_charges = ?, 
            pharmacy_charges = ?, 
            discharge_datetime = ?, 
            estimated_discharge = ? 
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssssddddsi",
    $admitted_in,
    $room_no,
    $services_used,
    $consultation_charges,
    $treatment_charges,
    $room_charges,
    $pharmacy_charges,
    $discharge_datetime,
    $estimated_discharge,
    $patient_id
);

// Execute and redirect
if ($stmt->execute()) {
    header("Location: ../patient_details.php?success=1");
    exit();
} else {
    echo "❌ Error updating patient: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
