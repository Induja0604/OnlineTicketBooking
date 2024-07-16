<?php
$servername = "localhost";
$username = "root";
$password = ""; // Password for your MySQL server
$database = "Ticket";

// Create connection
$con = mysqli_connect($servername, $username, $password, $database);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('All fields are required');</script>";
    } elseif ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        // Check if email already exists
        $check_query = "SELECT * FROM register WHERE email='$email'";
        $check_result = mysqli_query($con, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('Email already exists');</script>";
        } else {
            // Insert new user
            $query = "INSERT INTO register (name, email, password, confirm_password) VALUES ('$name', '$email', '$password', '$confirm_password')";
            if (mysqli_query($con, $query)) {
                header("Location: index.html");
                exit();
            } else {
                echo "Error: " . mysqli_error($con);
            }
        }
    }
}

mysqli_close($con);
?>