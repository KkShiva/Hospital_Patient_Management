<?php
include("db_config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $patient_id = $_POST['patient_id'] ?? null;
  $doctor_id = $_POST['doctor_id'] ?? null;
  $appointment_date = $_POST['appointment_date'] ?? null;
  $reason = $_POST['reason'] ?? '';

  if ($patient_id && $doctor_id && $appointment_date) {
    $sql = "INSERT INTO appointments (patient_id, doctor_id, appointment_date, reason) 
            VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $patient_id, $doctor_id, $appointment_date, $reason);

    if ($stmt->execute()) {
      header("Location: http://localhost/hospital-hms/appointments.php?success=1");
      exit();
    } else {
      echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo "❌ All required fields are not set.";
  }
}

$conn->close();
?>
