<?php
include 'connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Collect and trim data from the form
    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 2. Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // 3. Explicitly set isAdmin to 0 for all new registrations
    $isAdmin = 0; 

    // 4. Update the query to include the isAdmin column
    $stmt = $conn->prepare("INSERT INTO users (fullName, email, passwordHash, isAdmin) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $fullName, $email, $hashedPassword, $isAdmin);

    if ($stmt->execute()) {
        echo "<script>alert('Account created successfully!'); window.location.href='index.php';</script>";
    } else {
        // Check if the error is a duplicate email
        // Check for duplicate entry error code (1062)
if ($conn->errno === 1062) {
    echo "<script>alert('This email is already registered. Please use another one.'); window.location.href='index.php';</script>";
} else {
    echo "Error: " . $stmt->error;
}
    }

    $stmt->close();
    $conn->close();
}
?>