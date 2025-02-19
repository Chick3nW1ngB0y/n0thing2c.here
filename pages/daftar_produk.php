<?php
session_start();
if (!isset($_SESSION['user_id'])) 
{
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="../asset/icon/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Kasir Mandalahayu</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <header>
    <div class="header-container">
        <h1>Kasir Punklorde</h1>
    </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="data_pelanggan.php">Data Pelanggan</a></li>
                <li style="background: var(--color-violet);
                        color: var(--color-dark-blue);
                        border-radius: 5px;"><a href="daftar_produk.php">Daftar Produk</a></li>
                <li><a href="data_penjualan.php">Data Penjualan</a></li>
                <li><a href="../config/logout.php">Keluar</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <section>
            <h2>Manajemen Daftar Produk</h2>
            <table>
                <thead>
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
          
                include '../config/koneksi.php';

                $sql = "SELECT * FROM produk";
                $result = $conn->query($sql);
                ?>

                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['ProdukID']; ?></td>
                                <td><?php echo $row['NamaProduk']; ?></td>
                                <td>Rp<?php echo number_format($row['Harga'], 2, ',', '.'); ?> </td>
                                <td><?php echo $row['Stok']; ?></td>
                                    <td>
                                    <button type="edit" href="edit_produk.php?id=<?php echo $row['ProdukID']; ?>">Edit</button>
                                    <button type="delete" href="../config/delete_produk.php?id=<?php echo $row['ProdukID']; ?>" onclick="return confirm('Anda yakin mau hapus produk ini?');">Delete</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No products found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

                </tbody>
            </table>
        </section>
        <section>
            <a href="tambah_produk.php">Tambah Produk</a>
        </section>
    </main>
</body>
</html>
