<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['level']==""){
    header("location:../index.php?pesan=gagal");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title> Halaman Administrator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstra@p5.3.2/dist/css/bootstrap.min.css"rell="stylesheet" integrity="sha384-t3c6CoIi6uLrA9TneNEoa7Rxna"crossorigin="anonymous">    
</head>
<body>
    <div class="container">
        <div class="content">