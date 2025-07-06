<?php
include("db_config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $appointment_id = $_POST['appointment_id'];
  $new_status = $_POST['status'];

  $sql = "UPDATE appointments SET status = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $new_status, $appointment_id);

  if ($stmt->execute()) {
    header("Location: http://localhost/hospital-hms/view_appointments.php");
    exit();
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}

$conn->close();
?>
