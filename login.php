<?php
// Database connection
$servername = "localhost";
$username = "root";  // Your MySQL username
$password = "";      // Your MySQL password
$dbname = "login_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Check if the username and password are correct
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password (assuming it's hashed)
        if (password_verify($password, $row['password'])) {
            echo "Welcome, " . $username . "!";
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this username.";
    }
}

$conn->close();
?>
