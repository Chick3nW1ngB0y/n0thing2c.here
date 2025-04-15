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
    <link rel="icon" href="../asset/icon/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Kasir Mandalahayu</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Custom CSS -->
    <link rel="stylesheet" href="../../css/dashboard.css">
</head>
<body>
    <main class="container mt-4">
        <section>
            <h2 class="mb-4">Manajemen Daftar Produk</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM produk";
                    $result = $conn->query($sql);
                    ?>

                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['ProdukID']; ?></td>
                                <td><?php echo $row['NamaProduk']; ?></td>
                                <td>Rp<?php echo number_format($row['Harga'], 2, ',', '.'); ?></td>
                                <td><?php echo $row['Stok']; ?></td>
                                <td>
                                    <a href="crud/edit_produk.php?id=<?php echo $row['ProdukID']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="crud/delete_produk.php" method="POST" class="d-inline" onsubmit="return confirm('Anda yakin mau hapus produk ini?');">
                                        <input type="hidden" name="ProdukID" value="<?php echo $row['ProdukID']; ?>">
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Produk tidak ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <section>
            <a href="crud/tambah_produk.php" class="btn btn-primary">Tambah Produk</a>
        </section>
    </main>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>