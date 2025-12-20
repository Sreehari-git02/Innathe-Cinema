<?php
session_start();
include 'connect.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1. Query to select the user and their admin status
    // Note: Ensure your table column names match (userId, fullName, passwordHash, isAdmin)
    $stmt = $conn->prepare("SELECT userId, fullName, passwordHash, isAdmin FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // 2. Verify the submitted password against the hash in the database
        if (password_verify($password, $user['passwordHash'])) {
            // Regenerate session ID for security
            session_regenerate_id();

            // 3. Store user data and Admin status in the Session
            $_SESSION['user_id'] = $user['userId'];
            $_SESSION['user_name'] = $user['fullName'];
            $_SESSION['isAdmin'] = (int)$user['isAdmin']; // Cast to integer (0 or 1)

            echo "<script>alert('Login successful! Welcome " . addslashes($user['fullName']) . "'); window.location.href='index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Invalid password.'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('No account found with that email.'); window.location.href='index.php';</script>";
    }

    $stmt->close();
}
$conn->close();
?>