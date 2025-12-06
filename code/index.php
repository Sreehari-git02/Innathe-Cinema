<?php
    // Placeholder count for now 18 movies
    $movieCount = 18;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innathe Cinema</title>

    <!-- CSS Linking  -->
    
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>

    <!-- Navigation Bar -->
    
    <header>
        <div class="logoName">
            <img src="../assets/images/Logoinnathecinema1.jpeg" alt="logo" class="logo">
            <a href="index.php" class="name">Innathe Cinema</a>
        </div>

        <nav class="info">
            <div class="searchContainer">
                <input type="text" id="search-input" placeholder="Search...">
                <button type="button">Search</button>
            </div>

            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="signin.php">Sign In</a></li>
            </ul>
        </nav>
    </header>


    <!-- Movie Section -->
    <main class="movieSection">
        <h2 class="sectionTitle">Movie Title</h2>

        <div class="movieGrid">
            <?php for ($i = 1; $i <= $movieCount; $i++): ?>
                <div class="movieCard placeholder">
                    <div class="posterPlaceholder"></div>
                    <h3 class="movieName">Movie Title</h3>
                </div>
            <?php endfor; ?>
        </div>
    </main>

</body>
</html>
