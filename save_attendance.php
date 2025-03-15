<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'internship'); // Fixed the empty string issue
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure attendance data is received
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $attendance = $_POST['attendance']; // Array of attendance
    $date = date('Y-m-d'); // Today's date

    // Loop through attendance and save it to the database
    foreach ($attendance as $student_email => $status) {
        $sql = "INSERT INTO attendance (std_email, status, date) VALUES ('$student_email', '$status', '$date')";

        if (!$conn->query($sql)) {
            echo "Error saving attendance for $student_email: " . $conn->error . "<br>";
        }
    }

    echo "Attendance saved successfully!";
} else {
    echo "No attendance data received.";
}

// Close the database connection
$conn->close();
?>
