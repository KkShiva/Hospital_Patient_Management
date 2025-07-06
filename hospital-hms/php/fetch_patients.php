<?php
include("db_config.php");

$sql = "SELECT p.*, d.name AS doctor_name, dp.name AS dept_name
        FROM patients p
        LEFT JOIN doctors d ON p.doctor_id = d.id
        LEFT JOIN departments dp ON d.department_id = dp.id
        ORDER BY p.id DESC";

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  echo "<tr>";
  echo "<td>{$row['id']}</td>";
  echo "<td>" . htmlspecialchars($row['name']) . "</td>";
  echo "<td>{$row['age']}</td>";
  echo "<td>{$row['gender']}</td>";
  echo "<td>{$row['contact']}</td>";
  echo "<td>" . htmlspecialchars($row['address']) . "</td>";
  echo "<td>" . htmlspecialchars($row['medical_history']) . "</td>";
  echo "<td>" . htmlspecialchars($row['doctor_name'] . " ({$row['dept_name']})") . "</td>"; // NEW
  echo "<td>
          <a href='php/edit_patient.php?id={$row['id']}'>✏️ Edit</a>
<a href='php/delete_patient.php?id={$row['id']}' onclick=\"return confirm('Delete this patient?');\">🗑 Delete</a>
        </td>";
  echo "</tr>";
}


$conn->close();
?>
