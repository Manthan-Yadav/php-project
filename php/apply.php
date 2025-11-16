<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$internship_id = isset($_GET['internship_id']) ? intval($_GET['internship_id']) : 0;

if ($internship_id <= 0) {
    header('Location: ../index.php?page=internships');
    exit;
}

// Here you can add application submission logic
// For now, just show success message

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Submitted - Internship Portal</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pages.css">
</head>
<body>
    <header>
        <nav class="container">
            <div class="logo">🎓 InternHub</div>
            <ul class="nav-links">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../index.php?page=internships">Internships</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main class="main-content">
        <div class="page-header">
            <div class="container">
                <h1>Application Submitted</h1>
            </div>
        </div>

        <div class="container">
            <div style="text-align: center; padding: 60px 20px; background: white; margin: 40px 0; border-radius: 8px;">
                <h2 style="color: #2e7d32; margin-bottom: 20px;">✓ Success!</h2>
                <p style="font-size: 18px; color: #666; margin-bottom: 30px;">Your application has been submitted successfully.</p>
                <a href="../index.php?page=internships" class="btn">Back to Internships</a>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 InternHub. All rights reserved.</p>
    </footer>
</body>
</html>
