<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'internship'); // Replace 'test' with your database name

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected specialty from the form
$specialty = $_POST['specialty'];

// SQL query to fetch attendance records
$sql = "SELECT students.stdt_name, attendance.status, attendance.date 
        FROM attendance 
        INNER JOIN students ON attendance.std_email = students.std_email 
        WHERE students.speciality = '$specialty'";

$result = $conn->query($sql);

// Check if the query executed successfully
if (!$result) {
    die("Error in SQL Query: " . $conn->error);
}

// Check if attendance records exist
if ($result->num_rows > 0) {
    echo "<table border='1'>
          <tr><th>Name</th><th>Status</th><th>Date</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['stdt_name'] . "</td><td>" . $row['status'] . "</td><td>" . $row['date'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No attendance records found for the selected specialty.";
}

// Close the database connection
$conn->close();
?>

