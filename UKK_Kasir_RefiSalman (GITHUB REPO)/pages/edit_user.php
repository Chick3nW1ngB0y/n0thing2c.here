<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../config/koneksi.php';

// Get user ID from URL parameter
$user_id = $_GET['id'] ?? null;

if (!$user_id) {
    header("Location: kelola_user.php");
    exit();
}

// Fetch user data
$sql = "SELECT * FROM user WHERE userid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    header("Location: kelola_user.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update user data
    $update_sql = "UPDATE user SET username = ?, password = ? WHERE userid = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssi", $username, $password, $user_id);
    
    if ($update_stmt->execute()) {
        header("Location: kelola_user.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <link rel="icon" href="../asset/icon/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Kasir Mandalahayu</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Edit User</h1>
            <span class="welcome-text">Selamat datang, <?php echo $_SESSION['username']; ?>!</span>
            <img src="../asset/logo.png">
        </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="kelola_user.php">Kelola User</a></li>
                <li><a href="pendaftaran.php">Pendaftaran</a></li>
                <li><a href="logout.php">Keluar</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Edit User</h2>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Nama Pengguna:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" required>
                </div>
                <button type="submit">Simpan Perubahan</button>
                <a href="kelola_user.php" class="cancel-btn">Batal</a>
            </form>
        </section>
    </main>
</body>
</html>
