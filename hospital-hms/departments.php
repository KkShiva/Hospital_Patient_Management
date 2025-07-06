<?php
include("php/db_config.php");
include("navbar.php"); 

$sql = "SELECT d.name AS dept_name, doc.name AS doc_name, doc.specialization, doc.contact
        FROM departments d
        LEFT JOIN doctors doc ON d.id = doc.department_id
        ORDER BY d.id, doc.name";

$result = $conn->query($sql);

$departments = [];

while ($row = $result->fetch_assoc()) {
    $departments[$row['dept_name']][] = [
        'name' => $row['doc_name'],
        'specialization' => $row['specialization'],
        'contact' => $row['contact']
    ];
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Departments & Doctors</title>
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
        body { font-family: Arial, sans-serif; background: #f0f2f5; padding: 30px; }
        .department {
            background: #fff;
            margin-bottom: 30px;
            padding: 20px;
            border-left: 5px solid #007BFF;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        h2 { color: #007BFF; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>

<h1>🏥 Hospital Departments & Assigned Doctors</h1>

<?php foreach ($departments as $deptName => $doctors): ?>
    <div class="department">
        <h2><?= htmlspecialchars($deptName) ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Doctor Name</th>
                    <th>Specialization</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doctors as $doc): ?>
                    <tr>
                        <td><?= htmlspecialchars($doc['name']) ?></td>
                        <td><?= htmlspecialchars($doc['specialization']) ?></td>
                        <td><?= htmlspecialchars($doc['contact']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endforeach; ?>

</body>
</html>
