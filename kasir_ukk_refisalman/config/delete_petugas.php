<?php
// filepath: c:\xampp\htdocs\kasir_ukk_refisalman\config\delete_petugas.php
session_start();
if (!isset($_SESSION['PetugasID']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../pages/login.php");
    exit();
}

include 'koneksi.php';

// Check if PetugasID is provided and valid
if (!isset($_POST['PetugasID']) || !is_numeric($_POST['PetugasID'])) {
    header("Location: ../pages/kelola_user.php?error=Invalid+PetugasID");
    exit();
}

$PetugasID = intval($_POST['PetugasID']);

// Prevent admins from deleting other admins
$stmt = $conn->prepare("SELECT Role FROM petugas WHERE PetugasID = ?");
$stmt->bind_param("i", $PetugasID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: ../pages/kelola_user.php?error=Petugas+not+found");
    exit();
}

$row = $result->fetch_assoc();
if ($row['Role'] === 'admin') {
    header("Location: ../pages/kelola_user.php?error=Cannot+delete+admin");
    exit();
}

// Delete the petugas
$stmt = $conn->prepare("DELETE FROM petugas WHERE PetugasID = ?");
$stmt->bind_param("i", $PetugasID);

if ($stmt->execute()) {
    header("Location: ../pages/kelola_user.php?message=Petugas+deleted+successfully");
} else {
    header("Location: ../pages/kelola_user.php?error=Failed+to+delete+petugas");
}

$stmt->close();
$conn->close();
exit();
?>