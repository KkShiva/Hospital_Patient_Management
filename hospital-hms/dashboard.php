<!DOCTYPE html>
<html>
<head>
  <title>🏥 Hospital Patient Management</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background: linear-gradient(to right, #e3f2fd, #ffffff);
    }

    /* NAVBAR */
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
      transition: color 0.3s ease;
    }

    .nav-links a:hover {
      color: #ffeb3b;
    }

    /* DASHBOARD */
    .dashboard-container {
      padding: 40px 20px;
      display: flex;
      justify-content: center;
    }

    .dashboard {
      width: 100%;
      max-width: 1000px;
      background: #ffffff;
      border-radius: 12px;
      padding: 40px 30px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .dashboard h2 {
      font-size: 2rem;
      margin-bottom: 30px;
      color: #007bff;
    }

    .dashboard-grid {
      display: grid;
      gap: 20px;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    }

    .dashboard-item {
      background-color: #f8f9fa;
      border: 2px solid #007bff33;
      border-radius: 12px;
      padding: 25px 15px;
      text-decoration: none;
      color: #333;
      font-size: 1.1rem;
      font-weight: 600;
      transition: all 0.3s;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .dashboard-item:hover {
      background-color: #007bff;
      color: white;
      transform: scale(1.03);
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <h1>🏥 Hospital Patient Management</h1>
    <div class="nav-links">
      <a href="patients.php">Patients</a>
      <a href="appointments.php">Appointments</a>
      <a href="departments.php">Departments</a>
      <a href="view_appointments.php">View Appointments</a>
      <a href="patient_details.php">Patient Details</a>
    </div>
  </div>

  <!-- Dashboard -->
  <div class="dashboard-container">
    <div class="dashboard">
      <h2>📊 Dashboard</h2>
      <div class="dashboard-grid">
        <a href="patients.php" class="dashboard-item">👨‍⚕️ View Patients</a>
        <a href="appointments.php" class="dashboard-item">📅 Book Appointments</a>
        <a href="departments.php" class="dashboard-item">🏥 Departments</a>
        <a href="view_appointments.php" class="dashboard-item">🔍 Appointment Records</a>
        <a href="patient_details.php" class="dashboard-item">🧾 Patient Details</a>
        <a href="billing.php" class="dashboard-item">🧾 Billing Details</a>
      </div>
    </div>
  </div>

</body>
</html>
