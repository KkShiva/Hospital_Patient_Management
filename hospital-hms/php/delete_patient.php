<?php
include("db_config.php");

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $stmt = $conn->prepare("DELETE FROM patients WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
}

header("Location: http://localhost/hospital-hms/patients.php");
exit();
?>
