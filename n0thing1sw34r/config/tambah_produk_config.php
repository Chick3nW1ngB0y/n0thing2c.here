<?php
include('koneksi.php');

if(isset($_POST['submit'])) {

    $produkID = intval($_POST['ProdukID']);
    $namaproduk = trim($_POST['NamaProduk']);
    $harga = floatval($_POST['Harga']);
    $stok = intval($_POST['Stok']);

    // Validate input data
    if(empty($namaproduk) || $harga < 0 || $stok < 0) {
        header('Location: ../pages/daftar_produk.php?error=Invalid+input+data');
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO produk (ProdukID, NamaProduk, Harga, Stok) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isdi", $produkID, $namaproduk, $harga, $stok);

    // Execute the statement
    if($stmt->execute()) {
        header('Location: ../pages/daftar_produk.php?message=Produk+berhasil+ditambahkan!');
        exit();
    } else {
        header('Location: ../pages/daftar_produk.php?error=Gagal+menambahkan+data+produk');
        exit();
    }

} else {
    header('Location: ../pages/daftar_produk.php?error=Invalid+request+method');
    exit();
}
?>