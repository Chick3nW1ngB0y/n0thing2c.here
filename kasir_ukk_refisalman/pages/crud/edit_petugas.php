<?php
session_start();
if (!isset($_SESSION['PetugasID'])) 
{
    header("Location: login.php");
    exit();
}

include '../../config/koneksi.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: kelola_user.php?error=Invalid+Petugas+ID"); 
    exit();
}

$PetugasID = intval($_GET['id']);
$sql = "SELECT * FROM petugas WHERE PetugasID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $PetugasID);
$stmt->execute();
$result = $stmt->get_result();
$petugas = $result->fetch_assoc();
$stmt->close();

if (!$petugas) {
    header("Location: kelola_user.php?error=Invalid+Petugas+ID");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <link rel="icon" href="../asset/icon/favicon.ico" type="image/x-icon">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Petugas - Kasir Mandalahayu</title>
        <link rel="stylesheet" href="../../css/dashboard.css">
    </head>
    <body>
    <header>
    <div class="header-container">
        <h1>Edit Data Petugas</h1>
        </div>
        <nav>
            <ul>
            <li><a href="kelola_user.php" class="batal-btn">Batal</a></li>
        </ul>
    </header>
    <main>
    <section>
        <h2>Edit Petugas</h2>
        <form action="../../config/edit_petugas_config.php" method="POST">
            <input type="hidden" name="PetugasID" value="<?php echo $PetugasID; ?>">
            <div class="form-group">
                <label for="NamaPetugas">Nama Petugas:</label>
                <br>
                <input type="text" id="NamaPetugas" name="NamaPetugas" value="<?php echo $petugas['NamaPetugas']; ?>" required>
            </div>
            <br>
            <div class="form-group">
                <label for="Username">Username:</label>
                <br>
                <input type="text" id="Username" name="Username" value="<?php echo $petugas['Username']; ?>" required>
            </div>
            <br>
            <div class="form-group">
                <label for="Password">Password:</label>
                <br>
                <input type="password" id="Password" name="Password" value="<?php echo $petugas['Password']; ?>" required>
            </div>
            <br>
            <div class="form-group">
                <label for="Role">Role:</label>
                <br>
                <select id="Role" name="Role" required>
                    <option value="admin" <?php if ($petugas['Role'] == 'admin') echo 'selected'; ?>>Admin</option>
                    <option value="petugas_kasir" <?php if ($petugas['Role'] == 'petugas_kasir') echo 'selected'; ?>>Petugas Kasir</option>
                </select>
            </div>
            <br>
            <button type="submit" name="submit">Update Petugas</button>
        </form>
    </section>
    </main>
    </body>
</html>