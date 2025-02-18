<?php
$koneksi = mysqli_connect("localhost","root","","ukk_kasir_jo");

// Check connection
if (mysqli_connect_error()){
    echo "koneksi database gagal : " . mysqli_connect_error();
}

?>