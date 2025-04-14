<?php
// filepath: c:\xampp\htdocs\kasir_ukk_refisalman\pages\admin\daftar_produk.php
session_start();
if (!isset($_SESSION['PetugasID'])) {
    header("Location: ../login.php");
    exit();
}

include '../config/koneksi.php';

// Include the appropriate navbar
if ($_SESSION['role'] === 'admin') {
    include '../config/navbar-admin.php';
} elseif ($_SESSION['role'] === 'petugas') {
    include '../config/navbar-petugas.php';
} else {
    echo "Role user tidak dikenal.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="../../asset/icon/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Kasir Mandalahayu</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Custom CSS -->
    <link rel="stylesheet" href="../../css/dashboard.css">
</head>
<body>
    <main class="container mt-4">
        <section>
            <h2 class="mb-4">Kelola User</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Petugas</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include '../config/koneksi.php';

                    $sql = "SELECT * FROM petugas";
                    $result = $conn->query($sql);
                    ?>

                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['PetugasID']; ?></td>
                            <td><?php echo $row['NamaPetugas']; ?></td>
                            <td><?php echo $row['Username']; ?></td>
                            <td><?php echo $row['Role']; ?></td>
                            <td>
                            <a href="crud/edit_petugas.php?id=<?php echo $row['PetugasID']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <?php if ($row['Role'] !== 'admin'): ?>
                                <form action="../../config/delete_petugas.php" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin mau hapus petugas ini?');">
                                    <input type="hidden" name="PetugasID" value="<?php echo $row['PetugasID']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            <?php endif; ?>
                        </td>
                        </tr>
                    <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Petugas tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <a href="crud/tambah_petugas.php" class="btn btn-primary">Tambah Petugas</a>
        </section>
    </main>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>