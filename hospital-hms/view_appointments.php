<?php
include("php/db_config.php");
include("navbar.php"); 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Appointments | Hospital HMS</title>
  <style>
     /* Navbar styles */
.navbar {
  background-color: #007bff;
  padding: 15px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: white;
}
.navbar h1 {
  margin: 0;
  font-size: 1.8rem;
}
.nav-links {
  display: flex;
  gap: 15px;
}
.nav-links a {
  color: white;
  text-decoration: none;
  font-weight: bold;
}
.nav-links a:hover {
  color: #ffeb3b;
} 
    body { font-family: Arial; background: #f8f9fa; padding: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
    th, td { border: 1px solid #ccc; padding: 12px; text-align: left; }
    th { background-color: #007bff; color: white; }
    h2 { text-align: center; }
    form { display: inline; }
    .status-btn {
      padding: 5px 10px;
      border: none;
      border-radius: 4px;
      color: white;
      cursor: pointer;
    }
    .completed { background: #28a745; }
    .cancelled { background: #dc3545; }
    .pending { background: #ffc107; color: black; }
  </style>
</head>
<body>

<h2>📅 Appointment Records</h2>

<table>
  <thead>
    <tr>
      <th>Patient</th>
      <th>Doctor</th>
      <th>Department</th>
      <th>Date & Time</th>
      <th>Reason</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sql = "SELECT a.id, a.reason, a.appointment_date, a.status,
                     p.name AS patient_name,
                     d.name AS doctor_name,
                     dept.name AS department_name
              FROM appointments a
              JOIN patients p ON a.patient_id = p.id
              JOIN doctors d ON a.doctor_id = d.id
              JOIN departments dept ON d.department_id = dept.id
              ORDER BY a.appointment_date DESC";
              
      $result = $conn->query($sql);

      while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['patient_name']}</td>";
        echo "<td>{$row['doctor_name']}</td>";
        echo "<td>{$row['department_name']}</td>";
        echo "<td>{$row['appointment_date']}</td>";
        echo "<td>{$row['reason']}</td>";
        
        // Display current status
        $status = ucfirst($row['status']);
        $colorClass = ($status == "Completed") ? "completed" :
                      (($status == "Cancelled") ? "cancelled" : "pending");
        echo "<td><span class='status-btn $colorClass'>$status</span></td>";

        // Update form buttons
        echo "<td>
                <form method='POST' action='php/update_status.php'>
                  <input type='hidden' name='appointment_id' value='{$row['id']}'>
                  <button class='status-btn completed' name='status' value='Completed'>Complete</button>
                  <button class='status-btn cancelled' name='status' value='Cancelled'>Cancel</button>
                </form>
              </td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>

</body>
</html>
