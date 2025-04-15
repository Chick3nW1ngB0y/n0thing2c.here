<?php
session_start();
if (!isset($_SESSION['PetugasID'])) 
{
    header("Location: ../login.php");
    exit();
}

include '../../config/koneksi.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: daftar_produk.php?error=Invalid+Product+ID");
    exit();
}

$ProdukID = intval($_GET['id']);
$sql = "SELECT * FROM produk WHERE ProdukID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ProdukID);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    header("Location: daftar_produk.php?error=Produk+tidak+ditemukan");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="../../asset/icon/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Kasir Mandalahayu</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
</head>
<body>
    <header>
    <div class="header-container">
        <h1>Edit Produk</h1>
        </div>
        <nav>
            <ul>
            <li><a href="daftar_produk.php" class="batal-btn">Batal</a></li>
        </ul>
    </header>
    <main>
    <section>
            <h2>Edit Produk</h2>
            <form action="../../config/edit_produk_config.php" method="POST">
                <input type="hidden" name="ProdukID" value="<?php echo $ProdukID; ?>">
                <div class="form-group">
                    <label for="NamaProduk">Nama Produk:</label>
                    <br>
                    <input type="text" id="NamaProduk" name="NamaProduk" value="<?php echo htmlspecialchars($product['NamaProduk']); ?>" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="Harga">Harga:</label>
                    <br>
                    <input type="number" id="Harga" name="Harga" value="<?php echo htmlspecialchars($product['Harga']); ?>" required min="0">
                </div>
                <br>
                <div class="form-group">
                    <label for="Stok">Stok:</label>
                    <br>
                    <input type="number" id="Stok" name="Stok" value="<?php echo htmlspecialchars($product['Stok']); ?>" required min="0">
                </div>
                <br>
                <button type="submit" name="submit">Update Produk</button>
            </form>
        </section>
    </main>
</body>
</html>