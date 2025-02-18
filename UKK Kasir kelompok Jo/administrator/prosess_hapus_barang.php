<?php
// koneksi database
include '../koneksi.php';
//
$ProdukID = $_POST ['ProdukID'];

// menghapus data dari munthe
mysqli_query($koneksi, "delete from produk where ProdukID='$ProdukID'");
// mengalihkan halaman kembali ke data_barang.php
header("location:data_barang.php?pesan=hapus");
?>