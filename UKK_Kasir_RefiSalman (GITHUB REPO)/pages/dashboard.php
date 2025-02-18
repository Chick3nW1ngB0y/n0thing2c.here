<?php
session_start();
if (!isset($_SESSION['user_id'])) 
{
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="../asset/icon/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kasir Mandalahayu    </title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <header>
    <div class="header-container">
        <h1>Dashboard Kasir</h1>
        <span class="welcome-text">Selamat datang, <?php echo $_SESSION['username']; ?>!</span>
        <img src="../asset/logo.png">
    </div>
        <nav>
            <ul>
                <li style="background: var(--color-violet);
                        color: var(--color-dark-blue);
                        border-radius: 5px;"><a href="dashboard.php">Dashboard</a></li>
                <li><a href="kelola_user.php">Kelola User</a></li>
                <li><a href="pendaftaran.php">Pendaftaran</a></li>
                <li><a href="logout.php">Keluar</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Selamat datang</h2>
            <p>Gunakan menu di atas untuk mengelola transaksi dan produk.</p>
        </section>
        <section>
            <h3>Statistik Penjualan</h3>
            <p>Total transaksi hari ini: <strong>Rp. 0</strong> (fitur dalam pengembangan)</p>
        </section>
    </main>
</body>
</html>
