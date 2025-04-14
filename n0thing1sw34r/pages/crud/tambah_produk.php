<?php
session_start();
if (!isset($_SESSION['PetugasID'])) 
{
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="../../asset/icon/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Kasir Mandalahayu</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
</head>
<body>
    <header>
    <div class="header-container">
        <h1>Tambah Produk</h1>
        </div>
        <nav>
            <ul>
            <li><a href="../daftar_produk.php" class="batal-btn">Batal</a></li>
        </ul>
        
    </header>
    <main>
    <section>
            <h2>Tambah Produk Baru</h2>
            <form action="../../config/tambah_produk_config.php" method="POST">
                <div class="form-group">
                    <label for="ProdukID">Barcode:</label>
                    <br>
                    <input type="number" id="ProdukID" name="ProdukID" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="NamaProduk">Nama Produk:</label>
                    <br>
                    <input type="text" id="NamaProduk" name="NamaProduk" required autocomplete="off">
                </div>
                <br>
                <div class="form-group">
                    <label for="Harga">Harga:</label>
                    <br>
                    <input type="number" id="Harga" name="Harga" placeholder="Rp.____________________" required min="0">
                </div>
                <br>
                <div class="form-group">
                    <label for="Stok">Stok:</label>
                    <br>
                    <input type="number" id="Stok" name="Stok" required min="0">
                </div>
                <br>
                <button type="submit" name="submit">Tambah Produk</button>
            </form>
        </section>
    </main>
</body>
</html>