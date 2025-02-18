<?php
session_start();
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username']; 
    $password = $_POST['password'];

    // Prepare the SQL statement
    $query = "SELECT * FROM user WHERE username = ?"; 

    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $user = $result->fetch_assoc();

        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['userid'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header('Location: dashboard.php');
            exit();
        } else {
            // Redirect to login with error message
            header('Location: login.php?error=invalid_credentials');
            exit();
        }
    } else {
        // Redirect to login with error message
        header('Location: login.php?error=invalid_credentials');
        exit();
    }
}
?>
