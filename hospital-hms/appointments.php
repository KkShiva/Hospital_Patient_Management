<?php
include("php/db_config.php");
include("navbar.php"); 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Book Appointment | Hospital HMS</title>
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
    body {
      font-family: Arial;
      background: #f4f4f4;
      padding: 20px;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
    }
    label {
      margin-top: 10px;
      display: block;
      font-weight: bold;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin: 8px 0 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      background-color: #28a745;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      width: 100%;
    }
    .success {
      background: #d4edda;
      color: #155724;
      padding: 10px;
      border: 1px solid #c3e6cb;
      border-radius: 5px;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>🩺 Book a New Appointment</h2>

  <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="success">✅ Appointment booked successfully!</div>
  <?php endif; ?>

  <form method="POST" action="php/add_appointment.php">
    
    <!-- Select Patient -->
    <label for="patient_id">Select Patient:</label>
    <select name="patient_id" required>
      <option value="">-- Select Patient --</option>
      <?php
        $patients = $conn->query("SELECT id, name FROM patients");
        while ($row = $patients->fetch_assoc()) {
          echo "<option value='{$row['id']}'>{$row['name']}</option>";
        }
      ?>
    </select>

    <!-- Select Doctor -->
    <label for="doctor_id">Select Doctor:</label>
    <select name="doctor_id" required>
      <option value="">-- Select Doctor --</option>
      <?php
        $doctors = $conn->query("SELECT doctors.id, doctors.name, departments.name AS dept
                                 FROM doctors
                                 JOIN departments ON doctors.department_id = departments.id");
        while ($doc = $doctors->fetch_assoc()) {
          echo "<option value='{$doc['id']}'>{$doc['name']} ({$doc['dept']})</option>";
        }
      ?>
    </select>

    <!-- Appointment Date -->
    <label for="appointment_date">Appointment Date & Time:</label>
    <input type="datetime-local" name="appointment_date" required>

    <!-- Reason -->
    <label for="reason">Reason for Appointment:</label>
    <textarea name="reason" placeholder="e.g., Fever, Injury, Headache..." rows="3"></textarea>

    <button type="submit">➕ Book Appointment</button>
  </form>
</div>

</body>
</html>
