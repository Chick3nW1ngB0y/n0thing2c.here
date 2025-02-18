<?php
session_start();
if (!isset($_SESSION['user_id'])) {
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
    <title>Kelola User - Kasir Mandalahayu</title>
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Kelola User</h1>
            <span class="welcome-text">Selamat datang, <?php echo $_SESSION['username']; ?>!</span>
            <img src="../asset/logo.png">
        </div>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li style="background: var(--color-violet);
                            color: var(--color-dark-blue);
                            border-radius: 5px;"><a href="kelola_user.php">Kelola User</a></li>
                <li><a href="pendaftaran.php">Pendaftaran</a></li>
                <li><a href="logout.php">Keluar</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Manajemen Pengguna</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pengguna</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
          
                include '../config/koneksi.php';

               
                $sql = "SELECT * FROM user";
                $result = $conn->query($sql);
                ?>

                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['userid']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                    <td>
                                    <button type="edit" href="edit_user.php?id=<?php echo $row['userid']; ?>">Edit</button>
                                    <button type="delete" href="delete_user.php?id=<?php echo $row['userid']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
