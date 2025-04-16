<?php
session_start();
if (!isset($_SESSION['PetugasID']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit();
}

include 'koneksi.php';

if (!isset($_POST['PenjualanID']) || !is_numeric($_POST['PenjualanID'])) {
    header("Location: ../pages/data_penjualan.php?error=Invalid+PenjualanID");
    exit();
}

$PenjualanID = intval($_POST['PenjualanID']);

$stmt = $conn->prepare("DELETE FROM penjualan WHERE PenjualanID = ?");
$stmt->bind_param("i", $PenjualanID);

if ($stmt->execute()) {
    header("Location: ../pages/data_penjualan.php?message=Data+berhasil+dihapus");
} else {
    header("Location: ../pages/data_penjualan.php?error=Gagal+menghapus+data");
}

$stmt->close();
$conn->close();
exit();
?>