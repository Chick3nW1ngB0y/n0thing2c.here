<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/login.php");
    exit();
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/data_pelanggan.php?error=Invalid+Request");
    exit();
}

$PelangganID = intval($_POST['PelangganID']);
$NamaPelanggan = trim($_POST['NamaPelanggan']);
$Alamat = trim($_POST['Alamat']);
$NomorTelepon = trim($_POST['NomorTelepon']);

if (empty($NamaPelanggan) || empty($Alamat) || !is_numeric($NomorTelepon)) {
    header("Location: ../pages/data_pelanggan.php?error=Invalid+Input");
    exit();
}

// Fetch current customer details
$sql = "SELECT * FROM pelanggan WHERE PelangganID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $PelangganID);
$stmt->execute();
$result = $stmt->get_result();
$pelanggan = $result->fetch_assoc();
$stmt->close();

if (!$pelanggan) {
    header("Location: ../pages/data_pelanggan.php?error=Pelanggan+tidak+ditemukan");
    exit();
}

if ($NamaPelanggan == $pelanggan['NamaPelanggan'] && $Alamat == $pelanggan['Alamat'] && $NomorTelepon == $pelanggan['NomorTelepon']) {
    header("Location: ../pages/data_pelanggan.php?error=Tidak+ada+perubahan");
    exit();
}

$sql = "UPDATE pelanggan SET 
        NamaPelanggan = ?, 
        Alamat = ?, 
        NomorTelepon = ? 
        WHERE PelangganID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $NamaPelanggan, $Alamat, $NomorTelepon, $PelangganID);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: ../pages/data_pelanggan.php?message=Pelanggan+berhasil+diupdate");
    } else {
        header("Location: ../pages/data_pelanggan.php?error=Tidak+ada+perubahan");
    }
} else {
    header("Location: ../pages/data_pelanggan.php?error=Gagal+update+pelanggan");
}

$stmt->close();
$conn->close();
exit();
?>