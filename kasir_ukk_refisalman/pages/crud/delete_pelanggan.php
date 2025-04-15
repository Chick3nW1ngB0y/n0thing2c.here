<?php
include 'koneksi.php';


if (!isset($_POST['PelangganID']) || !is_numeric($_POST['PelangganID'])) {
    header('Location: data_pelanggan.php?error=Invalid+Pelanggan+ID');
    exit();
}

$PelangganID = intval($_POST['PelangganID']);


$stmt = $conn->prepare("DELETE FROM pelanggan WHERE PelangganID = ?");
$stmt->bind_param("i", $PelangganID);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header('Location: data_pelanggan.php?message=Pelanggan+berhasil+dihapus');
    } else {
        header('Location: data_pelanggan.php?error=Pelanggan+tidak+ditemukan');
    }
} else {
    header('Location: data_pelanggan.php?error=Gagal+menghapus+pelanggan');
}

$stmt->close();
$koneksi->close();
exit();
?>
