<?php
include'../koneksi.php';

$PelangganID = $_POST['PelangganID'];
$NamaPelanggan = $_POST['NamaPelanggan'];
$NomorTelepon = $_POST['NomorTelepon'];
$Alamat = $_POST['Alamat'];
$TanggalPenjualan['TanggalPenjualan'];

mysqli_query($koneksi,"insert into pelanggan values('$PelangganID','$NamaPelanggan','$Alamat','$NomorTelepon')");
mysqli_query($koneksi,"insert into penjualan values('','$TanggalPenjualan','$PelangganID')");

header("location:pembelian.php?pesan=simpan");

?>