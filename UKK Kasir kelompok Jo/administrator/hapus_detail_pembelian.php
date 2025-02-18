<?php
// koneksi database
include '../koneksi.php';
// menangkap data id yang di kirim dari url
$DetaiID = $_POST['DetailID'];
$PelangganID = $_POST['PelangganID'];
// menghapus data dari database
mysqli_query($koneksi,"delete from detailpenjualan where DetailID='$DetaiID'");
// mengalihkan halaman kembali ke data_barang.php
header("location:detail_pembelian.php?pelangganID=$pelangganID");
?>