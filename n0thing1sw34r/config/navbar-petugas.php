<!-- filepath: c:\xampp\htdocs\kasir_ukk_refisalman\config\navbar-petugas.php -->
<?php
// Ensure session is started and database connection is included
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'koneksi.php';

// Fetch the logged-in user's details
$petugasID = $_SESSION['PetugasID'] ?? null;
$namaPetugas = 'User';
$role = 'User';

if ($petugasID) {
    $stmt = $conn->prepare("SELECT NamaPetugas, Role FROM petugas WHERE PetugasID = ?");
    $stmt->bind_param("i", $petugasID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $namaPetugas = $row['NamaPetugas'];
        $role = $row['Role'];
    }
    $stmt->close();
}

// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header>
    <div class="header-container d-flex justify-content-between align-items-center">
        <h1>Kasir Punklorde</h1>
        <div class="welcome-text">
            <p>Welcome, <?php echo htmlspecialchars($role); ?>: <?php echo htmlspecialchars($namaPetugas); ?></p>
        </div>
    </div>
    <nav>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link <?php echo $current_page == 'penjualan.php' ? 'active' : ''; ?>" href="../pages/penjualan.php">Penjualan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $current_page == 'daftar_produk.php' ? 'active' : ''; ?>" href="../pages/daftar_produk.php">Daftar Produk</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../config/logout.php">Keluar</a>
            </li>
        </ul>
    </nav>
</header>