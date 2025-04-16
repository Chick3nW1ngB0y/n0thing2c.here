<?php
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

// Fetch transaction records
$sql = "SELECT p.PenjualanID, p.TanggalPenjualan, p.TotalHarga, 
               IFNULL(pel.NamaPelanggan, 'Umum') AS NamaPelanggan
        FROM penjualan p
        LEFT JOIN pelanggan pel ON p.PelangganID = pel.PelangganID
        ORDER BY p.TanggalPenjualan DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="../icon/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan - Kasir Mandalahayu</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Custom CSS -->
    <link rel="stylesheet" href="../../css/dashboard.css">
</head>
<body>
    <main class="container mt-4">
        <section>
        <h2 class="mb-4">Data Penjualan</h2>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Detail</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <strong>ID Penjualan:</strong> <?php echo $row['PenjualanID']; ?><br>
                                    <strong>Tanggal:</strong> <?php echo $row['TanggalPenjualan']; ?><br>
                                    <strong>Total Harga:</strong> Rp <?php echo number_format($row['TotalHarga'], 2, ',', '.'); ?><br>
                                    <strong>Pelanggan:</strong> <?php echo $row['NamaPelanggan'] ?? 'Umum'; ?>
                                </td>
                                <td>
                                    <?php if ($_SESSION['role'] === 'admin'): ?>
                                        <form method="POST" action="../config/delete_penjualan.php" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            <input type="hidden" name="PenjualanID" value="<?php echo $row['PenjualanID']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center">Tidak ada data penjualan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            </section>
        </div>
    </main>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>