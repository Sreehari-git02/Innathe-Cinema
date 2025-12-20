<?php
// Enable error reporting to find issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php'; 

// 1. Fetch the existing data when the page loads
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $conn->prepare("SELECT * FROM movies WHERE movieId = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
    } else {
        die("Error: Movie with ID $id not found.");
    }
} else if (!isset($_POST['movieId'])) {
    header("Location: admin.php");
    exit();
}

// 2. Handle the Update Request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['movieId'];
    $title = $_POST['movieTitle'];
    $desc = $_POST['movieDescription'];
    $year = $_POST['releaseYear'];
    $rating = $_POST['avgRating'];
    
    // Set the default path to the current existing path
    $path = $movie['posterPath']; 

    // Check if a new file was actually selected for upload
    if (!empty($_FILES["moviePoster"]["name"])) {
        $targetDir = "../assets/images/";
        // Use timestamp to prevent duplicate filename issues
        $fileName = time() . "_" . basename($_FILES["moviePoster"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        
        $allowTypes = array('jpg', 'png', 'jpeg', 'webp');
        if (in_array(strtolower($fileType), $allowTypes)) {
            if (move_uploaded_file($_FILES["moviePoster"]["tmp_name"], $targetFilePath)) {
                $path = $targetFilePath; // Update path to the new file
            } else {
                echo "Error: Failed to upload image.";
            }
        } else {
            echo "Error: Only JPG, JPEG, PNG, & WEBP files are allowed.";
        }
    }

    // Update query
    $updateStmt = $conn->prepare("UPDATE movies SET movieTitle=?, movieDescription=?, posterPath=?, releaseYear=?, avgRating=? WHERE movieId=?");
    $updateStmt->bind_param("sssidi", $title, $desc, $path, $year, $rating, $id);

    if ($updateStmt->execute()) {
        echo "<script>alert('Updated successfully!'); window.location.href='admin.php';</script>";
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Movie - Innathe Cinema</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="admin-form-container" style="max-width:600px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <h2>Edit Movie: <?php echo htmlspecialchars($movie['movieTitle'] ?? 'New Movie'); ?></h2>
        
        <form action="editmovie.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="movieId" value="<?php echo $movie['movieId']; ?>">
            
            <div style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold;">Movie Title</label>
                <input type="text" name="movieTitle" value="<?php echo htmlspecialchars($movie['movieTitle']); ?>" required style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;">
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold;">Description</label>
                <textarea name="movieDescription" rows="5" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;"><?php echo htmlspecialchars($movie['movieDescription']); ?></textarea>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold;">Change Movie Poster</label>
                <p style="font-size: 0.8rem; color: #666;">Current: <?php echo htmlspecialchars($movie['posterPath'] ?? ''); ?></p>
                <input type="file" name="moviePoster" accept="image/*" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;">
                <small>Leave blank to keep the current poster.</small>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold;">Release Year</label>
                <input type="number" name="releaseYear" value="<?php echo $movie['releaseYear']; ?>" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display:block; font-weight:bold;">Average Rating</label>
                <input type="number" step="0.01" name="avgRating" value="<?php echo $movie['avgRating']; ?>" style="width:100%; padding:10px; border:1px solid #ccc; border-radius:4px;">
            </div>
            
            <button type="submit" style="background-color: #e50914; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px;">Update Movie Information</button>
            <br><br>
            <a href="admin.php" style="text-decoration: none; color: #555; display: block; text-align: center;">Cancel and Go Back</a>
        </form>
    </div>
</body>
</html>