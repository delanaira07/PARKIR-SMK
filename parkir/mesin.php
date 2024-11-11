<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesin Parkiran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            gap: 20px;
        }
        .parkir {
            display: grid;
            grid-template-columns: repeat(4, 100px);
            gap: 10px;
        }
        .kotak {
            width: 100px;
            height: 100px;
            background-color: #007bff;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .kotak:hover {
            background-color: #0056b3;
        }
        .terpilih {
            background-color: #dc3545;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="parkir">
    <div class="kotak" onclick="toggleSelect(this)">1</div>
    <div class="kotak" onclick="toggleSelect(this)">2</div>
    <div class="kotak" onclick="toggleSelect(this)">3</div>
    <div class="kotak" onclick="toggleSelect(this)">4</div>
    <div class="kotak" onclick="toggleSelect(this)">5</div>
    <div class="kotak" onclick="toggleSelect(this)">6</div>
    <div class="kotak" onclick="toggleSelect(this)">7</div>
    <div class="kotak" onclick="toggleSelect(this)">8</div>
    <div class="kotak" onclick="toggleSelect(this)">9</div>
    <div class="kotak" onclick="toggleSelect(this)">10</div>
    <div class="kotak" onclick="toggleSelect(this)">11</div>
    <div class="kotak" onclick="toggleSelect(this)">12</div>
    <div class="kotak" onclick="toggleSelect(this)">13</div>
    <div class="kotak" onclick="toggleSelect(this)">14</div>
    <div class="kotak" onclick="toggleSelect(this)">15</div>
    <div class="kotak" onclick="toggleSelect(this)">16</div>
</div>

<!-- Form untuk kirim data dengan POST -->
<form id="parkirForm" action="konfirmasi.php" method="POST" style="display:none;">
    <input type="hidden" name="tempat" id="tempatInput">
</form>

<button onclick="konfirmasiPilihan()">Konfirmasi</button>

<script>
    let selectedSpot = null; // Menyimpan tempat parkir terpilih

    function toggleSelect(kotak) {
        const semuaKotak = document.querySelectorAll('.kotak');
        semuaKotak.forEach(k => {
            k.innerHTML = k.textContent; // Kembalikan tampilan awal
            k.classList.remove('terpilih');
        });

        kotak.classList.add('terpilih');
        kotak.innerHTML = 'X';
        selectedSpot = kotak.textContent; // Simpan nomor tempat parkir
    }

    function konfirmasiPilihan() {
        if (selectedSpot) {
            // Masukkan nomor tempat parkir ke input tersembunyi
            document.getElementById('tempatInput').value = selectedSpot;
            // Kirim form
            document.getElementById('parkirForm').submit();
        } else {
            alert('Silakan pilih tempat parkir terlebih dahulu.');
        }
    }
</script>

</body>
</html>
