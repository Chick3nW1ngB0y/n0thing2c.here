<?php
session_start();
if (!isset($_SESSION['PetugasID'])) {
    header("Location: ../login.php");
    exit();
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/daftar_produk.php?error=Invalid+Request");
    exit();
}

$ProdukID = intval($_POST['ProdukID']);
$NamaProduk = trim($_POST['NamaProduk']);
$Harga = floatval($_POST['Harga']);
$Stok = intval($_POST['Stok']);

if (empty($NamaProduk) || $Harga < 0 || $Stok < 0) {
    header("Location: ../pages/daftar_produk.php?error=Invalid+Input");
    exit();
}

// Fetch current product details
$sql = "SELECT * FROM produk WHERE ProdukID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ProdukID);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    header("Location: ../pages/daftar_produk.php?error=Produk+tidak+ditemukan");
    exit();
}

if ($NamaProduk == $product['NamaProduk'] && $Harga == $product['Harga'] && $Stok == $product['Stok']) {
    header("Location: ../pages/daftar_produk.php?error=Tidak+ada+perubahan");
    exit();
}

$sql = "UPDATE produk SET 
        NamaProduk = ?, 
        Harga = ?, 
        Stok = ? 
        WHERE ProdukID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sdii", $NamaProduk, $Harga, $Stok, $ProdukID);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: ../pages/daftar_produk.php?message=Produk+berhasil+diupdate");
    } else {
        header("Location: ../pages/daftar_produk.php?error=Tidak+ada+perubahan");
    }
} else {
    header("Location: ../pages/daftar_produk.php?error=Gagal+update+produk");
}

$stmt->close();
$conn->close();
exit();
?>