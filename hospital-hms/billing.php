<?php
include("php/db_config.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Patient Billing Summary</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f3f8;
      padding: 30px;
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: left;
    }
    th {
      background: #007bff;
      color: white;
    }
    .discharged {
      background: #d4edda;
    }
    .not-yet {
      background: #fff3cd;
    }
  </style>
</head>
<body>

<h2>🧾 Patient Billing & Discharge Summary</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Room No</th>
    <th>Admitted On</th>
    <th>Discharge Date</th>
    <th>Room Charges</th>
    <th>Consultation</th>
    <th>Treatment</th>
    <th>Pharmacy</th>
    <th>Services</th>
    <th>Total Bill</th>
  </tr>

<?php
$sql = "SELECT * FROM patients WHERE admitted_in IS NOT NULL ORDER BY id DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  $total = $row['room_charges'] + $row['consultation_charges'] + $row['treatment_charges'] + $row['pharmacy_charges'];
  $row_class = $row['discharge_datetime'] ? "discharged" : "not-yet";

  echo "<tr class='$row_class'>";
  echo "<td>{$row['id']}</td>";
  echo "<td>" . htmlspecialchars($row['name']) . "</td>";
  echo "<td>{$row['room_no']}</td>";
  echo "<td>{$row['admitted_in']}</td>";
  echo "<td>" . ($row['discharge_datetime'] ?? ("Est: " . $row['estimated_discharge'])) . "</td>";
  echo "<td>₹{$row['room_charges']}</td>";
  echo "<td>₹{$row['consultation_charges']}</td>";
  echo "<td>₹{$row['treatment_charges']}</td>";
  echo "<td>₹{$row['pharmacy_charges']}</td>";
  echo "<td>" . htmlspecialchars($row['services_used']) . "</td>";
  echo "<td><strong>₹" . number_format($total, 2) . "</strong></td>";
  echo "</tr>";
}
$conn->close();
?>

</table>

</body>
</html>
