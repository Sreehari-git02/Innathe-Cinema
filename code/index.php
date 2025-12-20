<?php
session_start();
$movieCount = 12;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Innathe Cinema</title>

    <link rel="stylesheet" href="../style/style.css">
</head>

<body>

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
                <li><a href="about.php">About</a></li>

                <?php if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1): ?>
                    <li><a href="admin.php" style="color: #e50914; font-weight: bold;">Admin Dashboard</a></li>
                <?php endif; ?>

                <?php if(isset($_SESSION['user_name'])): ?>
                    <li><a href="#">Hi, <?php echo htmlspecialchars($_SESSION['user_name']); ?></a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="#" id="openSignIn">Sign In</a></li>
                    <li><a href="#" id="openSignUp">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <div class="modalOverlay" id="modalOverlay">
        <div class="modalBox">
            <span class="closeBtn" id="closeModal">&times;</span>

            <div class="authTabs">
                <button class="tabBtn activeTab" id="tabSignIn">Sign In</button>
                <button class="tabBtn" id="tabSignUp">Register</button>
            </div>

            <form class="signInForm authForm" id="signInForm" action="login.php" method="POST">
                <h2>Welcome Back</h2>
                <button type="button" class="googleBtn">
                    <img src="../assets/images/googleLogo.png" class="googleIcon">
                    Continue with Google
                </button>
                <p class="divider">or</p>
                <input type="email" name="email" placeholder="Enter Email" required>
                <input type="password" name="password" placeholder="Enter Password" required>
                <button type="submit" class="signInBtn">Sign In</button>
                <p class="switchText">
                    Don't have an account?
                    <a href="#" id="switchToSignUp">Register now</a>
                </p>
            </form>

            <form class="signUpForm authForm hiddenForm" id="signUpForm" action="register.php" method="POST">
                <h2>Create Account</h2>
                <button type="button" class="googleBtn">
                    <img src="../assets/images/googleLogo.png" class="googleIcon">
                    Register with Google
                </button>
                <p class="divider">or</p>
                <input type="text" name="fullName" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit" class="signUpBtn">Register</button>
            </form>
        </div>
    </div>

    <main class="movieSection">
        <h2 class="sectionTitle">Latest Movies</h2>
        <div class="movieGrid">
            <?php
            include 'connect.php';
            // Fetch all movies from the table
            $query = "SELECT * FROM movies ORDER BY movieId DESC";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    ?>
                    <a href="moviedetails.php?id=<?php echo $row['movieId']; ?>" class="movieCardLink" style="text-decoration: none; color: inherit;">
                        <div class="movieCard">
                            <img src="<?php echo htmlspecialchars($row['posterPath'] ?? ''); ?>" alt="Poster" style="width:100%; height:auto; border-radius:8px;">
                            <h3 class="movieName"><?php echo htmlspecialchars($row['movieTitle']); ?></h3>
                            <p style="font-size: 0.8rem; color: #777;"><?php echo htmlspecialchars($row['releaseYear']); ?> | ⭐ <?php echo htmlspecialchars($row['avgRating']); ?></p>
                        </div>
                    </a>
                    <?php
                }
            } else {
                echo "<p>No movies found in the database.</p>";
            }
            $conn->close();
            ?>
        </div>
    </main>

    <footer class="footer">
        <div class="footerContent">
            <div class="footerLeft">
                <img src="../assets/images/Logoinnathecinema1.jpeg" class="footerLogo" alt="Footer Logo">
                <h3 class="footerTitle">Innathe Cinema</h3>
                <p>• Stories • Emotions • Cinema</p>
                <div class="socialIcons">
                    <a href="https://www.instagram.com/innathe.cinema/" class="social ig">Instagram</a>
                </div>
            </div>

            <div class="footerCenter">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                </ul>
            </div>

            <div class="footerRight">
                <h4>Created By</h4>
                <p class="creatorName">Sreehari B S</p>
                <div class="socialIcons">
                    <a href="https://www.facebook.com/sreeharipaya" class="social fb">Facebook</a>
                    <a href="https://www.instagram.com/sb_shutterbug/" class="social ig">Instagram</a>
                    <a href="https://www.linkedin.com/in/sreeharipaya/" class="social li">LinkedIn</a>
                </div>
            </div>
        </div>
        <p class="copyright">
            © 2025 Innathe Cinema. All Rights Reserved. Designed & Developed by 
            <span class="creatorHighlight">Sreehari B S</span>
        </p>
    </footer>

    <script src="../script/script.js"></script>

</body>
</html>