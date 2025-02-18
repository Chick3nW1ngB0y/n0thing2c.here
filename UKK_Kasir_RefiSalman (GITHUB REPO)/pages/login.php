<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="../asset/icon/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Aplikasi kasir hasil proyek SMK Mandalahayu untuk pengelolaan transaksi yang mudah dan efisien.">
    <title>Kasir Mandalahayu</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section id="login">
        <div class="login-left">
            <div class="text-hero">
                <h2>Kasir Mandalahayu</h2>
                <p></p>
            </div>
            <img src="../asset/MDL_BG.jpg" alt="Tampilan Awal Kasir Mandalahayu">
        </div>

        <div class="login-right">
            <div class="login-form">
                <img src="../asset/android-chrome-512x512.png" alt="Logo Login">
                <h3>Selamat Datang</h3>
                <form action="proses_login.php" method="post">
                    <div class="text-login">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" placeholder="Masukkan Username" required autocomplete="off">
                        
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Masukkan Password" required>
                    </div>
                    <div class="button">
                        <button type="reset">Batal</button>
                        <button type="submit">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
