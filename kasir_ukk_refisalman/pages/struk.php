<?php
// filepath: c:\xampp\htdocs\kasir_ukk_refisalman\pages\struk.php
session_start();
include '../config/koneksi.php';

// Get the transaction ID from the query string
$transactionId = isset($_GET['transaction_id']) ? intval($_GET['transaction_id']) : 0;

// Fetch transaction details
$query = "SELECT * FROM penjualan WHERE PenjualanID = $transactionId";
$result = $conn->query($query);
$transaction = $result->fetch_assoc();

// Fetch transaction items
$queryItems = "SELECT dp.*, p.NamaProduk 
               FROM detailpenjualan dp
               JOIN produk p ON dp.ProdukID = p.ProdukID
               WHERE dp.PenjualanID = $transactionId";
$resultItems = $conn->query($queryItems);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Penjualan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Struk Penjualan</h2>
        <hr>
        <p><strong>ID Transaksi:</strong> <?php echo $transaction['PenjualanID']; ?></p>
        <p><strong>Tanggal:</strong> <?php echo $transaction['TanggalPenjualan']; ?></p>
        <p><strong>Total Harga:</strong> Rp <?php echo number_format($transaction['TotalHarga'], 0, ',', '.'); ?></p>
        <hr>
        <h4>Detail Barang</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $resultItems->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $item['NamaProduk']; ?></td>
                        <td><?php echo $item['JumlahProduk']; ?></td>
                        <td>Rp <?php echo number_format($item['Harga'], 0, ',', '.'); ?></td>
                        <td>Rp <?php echo number_format($item['JumlahProduk'] * $item['Harga'], 0, ',', '.'); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <hr>
        <button class="btn btn-primary" onclick="window.print()">Print</button>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>