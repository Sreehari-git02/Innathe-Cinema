<?php
    // Placeholder count for now 12 movies
    $movieCount = 12;
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
                <li><a href="about.php">About</a></li>
                <li><a href="#" id="openSignIn">Sign In</a></li>
                <li><a href="#" id="openSignUp">Register</a></li>
            </ul>
        </nav>
    </header>

<!-- Auth Modal (Sign In + Register) -->
<div class="modalOverlay" id="modalOverlay">
    <div class="modalBox">

        <span class="closeBtn" id="closeModal">&times;</span>

        <!-- Tabs -->
        <div class="authTabs">
            <button class="tabBtn activeTab" id="tabSignIn">Sign In</button>
            <button class="tabBtn" id="tabSignUp">Register</button>
        </div>

        <!-- Sign In Form -->
        <form class="signInForm authForm" id="signInForm">
            <h2>Welcome Back</h2>

            <!-- Google Login -->
            <button type="button" class="googleBtn">
                <img src="../assets/images/googleLogo.png" class="googleIcon">
                Continue with Google
            </button>

            <p class="divider">or</p>

            <input type="email" placeholder="Enter Email" required>
            <input type="password" placeholder="Enter Password" required>

            <button type="submit" class="signInBtn">Sign In</button>

            <p class="switchText">
                Don't have an account?
                <a href="#" id="switchToSignUp">Register now</a>
            </p>
        </form>

        <!-- Sign Up Form -->
        <form class="signUpForm authForm hiddenForm" id="signUpForm">
            <h2>Create Account</h2>

            <!-- Google Register -->
            <button type="button" class="googleBtn">
                <img src="../assets/images/googleLogo.png" class="googleIcon">
                Register with Google
            </button>

            <p class="divider">or</p>

            <input type="text" placeholder="Full Name" required>
            <input type="email" placeholder="Email" required>
            <input type="password" placeholder="Password" required>
            <input type="password" placeholder="Confirm Password" required>

            <button type="submit" class="signUpBtn">Register</button>

            <p class="switchText">
                Already have an account?
                <a href="#" id="switchToSignIn">Sign In</a>
            </p>
        </form>

    </div>
</div>


    <!-- Movie Section -->
    <main class="movieSection">
        <h2 class="sectionTitle">Top 12 Movies</h2>

        <div class="movieGrid">
            <?php for ($i = 1; $i <= $movieCount; $i++): ?>
                <div class="movieCard placeholder">
                    <div class="posterPlaceholder"></div>
                    <h3 class="movieName">Movie Title</h3>
                </div>
            <?php endfor; ?>
        </div>
    </main>

<!-- Footer Section -->
<footer class="footer">
    <div class="footerContent">

        <!-- Left: Logo + tagline -->
        <div class="footerLeft">
            <img src="../assets/images/Logoinnathecinema1.jpeg" class="footerLogo" alt="Footer Logo">
            <h3 class="footerTitle">Innathe Cinema</h3>
            <p>• Stories • Emotions • Cinema</p>
                <br>
                    <div class="socialIcons">
                <a href="https://www.instagram.com/innathe.cinema/" class="social ig">Instagram</a>
            </div>
        </div>

        <!-- Center: Quick links -->
        <div class="footerCenter">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </div>

        <!-- Right: Creator + social -->
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

    <!-- Bottom line -->
    <p class="copyright">
        © 2025 Innathe Cinema. All Rights Reserved. Designed & Developed by 
        <span class="creatorHighlight">Sreehari B S</span>
    </p>
</footer>

    <!-- JavaScript Linking -->
    <script src="../script/script.js"></script>

</body>
</html>
