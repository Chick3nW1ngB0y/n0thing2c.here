<?php
include('koneksi.php');

if(isset($_POST['submit'])) {

    $namaPetugas = trim($_POST['NamaPetugas']);
    $username = trim($_POST['Username']);
    $password = trim($_POST['Password']);
    $role = trim($_POST['Role']);

    // Validate input data
    if(empty($namaPetugas) || empty($username) || empty($password) || empty($role)) {
        header('Location: ../pages/kelola_user.php?error=Invalid+input+data');
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO petugas (NamaPetugas, Username, Password, Role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $namaPetugas, $username, $hashedPassword, $role);

    // Execute the statement
    if($stmt->execute()) {
        header('Location: ../pages/kelola_user.php?message=Petugas+berhasil+ditambahkan!');
        exit();
    } else {
        header('Location: ../pages/kelola_user.php?error=Gagal+menambahkan+data+petugas');
        exit();
    }

} else {
    header('Location: ../pages/kelola_user.php?error=Invalid+request+method');
    exit();
}
?>