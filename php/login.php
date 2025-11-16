<?php
session_start();

$login_success = false;
$error_message = '';

// Hardcoded credentials
$valid_email = 'admin@internship.com';
$valid_password = 'admin123';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        $error_message = 'Email and password are required';
    } elseif ($email === $valid_email && $password === $valid_password) {
        $_SESSION['user_id'] = 1;
        $_SESSION['user_email'] = $email;
        $_SESSION['logged_in'] = true;
        $login_success = true;
    } else {
        $error_message = 'Invalid email or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Internship Portal</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/pages.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        footer {
            background: #333;
        }

        .login-wrapper {
            width: 100%;
            max-width: 450px;
        }

        .auth-container {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .auth-container h2 {
            text-align: center;
            color: #667eea;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .auth-container p {
            text-align: center;
            color: #999;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.2);
        }

        .form-group input::placeholder {
            color: #999;
        }

        .btn-submit {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            border-left: 4px solid #c62828;
            font-size: 14px;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 4px;
            border-left: 4px solid #2e7d32;
            font-size: 14px;
        }

        .auth-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .auth-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-link a:hover {
            text-decoration: underline;
        }

        .demo-credentials {
            background: #f5f5f5;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
            font-size: 13px;
            color: #666;
        }

        .demo-credentials p {
            margin: 5px 0;
        }

        @media (max-width: 768px) {
            .auth-container {
                padding: 30px;
            }

            .auth-container h2 {
                font-size: 24px;
            }

            .btn-submit {
                padding: 11px;
                font-size: 15px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 20px 15px;
            }

            .auth-container {
                padding: 25px;
            }

            .auth-container h2 {
                font-size: 22px;
                margin-bottom: 5px;
            }

            .auth-container p {
                font-size: 13px;
                margin-bottom: 25px;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .form-group label {
                font-size: 13px;
            }

            .form-group input {
                padding: 11px;
                font-size: 13px;
            }

            .btn-submit {
                padding: 10px;
                font-size: 14px;
            }

            .demo-credentials {
                font-size: 12px;
                padding: 12px;
                margin-top: 15px;
            }
        }
    </style>
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
                <li><a href="../index.php">Home</a></li>
                <li><a href="../index.php?page=internships">Internships</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <div class="nav-overlay" id="navOverlay"></div>

    <div class="main-content">
        <div class="login-wrapper">
            <div class="auth-container">
                <?php if ($login_success): ?>
                    <div class="success-message">✓ Login Successful! Redirecting...</div>
                    <script>
                        setTimeout(function() {
                            window.location.href = '../index.php';
                        }, 2000);
                    </script>
                <?php else: ?>
                    <h2>Login</h2>
                    <p>Sign in to your account</p>

                    <?php if (!empty($error_message)): ?>
                        <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
                    <?php endif; ?>

                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="your@email.com" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn-submit">Login</button>
                    </form>

                    <div class="demo-credentials">
                        <p><strong>Demo Credentials:</strong></p>
                        <p>📧 Email: admin@internship.com</p>
                        <p>🔐 Password: admin123</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 InternHub. All rights reserved.</p>
    </footer>

    <script>
        // Mobile menu toggle
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        const navOverlay = document.getElementById('navOverlay');

        hamburger.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            navOverlay.classList.toggle('active');
            hamburger.classList.toggle('active');
        });

        // Close menu when clicking on a link
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('active');
                navOverlay.classList.remove('active');
                hamburger.classList.remove('active');
            });
        });

        // Close menu when clicking overlay
        navOverlay.addEventListener('click', function() {
            navMenu.classList.remove('active');
            navOverlay.classList.remove('active');
            hamburger.classList.remove('active');
        });
    </script>
</body>
</html>
