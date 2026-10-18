
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$currentPage = basename($_SERVER['PHP_SELF'] ?? '');
$username = $_SESSION['username'] ?? 'My Account';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkUp</title>
    <link rel="stylesheet" href="/html/LinkUp/public/assets/style.css">
</head>
<body>

<header class="linkup-header">
    <a href="/html/LinkUp/public/index.php?action=home"
       class="linkup-logo">
        <span class="logo-icon">L</span>
        <span>LinkUp</span>
    </a>

    <nav class="linkup-nav">
        <a href="/html/LinkUp/public/index.php?action=home"
           class="nav-link">
            <span class="nav-icon">⌂</span>
            <span>Newsfeed</span>
        </a>

        <a href="/html/LinkUp/public/index.php?action=profile"
           class="nav-link">
            <span class="nav-icon">♙</span>
            <span>Profile</span>
        </a>

        <a href="/html/LinkUp/public/index.php?action=logout"
           class="nav-link logout-link">
            <span class="nav-icon">↪</span>
            <span>Logout</span>
        </a>
    </nav>
</header>
