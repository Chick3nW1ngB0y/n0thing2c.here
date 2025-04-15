<?php 
session_start();
include "../config/koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Query to check username and password
$login = mysqli_query($conn, "SELECT * FROM petugas WHERE username='$username' AND password='$password'");
$data = mysqli_fetch_assoc($login);

if ($data) {
    $_SESSION['PetugasID'] = $data['PetugasID'];
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $data['Role'];

    if ($data['Role'] == "admin") {
        header("location: ../pages/dashboard.php");
    } else if ($data['Role'] == "petugas_kasir") {
        header("location: ../pages/dashboard.php");
    }
} else {
    header('location: ../pages/login.php?error=invalid_credentials');
}
?>