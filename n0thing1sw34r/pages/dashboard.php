<?php
session_start();
if (!isset($_SESSION['PetugasID'])) {
    header("Location: ../login.php");
    exit();
}

include '../config/koneksi.php';

// Fetch the logged-in user's PetugasID
$petugasID = $_SESSION['PetugasID'];

// Include the appropriate navbar
if ($_SESSION['role'] === 'admin') {
    include '../config/navbar-admin.php';
} elseif ($_SESSION['role'] === 'petugas') {
    include '../config/navbar-petugas.php';
} else {
    echo "Role tidak dikenal.";
    exit;
}

// Fetch the NamaPetugas from the database
$sql_petugas = "SELECT NamaPetugas FROM petugas WHERE PetugasID = ?";
$stmt = $conn->prepare($sql_petugas);
$stmt->bind_param("i", $petugasID);
$stmt->execute();
$result_petugas = $stmt->get_result();
$namaPetugas = $result_petugas->fetch_assoc()['NamaPetugas'] ?? 'User';

$sql_petugas = "SELECT role FROM petugas WHERE PetugasID = ?";
$stmt = $conn->prepare($sql_petugas);
$stmt->bind_param("i", $petugasID);
$stmt->execute();
$result_petugas = $stmt->get_result();
$role = $result_petugas->fetch_assoc()['role'] ?? 'User';

// Fetch the count of products
$sql_produk = "SELECT COUNT(*) as count FROM produk";
$result_produk = $conn->query($sql_produk);
$count_produk = $result_produk->fetch_assoc()['count'];

// Fetch the count of sales
$sql_penjualan = "SELECT COUNT(*) as count FROM penjualan";
$result_penjualan = $conn->query($sql_penjualan);
$count_penjualan = $result_penjualan->fetch_assoc()['count'];

// Fetch the count of users
$sql_pengguna = "SELECT COUNT(*) as count FROM petugas";
$result_pengguna = $conn->query($sql_pengguna);
$count_pengguna = $result_pengguna->fetch_assoc()['count'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="../asset/icon/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kasir Mandalahayu</title>
    <link rel="stylesheet" href="../../css/dashboard.css">
    <!-- Add Bootstrap for the new design -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-container d-flex justify-content-between align-items-center">
            <div class="welcome-text">
                
            </div>
        </div>
    </header>
    <main>
        <div class="container mt-4">
            <h2 class="mb-4 text-white">Dashboard</h2>
            <div class="row">
                <!-- Jumlah Pengguna -->
                <div class="col-md-4">
                    <div class="card text-white mb-3 shadow rounded" style="background-color: #342d76;">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-people-fill"></i> Jumlah Pengguna</h4>
                            <h1 class="card-text text-left">
                                <?php echo $count_pengguna['count'] ?? 0; ?>
                            </h1>
                        </div>
                    </div>
                </div>

                <!-- Jumlah Barang -->
                <div class="col-md-4">
                    <div class="card text-white mb-3 shadow rounded" style="background-color: #001f3f;">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-box-seam-fill"></i> Jumlah Barang</h4>
                            <h1 class="card-text text-left">
                                <?php echo $count_produk ?? 0; ?>
                            </h1>
                        </div>
                    </div>
                </div>

                <!-- Jumlah Penjualan -->
                <div class="col-md-4">
                    <div class="card text-white mb-3 shadow rounded" style="background-color: #603070;">
                        <div class="card-body">
                            <h4 class="card-title"><i class="bi bi-bag-check-fill"></i> Jumlah Penjualan</h4>
                            <h1 class="card-text text-left">
                                <?php echo $count_penjualan ?? 0; ?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Add Bootstrap JS for responsiveness -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>