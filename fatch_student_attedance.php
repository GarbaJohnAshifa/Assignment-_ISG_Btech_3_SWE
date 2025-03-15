<?php

// Database connection
$conn = new mysqli('localhost', 'root', '', 'internship'); // Replace 'test' with your database name
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected specialty from the form
$specialty = $_POST['specialty'];

// SQL query to fetch students based on the specialty
$sql = "SELECT * FROM students WHERE speciality = '$specialty'";
$result = $conn->query($sql);

// Check if the query executed successfully
if (!$result) {
    die("Error in SQL Query: " . $conn->error);
}

// Check if any students were found
if ($result->num_rows > 0) {
    // Start the attendance form
    echo "<form action='save_attendance.php' method='POST'>";
    echo "<input type='hidden' name='specialty' value='$specialty'>";

    // Display each student with attendance options
    while ($row = $result->fetch_assoc()) {
        echo "<input type='hidden' name='student_emails[]' value='" . $row['std_email'] . "'>";
        echo $row['stdt_name'] . ": ";
        echo "<input type='radio' name='attendance[" . $row['std_email'] . "]' value='Present' required> Present ";
        echo "<input type='radio' name='attendance[" . $row['std_email'] . "]' value='Absent' required> Absent <br>";
    }

    // Submit button
    echo "<button type='submit'>Save Attendance</button>";
    echo "</form>";
} else {
    // No students found message
    echo "No students found for the selected specialty.";
}

// Close the database connection
$conn->close();
?>

