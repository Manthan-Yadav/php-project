<?php
session_start();
require_once 'config/Database.php';

// Determine the page to load
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$page = preg_replace('/[^a-z0-9_-]/', '', $page);

// Check login status
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$user_email = $_SESSION['user_email'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Portal</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/pages.css">
</head>
<body>
    <header>
        <nav class="container">
            <div class="logo">🎓 InternHub</div>
            <button class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-links" id="navMenu">
                <li><a href="?page=home">Home</a></li>
                <li><a href="?page=internships">Internships</a></li>
                <?php if ($is_logged_in): ?>
                    <li style="display: flex; align-items: center; gap: 10px;">
                        <img src="login image.jpg" alt="Profile" class="profile-img" title="<?php echo htmlspecialchars($user_email); ?>">
                        <a href="php/logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li><a href="php/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <div class="nav-overlay" id="navOverlay"></div>

    <main class="main-content" id="mainContent">
        <?php
        // Include the appropriate page file
        $page_file = "pages/{$page}.php";
        
        if (file_exists($page_file)) {
            include $page_file;
        } else {
            include "pages/home.php";
        }
        ?>
    </main>

    <footer>
        <p>&copy; 2024 InternHub. All rights reserved.</p>
    </footer>

    <script>
        // Show footer on scroll
        const footer = document.querySelector('footer');
        const mainContent = document.getElementById('mainContent');

        mainContent.addEventListener('scroll', function() {
            if (mainContent.scrollTop > 100) {
                footer.classList.add('show');
            } else {
                footer.classList.remove('show');
            }
        });

        // Mobile menu toggle
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const navOverlay = document.getElementById('navOverlay');

        hamburger.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            navOverlay.classList.toggle('active');
            hamburger.classList.toggle('active');
        });

        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('active');
                navOverlay.classList.remove('active');
                hamburger.classList.remove('active');
            });
        });

        navOverlay.addEventListener('click', function() {
            navMenu.classList.remove('active');
            navOverlay.classList.remove('active');
            hamburger.classList.remove('active');
        });
    </script>
</body>
</html>
