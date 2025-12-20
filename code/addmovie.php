<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['movieTitle'];
    $desc = $_POST['movieDescription'];
    $year = $_POST['releaseYear'];
    $rating = $_POST['avgRating'];

    // 1. Setup the folder where the image will be saved
    $targetDir = "../assets/images/"; 
    $fileName = time() . "_" . basename($_FILES["moviePoster"]["name"]); // Added time() to prevent duplicate names
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // 2. Validate the file type
    $allowTypes = array('jpg', 'png', 'jpeg', 'webp');
    if (in_array(strtolower($fileType), $allowTypes)) {
        
        // 3. Move file from temporary computer storage to your project folder
        if (move_uploaded_file($_FILES["moviePoster"]["tmp_name"], $targetFilePath)) {
            
            // Path to save in the database so index.php can find it
            $dbPath = "../assets/images/" . $fileName;

            $stmt = $conn->prepare("INSERT INTO movies (movieTitle, movieDescription, posterPath, releaseYear, avgRating) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssidi", $title, $desc, $dbPath, $year, $rating);

            if ($stmt->execute()) {
                echo "<script>alert('Movie and Image uploaded successfully!'); window.location.href='admin.php';</script>";
            } else {
                echo "Database Error: " . $conn->error;
            }
            $stmt->close();
        } else {
            echo "Error: Could not upload the file to the folder. Check folder permissions.";
        }
    } else {
        echo "Error: Only JPG, JPEG, PNG, & WEBP files are allowed.";
    }
    $conn->close();
}
?>