<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "parkir";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
