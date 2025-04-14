<?php
session_start();
if (!isset($_SESSION['PetugasID'])) 
{
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="../../asset/icon/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Petugas - Kasir Mandalahayu</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
</head>
<body>
    <header>
    <div class="header-container">
        <h1>Tambah Petugas</h1>
        </div>
        <nav>
            <ul>
            <li><a href="../kelola_user.php" class="batal-btn">Batal</a></li>
        </ul>
    </header>
    <main>
    <section>
            <h2>Tambah Petugas Baru</h2>
            <form action="../../config/tambah_petugas_config.php" method="POST">
                <div class="form-group">
                    <label for="NamaPetugas">Nama Petugas:</label>
                    <br>
                    <input type="text" id="NamaPetugas" name="NamaPetugas" required autocomplete="off">
                </div>
               <br>
                <div class="form-group">
                    <label for="Username">Username:</label>
                    <br>
                    <input type="text" id="Username" name="Username" required autocomplete="off">
                </div>
                <br>
                <div class="form-group">
                    <label for="Password">Password:</label>
                    <br>
                    <input type="password" id="Password" name="Password" required autocomplete="off">
                </div>
                <br>
                <div class="form-group">
                    <label for="Role">Role:</label>
                    <br>
                    <select id="Role" name="Role" required>
                        <option value="admin">Admin</option>
                        <option value="petugas_kasir">Petugas Kasir</option>
                    </select>
                </div>
                <br>
                <button type="submit" name="submit">Tambah Petugas</button>
            </form>
        </section>
    </main>
</body>
</html>