<?php
include("db_config.php");

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $result = $conn->query("SELECT * FROM patients WHERE id = $id");
  $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $age = $_POST['age'];
  $gender = $_POST['gender'];
  $contact = $_POST['contact'];
  $address = $_POST['address'];
  $medical_history = $_POST['medical_history'];

  $stmt = $conn->prepare("UPDATE patients SET name=?, age=?, gender=?, contact=?, address=?, medical_history=? WHERE id=?");
  $stmt->bind_param("sissssi", $name, $age, $gender, $contact, $address, $medical_history, $id);
  $stmt->execute();

  header("Location: http://localhost/hospital-hms/patients.php");
  exit();
}
?>

<form method="POST">
  <input type="hidden" name="id" value="<?= $row['id'] ?>">
  <input name="name" value="<?= htmlspecialchars($row['name']) ?>">
  <input name="age" type="number" value="<?= $row['age'] ?>">
  <input name="gender" value="<?= $row['gender'] ?>">
  <input name="contact" value="<?= $row['contact'] ?>">
  <textarea name="address"><?= htmlspecialchars($row['address']) ?></textarea>
  <textarea name="medical_history"><?= htmlspecialchars($row['medical_history']) ?></textarea>
  <button type="submit">💾 Update</button>
</form>
