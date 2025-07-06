# 🏥 Hospital-HMS (Hospital Management System)

A simple, functional Hospital Management System built with **PHP** and **MySQL**, featuring a lightweight and responsive UI. This system allows hospitals to manage patients, doctors, departments, appointments, and patient details including admissions, room charges, and services.

---

## 💡 Features

- 👨‍⚕️ Add, view, edit, and delete Patients
- 🏥 Manage Departments and assign Doctors
- 📅 Book and view Appointments
- 🛏 Track Patient Admissions, Room No., Services used, Charges
- 📦 Pharmacy, Consultation, and Treatment cost tracking
- 📄 Estimate and Record Discharge Date & Time
- 📊 Dashboard with quick access to all modules

---

## 🧰 Tech Stack

- Frontend: HTML, CSS (Vanilla)
- Backend: PHP
- Database: MySQL
- Server: XAMPP / WAMP / Hosting provider with PHP & MySQL support

---

## 🚀 Getting Started

### 1. Clone or Download

```bash
git clone https://github.com/YOUR_USERNAME/hospital-hms.git
```
Or download the ZIP and extract to a folder.

2. Import Database
Open phpMyAdmin

Create a new database named:

```bash
hospital
```


Import the SQL dump:

```bash
hospital-hms/database/hospital.sql
```

3. Configure Database Connection
Edit php/db_config.php and set your DB credentials:

```bash
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";
```

4. Run Locally with XAMPP/WAMP
Place the project folder hospital-hms in:

```bash
C:\xampp\htdocs\  (for XAMPP)
```

Start Apache and MySQL from XAMPP Control Panel

Open browser:

```bash
http://localhost/hospital-hms/
```


🌐 Hosting on Web Server
To host it online:

Upload all files to your hosting server (e.g., cPanel, Hostinger, etc.)

Create a MySQL database on your hosting provider

Import hospital.sql into that DB

Update php/db_config.php with your hosting DB credentials

Set permissions if needed for file access
