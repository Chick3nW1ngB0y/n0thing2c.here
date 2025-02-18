<?php
session_start();
include '../config/koneksi.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dashboard Aplikasi Kasir SMK Mandalahayu">
    <title>Dashboard Kasir SMK Mandalahayu</title>
    <link rel="icon" type="image/png" href="../asset/icon/favicon-16x16.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <header>
        <h1>Dashboard Kasir</h1>
        <nav>
            <ul>
                <li><a href="login.php">Home</a></li>
                <li><a href="logout.php">Logout</a></li>
                <!-- Add more navigation links as needed -->
            </ul>
        </nav>
    </header>

    <main>
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>This is your dashboard where you can manage transactions and view reports.</p>
        <!-- Additional dashboard content goes here -->
    </main>

    <footer>
        <p>&copy; 2023 SMK Mandalahayu</p>
    </footer>

</body>
</html>
