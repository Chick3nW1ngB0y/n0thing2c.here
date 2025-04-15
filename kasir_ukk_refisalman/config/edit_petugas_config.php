<?php
session_start();
if (!isset($_SESSION['PetugasID'])) {
    header("Location: ../pages/login.php");
    exit();
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../pages/kelola_user.php?error=Invalid+Request");
    exit();
}

$PetugasID = intval($_POST['PetugasID']);
$NamaPetugas = trim($_POST['NamaPetugas']);
$Username = trim($_POST['Username']);
$Password = trim($_POST['Password']);
$Role = trim($_POST['Role']);

if (empty($NamaPetugas) || empty($Username) || empty($Password) || empty($Role)) {
    header("Location: ../pages/kelola_user.php?error=Invalid+Input");
    exit();
}

// Fetch current petugas details
$sql = "SELECT * FROM petugas WHERE PetugasID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $PetugasID);
$stmt->execute();
$result = $stmt->get_result();
$petugas = $result->fetch_assoc();
$stmt->close();

if (!$petugas) {
    header("Location: ../pages/kelola_user.php?error=Petugas+tidak+ditemukan");
    exit();
}

if ($NamaPetugas == $petugas['NamaPetugas'] && $Username == $petugas['Username'] && $Password == $petugas['Password'] && $Role == $petugas['Role']) {
    header("Location: ../pages/kelola_user.php?error=Tidak+ada+perubahan");
    exit();
}

$sql = "UPDATE petugas SET 
        NamaPetugas = ?, 
        Username = ?, 
        Password = ?, 
        Role = ? 
        WHERE PetugasID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $NamaPetugas, $Username, $Password, $Role, $PetugasID);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header("Location: ../pages/kelola_user.php?message=Petugas+berhasil+diupdate");
    } else {
        header("Location: ../pages/kelola_user.php?error=Tidak+ada+perubahan");
    }
} else {
    header("Location: ../pages/kelola_user.php?error=Gagal+update+petugas");
}

$stmt->close();
$conn->close();
exit();
?>