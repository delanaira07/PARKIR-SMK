<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "parkir");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih NISN untuk Parkir motor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('backround.gif');
            background-color: #4b8cc5;
            margin: 0;
            padding: 20px;
            background-size: cover;
            background-repeat: no-repeat;
        }
        .container {
            max-width: 600px;
            margin: auto;
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        select, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .submit-button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: not-allowed;
            transition: background-color 0.3s;
        }
        .submit-button:enabled {
            cursor: pointer;
        }
        .submit-button:hover:enabled {
            background-color: #218838;
        }
    </style>
    <script>
        function cekPilihan() {
            const nisn = document.getElementById('nisn').value;
            const tombol = document.querySelector('.submit-button');
            tombol.disabled = !nisn;
        }
    </script>
</head>
<body>
<div class="container">
    <h2>Pilih NISN untuk Parkir motor</h2>
    <form action="in.php" method="POST">
        <label for="nisn">Pilih NISN:</label>
        <select id="nisn" name="nisn" required onchange="cekPilihan()">
    <option value="">-- Pilih NISN --</option>
    <option value="23145 - Afif Akmal Maulana">23145 - Afif Akmal Maulana</option>
    <option value="23146 - Alian Daim Yuga">23146 - Alian Daim Yuga</option>
    <option value="23147 - Amelia Dwi Anjani">23147 - Amelia Dwi Anjani</option>
    <option value="23148 - Belinda Besty">23148 - Belinda Besty</option>
    <option value="23149 - Calvin Rega Prasetya Seno">23149 - Calvin Rega Prasetya Seno</option>
    <option value="23150 - Delanaira Nazwa Muliana">23150 - Delanaira Nazwa Muliana</option>
    <option value="23151 - Farel Bintang Praditya Narendra">23151 - Farel Bintang Praditya Narendra</option>
    <option value="23152 - Gagah Panji Bramasta">23152 - Gagah Panji Bramasta</option>
    <option value="23153 - Gagah Panji Pastaka">23153 - Gagah Panji Pastaka</option>
    <option value="23154 - Halimah Sa'dyah">23154 - Halimah Sa'dyah</option>
    <option value="23155 - Imelda Megananda">23155 - Imelda Megananda</option>
    <option value="23156 - Kharisma Aufa Rahmadani">23156 - Kharisma Aufa Rahmadani</option>
    <option value="23157 - Kylla Arfa Fosetta">23157 - Kylla Arfa Fosetta</option>
    <option value="23158 - Lentera Wulan Kurnia">23158 - Lentera Wulan Kurnia</option>
    <option value="23159 - Mahessa Gilang Firmansyah">23159 - Mahessa Gilang Firmansyah</option>
    <option value="23160 - Marshella Aulia Ulfa">23160 - Marshella Aulia Ulfa</option>
</select>

        <button type="submit" class="submit-button" onclick="parkCar()" disabled>Parkir</button>
    </form>
</div>

<?php $conn->close(); ?>
</body>
</html>
