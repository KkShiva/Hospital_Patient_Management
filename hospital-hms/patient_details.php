<?php
include("php/db_config.php");
include("navbar.php"); 

$sql = "SELECT p.*, d.name AS doctor_name
        FROM patients p
        LEFT JOIN doctors d ON p.doctor_id = d.id
        ORDER BY p.id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Patient Details</title>
  <link rel="stylesheet" href="css/style.css">
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
    .toggle-btn {
      width: 100%;
      text-align: left;
      padding: 10px;
      font-size: 16px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      margin-bottom: 5px;
    }
    .patient-details {
      border: 1px solid #ccc;
      padding: 10px;
      background: #f9f9f9;
      margin-bottom: 15px;
      border-radius: 5px;
    }
  </style>
</head>
<body>




<h2>Patient Extended Details</h2>
<input type="text" id="patientSearch" placeholder="🔍 Search patient by name or ID" style="width: 100%; padding: 8px; margin-bottom: 10px;">

<?php
$services = [
  "Blood Test" => 500,
  "X-Ray" => 800,
  "ECG" => 600,
  "Physiotherapy" => 400,
  "MRI Scan" => 3500
];

while ($row = $result->fetch_assoc()):
  $used_services = explode(",", $row['services_used'] ?? "");
  $services_total = 0;
?>

<div class="patient-container">
  <button class="toggle-btn" onclick="toggleDetails('details<?= $row['id'] ?>')">
    👤 <?= htmlspecialchars($row['name']) ?> (ID: <?= $row['id'] ?>)
  </button>
  <div id="details<?= $row['id'] ?>" class="patient-details" style="display:none;">
    <form method="POST" action="php/update_patient_details.php">
      <input type="hidden" name="patient_id" value="<?= $row['id'] ?>">

      <p><strong>Assigned Doctor:</strong> <?= htmlspecialchars($row['doctor_name']) ?></p>

      <label>Admitted In:</label>
      <input type="date" name="admitted_in" value="<?= $row['admitted_in'] ?>"><br>

      <label>Room No:</label>
      <input type="text" name="room_no" value="<?= $row['room_no'] ?>"><br>

      <label>Basic Services Used:</label><br>
      <?php foreach ($services as $service => $price): 
        $checked = in_array($service, $used_services) ? "checked" : "";
        if ($checked) $services_total += $price;
      ?>
        <label><input type='checkbox' name='services_used[]' value='<?= $service ?>' <?= $checked ?>> <?= $service ?> (₹<?= $price ?>)</label><br>
      <?php endforeach; ?>

      <label>Consultation Charges:</label>
      <input type="number" name="consultation_charges" value="<?= $row['consultation_charges'] ?>"><br>

      <label>Treatment Charges:</label>
      <input type="number" name="treatment_charges" value="<?= $row['treatment_charges'] ?>"><br>

      <label>Room Charges:</label>
      <input type="number" name="room_charges" value="<?= $row['room_charges'] ?>"><br>

      <label>Pharmacy Charges:</label>
      <input type="number" name="pharmacy_charges" value="<?= $row['pharmacy_charges'] ?>"><br>

      <label>Discharge Date & Time:</label>
      <input type="datetime-local" name="discharge_datetime" value="<?= $row['discharge_datetime'] ?>"><br>

      <label>Estimated Discharge Date:</label>
      <input type="date" name="estimated_discharge" value="<?= $row['estimated_discharge'] ?>"><br>

      <?php
        $consult = $row['consultation_charges'] ?? 0;
        $treat = $row['treatment_charges'] ?? 0;
        $room = $row['room_charges'] ?? 0;
        $pharm = $row['pharmacy_charges'] ?? 0;
        $grand_total = $consult + $treat + $room + $pharm + $services_total;
      ?>

      <h4>Total Breakdown:</h4>
      <ul>
        <li>🧪 Services Total: ₹<?= $services_total ?></li>
        <li>👨‍⚕️ Consultation: ₹<?= $consult ?></li>
        <li>💊 Treatment: ₹<?= $treat ?></li>
        <li>🛏 Room: ₹<?= $room ?></li>
        <li>🏪 Pharmacy: ₹<?= $pharm ?></li>
        <li><strong>💰 Grand Total: ₹<?= $grand_total ?></strong></li>
      </ul>

      <button type="submit">💾 Save</button>
    </form>
  </div>
</div>
<?php endwhile; ?>

<script>
function toggleDetails(id) {
  const el = document.getElementById(id);
  el.style.display = el.style.display === "none" ? "block" : "none";
}

document.getElementById("patientSearch").addEventListener("keyup", function () {
  const filter = this.value.toLowerCase();
  const patients = document.getElementsByClassName("patient-container");
  for (let p of patients) {
    const text = p.innerText.toLowerCase();
    p.style.display = text.includes(filter) ? "" : "none";
  }
});
</script>

</body>
</html>
