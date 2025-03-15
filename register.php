<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $speciality = $_POST['speciality'];

    if ($password == $confirm_password) {
        $sql = "INSERT INTO students (stdt_name, std_email, std_password, speciality) VALUES ('$name', '$email', '$password', '$speciality')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
            // Redirect to login page or dashboard
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Passwords do not match.";
    }
}
?>