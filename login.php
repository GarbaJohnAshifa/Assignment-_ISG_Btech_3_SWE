
<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_type = $_POST['user_type'];

    // Validate inputs
    if (empty($email) || empty($password)) {
        echo "Both email and password are required!";
        exit();
    }

    // Secure query
    if ($user_type == 'student') {
        $stmt = $conn->prepare("SELECT * FROM student WHERE email = ?");
    } else if ($user_type == 'admin') {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['user_type'] = $user_type;

            if ($user_type == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: student_dashboard.php");
            }
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }
}
?>
?>
