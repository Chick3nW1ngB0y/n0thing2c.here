<?php
session_start();
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $namaPelanggan = $_POST['username']; 
    $password = $_POST['password'];

    $query = "SELECT * FROM pelanggan WHERE NamaPelanggan = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $namaPelanggan);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();


        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['NamaPelanggan'];
            $_SESSION['role'] = $user['role'];

            header('Location: ../pages/dashboard.php');
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="../asset/icon/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi kasir hasil proyek SMK Mandalahayu untuk pengelolaan transaksi yang mudah dan efisien.">
    <title>Kasir Minggu Berkah</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section id="login">
        <div class="login-left">
            <div class="text-hero">
                <h2>Kasir Minggu Berkah</h2>
                <p></p>
            </div>
            <img src="../asset/masminggu.png" alt="Tampilan Awal Kasir Mandalahayu">
        </div>

        <div class="login-right">
            <div class="login-form">
                <img src="../asset/logo.png" alt="Logo SMK Mandalahayu">
                <h3>Selamat Datang
                    ke Mimpi Manisku
                </h3>

        <form action="login.php" method="post">
                    <div class="text-login">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan User ID" required autocomplete="off">
                        
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Masukkan Password" required>
                    </div>
                    <div class="button">
                        <button type="reset">Batal</button>
                        <button type="submit">Masuk</button>
                        <p>
                        <button type="register" href="register.php">Belum Sign In?</button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>
</html>
