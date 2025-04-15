<?php
session_start();
if (!isset($_SESSION['PetugasID'])) {
    header("Location: login.php");
    exit();
}

// Correct the path to koneksi.php
include '../../config/koneksi.php';

if (!isset($_POST['ProdukID']) || !is_numeric($_POST['ProdukID'])) {
    header('Location: ../daftar_produk.php?error=Invalid+Product+ID');
    exit();
}

$ProdukID = intval($_POST['ProdukID']);

$stmt = $conn->prepare("DELETE FROM produk WHERE ProdukID = ?");
$stmt->bind_param("i", $ProdukID);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header('Location: ../daftar_produk.php?message=Produk+berhasil+dihapus');
    } else {
        header('Location: ../daftar_produk.php?error=Produk+tidak+ditemukan');
    }
} else {
    header('Location: ../daftar_produk.php?error=Gagal+menghapus+produk');
}

$stmt->close();
$conn->close();
exit();
?>