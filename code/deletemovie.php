<?php
include 'connect.php';

// Check if an ID was provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM movies WHERE movieId = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Movie deleted successfully!'); window.location.href='admin.php';</script>";
    } else {
        echo "Error deleting movie: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    // If no ID is provided, redirect back to admin
    header("Location: admin.php");
    exit();
}
?>