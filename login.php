<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "Ticket";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM register WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $_SESSION['email'] = $email;
        
        header("Location: index.html");
        exit();
    } else {
        echo "<script>alert('invalid email or password')</script>";
       
    }
}

$conn->close();
?>