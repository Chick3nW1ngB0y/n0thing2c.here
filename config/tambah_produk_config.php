<?php
include('koneksi.php');

if(isset($_POST['submit'])) {

    $produkID = trim($_POST['ProdukID']);
    $namaproduk = trim($_POST['NamaProduk']);
    $harga = trim($_POST['Harga']);
    $stok = trim($_POST['Stok']);

   
    if(empty($namaproduk) || !is_numeric($harga) || !is_numeric($stok)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
        exit;
    }

   
    $stmt = $conn->prepare("INSERT INTO produk (ProdukID, NamaProduk, Harga, Stok) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $produkID, $namaproduk, $harga, $stok);


    if($stmt->execute()) {
        header('Location: ../pages/daftar_produk.php?message=Produk+berhasil+ditambahkan!');
        exit();
    } else {

        echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan data produk: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: ../pages/daftar_produk.php?message=Invalid+request+method');
    exit();

}
?>
