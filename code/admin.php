<?php
session_start();

// Security Check: If the user is NOT an admin, send them to the home page
if (!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 1) {
    header("Location: index.php");
    exit();
}

include 'connect.php';
// ... rest of your admin code ...
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Add Movies</title>
    <link rel="stylesheet" href="../style/style.css">
    <style>
        /* Simple styling for the admin form */
        .admin-form-container { max-width: 600px; margin: 50px auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(243, 235, 235, 0.1); }
        .admin-form-container h2 { margin-bottom: 20px; color: #c0bbbbff; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .form-group input, .form-group textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; }
        .add-btn { background-color: #e50914; color: white; padding: 12px; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-size: 16px; }
        .admin-table, .admin-table th, .admin-table td {
        border: 1px solid #ccc;
}
    </style>
</head>
<body>
<div class="admin-form-container">
    <h2>Add New Movie</h2>
    <form action="addmovie.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label>Movie Title</label>
            <input type="text" name="movieTitle" required placeholder="e.g. Inception">
        </div>
        <div class="form-group">
            <label>Review</label>
            <textarea name="movieReview" rows="4" placeholder="Enter movie plot..."></textarea>
        </div>
        <div class="form-group">
            <label>Upload Movie Poster</label>
            <input type="file" name="moviePoster" accept="image/*" required>
        </div>
        <div class="form-group">
            <label>Release Year</label>
            <input type="number" name="releaseYear" placeholder="Year of release">
        </div>
        <div class="form-group">
            <label>Average Rating</label>
            <input type="number" step="0.01" name="avgRating" placeholder="Rating out of 10">
        </div>
        <button type="submit" class="add-btn">Save Movie</button>
    </form>
    <br>
    <a href="index.php">View Home Page</a>
</div>

    <hr>
<h2>Manage Existing Movies</h2>
<table class="admin-table" style="width:100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr style="background: #f4f4f4;">
            <th>ID</th>
            <th>Title</th>
            <th>Year</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    include 'connect.php';
    // Fetching the data
    $result = $conn->query("SELECT movieId, movieTitle, releaseYear FROM movies ORDER BY movieId DESC");

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        // Column 1: Only the ID
        echo "<td>" . $row['movieId'] . "</td>"; 
        
        // Column 2: Only the Title
        echo "<td>" . $row['movieTitle'] . "</td>"; 
        
        // Column 3: Only the Year
        echo "<td>" . $row['releaseYear'] . "</td>"; 
        
        // Column 4: The Action Links
        echo "<td>
                <a href='editmovie.php?id=" . $row['movieId'] . "' style='color: blue; text-decoration: none; margin-right: 10px;'>Edit</a>
                <a href='delete_movie.php?id=" . $row['movieId'] . "' onclick='return confirm(\"Are you sure?\")' style='color: red; text-decoration: none;'>Delete</a>
            </td>";
        echo "</tr>";
    }
    $conn->close();
    ?>
</tbody>
</table>
</body>
</html>