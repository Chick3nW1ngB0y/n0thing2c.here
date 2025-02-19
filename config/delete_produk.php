<?php
include 'koneksi.php';

// Validate and sanitize input
if (!isset($_POST['ProdukID']) || !is_numeric($_POST['ProdukID'])) {
    header('Location: ../pages/daftar_produk.php?error=Invalid+Product+ID');
    exit();
}

$ProdukID = intval($_POST['ProdukID']);

// Use prepared statement to prevent SQL injection
$stmt = $koneksi->prepare("DELETE FROM produk WHERE ProdukID = ?");
$stmt->bind_param("i", $ProdukID);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header('Location: ../pages/daftar_produk.php?message=Produk+berhasil+dihapus');
    } else {
        header('Location: ../pages/daftar_produk.php?error=Produk+tidak+ditemukan');
    }
} else {
    header('Location: ../pages/daftar_produk.php?error=Gagal+menghapus+produk');
}

$stmt->close();
$koneksi->close();
exit();
?>
