<?php
// Sertakan file koneksi database
include 'dbparkir.php';

// Ambil data dari request POST
$tempat = $_POST['tempat'] ?? null;

if ($tempat) {
    // Gunakan prepared statement untuk menghindari SQL injection
    $stmt = $conn->prepare("INSERT INTO datapemarkir (tempat_parkir) VALUES (?)");
    $stmt->bind_param("i", $tempat);

    if ($stmt->execute()) {
        echo "<h2>Tempat parkir $tempat berhasil dikonfirmasi!</h2>";
    } else {
        echo "<h2>Gagal menyimpan data: " . $stmt->error . "</h2>";
    }

    $stmt->close();
} else {
    echo "<h2>Tempat parkir tidak valid!</h2>";
}

$conn->close();
?>
