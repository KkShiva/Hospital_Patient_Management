<?php
include("navbar.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Patient Management</title>
  <link rel="stylesheet" href="css/styles.css">
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
    body { font-family: Arial; padding: 20px; background: #f2f2f2; }
    h2, h3 { color: #333; }
    form, table { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
    input, select, textarea, button {
      width: 100%; padding: 10px; margin-top: 10px; border: 1px solid #ccc; border-radius: 4px;
    }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    th { background-color: #007BFF; color: white; }
    tr:nth-child(even) { background-color: #f9f9f9; }
  </style>
</head>
<body>

  <h2>🧑‍⚕️ Patient Management</h2>

<!-- Add Patient Form -->
<form id="patientForm" method="POST" action="php/add_patient.php">
  <h3>Add New Patient</h3>
  <input type="text" name="name" placeholder="Full Name" required>
  <input type="number" name="age" placeholder="Age" required>

  <select name="gender" required>
    <option value="">Select Gender</option>
    <option>Male</option>
    <option>Female</option>
    <option>Other</option>
  </select>

  <input type="text" name="contact" placeholder="Contact Number" required>
  <textarea name="address" placeholder="Address" required></textarea>
  <textarea name="medical_history" placeholder="Medical History (optional)"></textarea>

  <!-- ✅ This was previously outside the form -->
  <label for="doctor_id">Assign Doctor:</label>
  <select name="doctor_id" required>
    <option value="">-- Select Doctor --</option>
    <?php
      include("php/db_config.php");
      $doc_sql = "SELECT doctors.id, doctors.name, departments.name AS dept
                  FROM doctors
                  JOIN departments ON doctors.department_id = departments.id";
      $doc_result = $conn->query($doc_sql);
      while ($doc = $doc_result->fetch_assoc()) {
        echo "<option value='{$doc['id']}'>{$doc['name']} ({$doc['dept']})</option>";
      }
    ?>
  </select>

  <button type="submit">➕ Add Patient</button>
</form>

  <!-- Show All Patients -->
  <h3>📋 All Patients</h3>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Full Name</th>
        <th>Age</th>
        <th>Gender</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Medical History</th>
      </tr>
    </thead>
    <tbody>
      <?php include("php/fetch_patients.php"); ?>
    </tbody>
  </table>

</body>
</html>
