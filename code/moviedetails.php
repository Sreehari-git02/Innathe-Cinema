<?php
session_start();
include 'connect.php';

if (isset($_GET['id'])) {
    $movieId = $_GET['id'];

    // 1. Fetch Movie Details
    $stmt = $conn->prepare("SELECT * FROM movies WHERE movieId = ?");
    $stmt->bind_param("i", $movieId);
    $stmt->execute();
    $movieResult = $stmt->get_result();
    $movie = $movieResult->fetch_assoc();

    if (!$movie) {
        die("Movie not found.");
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($movie['movieTitle'] ?? 'Movie Details'); ?> - Innathe Cinema</title>
    <link rel="stylesheet" href="../style/style.css">
    <style>
        .detailsContainer { 
            max-width: 900px; 
            margin: 50px auto; 
            display: flex; 
            gap: 40px; 
            padding: 30px; 
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .detailsPoster { 
            width: 350px; 
            height: auto;
            border-radius: 10px; 
            object-fit: cover;
        }
        .movieInfo h1 { margin-top: 0; color: #333; }
        .ratingTag { font-size: 1.2rem; color: #e50914; font-weight: bold; }
        .descriptionText { line-height: 1.6; color: #555; margin-top: 20px; }
        .backBtn { 
            display: inline-block; 
            margin-top: 20px; 
            text-decoration: none; 
            color: #e50914; 
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <div class="detailsContainer">
        <img src="<?php echo htmlspecialchars($movie['posterPath'] ?? '../assets/images/placeholder.png'); ?>" class="detailsPoster" alt="Poster">
        
        <div class="movieInfo">
            <h1><?php echo htmlspecialchars($movie['movieTitle']); ?></h1>
            <p><strong>Release Year:</strong> <?php echo htmlspecialchars($movie['releaseYear'] ?? 'N/A'); ?></p>
            <p class="ratingTag">⭐ <?php echo htmlspecialchars($movie['avgRating'] ?? '0.0'); ?> / 10</p>
            
            <div class="descriptionText">
                <strong>Synopsis:</strong><br>
                <?php echo nl2br(htmlspecialchars($movie['movieDescription'] ?? 'No description available for this movie.')); ?>
            </div>

            <a href="index.php" class="backBtn">← Back to Movies</a>
        </div>
    </div>
</body>
</html>