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
    <title>Dashboard - Kasir Mandalahayu</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <header>
    <div class="header-container">
        <h1>Kasir Punklorde</h1>
    </div>
        <nav>
            <ul>
                <li style="background: var(--color-violet);
                        color: var(--color-dark-blue);
                        border-radius: 5px;"><a href="dashboard.php">Dashboard</a></li>
                <li><a href="data_pelanggan.php">Data Pelanggan</a></li>
                <li><a href="daftar_produk.php">Daftar Produk</a></li>
                <li><a href="data_penjualan.php">Data Penjualan</a></li>
                <li><a href="../config/logout.php">Keluar</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <img src="../asset/logo.png" class="logo-minggu-dashboard">
            <h2>Selamat datang</h2>
            <p>di duniaku,</p> 
            <p>Perbarui definisi Anda,</p> 
            <p>dunia yang begitu tinggi,</p> 
            <p>biarkan ia terlihat</p>
        </section>
        <section>
            <h3>Statistik Penjualan</h3>
            <p>Lorem ipsum dolor sit amet</p>
        </section>
    </main>
</body>
</html>
