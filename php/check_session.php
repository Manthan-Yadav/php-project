<?php
session_start();

header('Content-Type: application/json');

$response = [
    'logged_in' => isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true,
    'user_email' => $_SESSION['user_email'] ?? null
];

echo json_encode($response);
?>
