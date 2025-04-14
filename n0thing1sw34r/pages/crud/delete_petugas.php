<?php
if (!isset($_POST['PetugasID']) || !is_numeric($_POST['PetugasID'])) {
    header('Location: kelola_user.php?error=Invalid+Petugas+ID');
    exit();
}

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        header('Location: kelola_user.php?message=Petugas+berhasil+dihapus');
    } else {
        header('Location: kelola_user.php?error=Petugas+tidak+ditemukan');
    }
} else {
    header('Location: kelola_user.php?error=Gagal+menghapus+petugas');
}

$stmt->close();
$conn->close();
exit();
?>