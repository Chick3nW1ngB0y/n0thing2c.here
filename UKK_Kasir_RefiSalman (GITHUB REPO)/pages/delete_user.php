<?php
session_start();
include '../config/koneksi.php';

// Verify user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user ID from URL
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    
    // Prepare and execute delete query
    $sql = "DELETE FROM user WHERE userid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    
    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: kelola_user.php?message=User+deleted+successfully");
    } else {
        // Redirect with error message
        header("Location: kelola_user.php?message=Error+deleting+user");
    }
    
    $stmt->close();
}
$conn->close();
?>
