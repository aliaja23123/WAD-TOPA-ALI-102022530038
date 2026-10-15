<?php

$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_katalog"
);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?> 