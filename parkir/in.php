<?php
// Sertakan koneksi database
include 'dbparkir.php';

// Ambil data NISN dari form
$nisn = $_POST['nisn'] ?? null;

// Validasi apakah NISN sudah dipilih
if (!empty($nisn)) {
    // Menggunakan prepared statements untuk mencegah SQL injection
    $stmt = $conn->prepare("INSERT INTO datapemarkir (data_pemarkir) VALUES (?)");
    $stmt->bind_param("s", $nisn);

    if ($stmt->execute()) {
        // Jika berhasil menyimpan, tampilkan halaman parkir
        echo "
        <!DOCTYPE html>
        <html lang='id'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>PARKIR SKATEN</title>
            <link rel='stylesheet' href='style.css'>
        </head>
        <body>
            <div class='container'>
                <header>
                    <h1>Mesin Parkir</h1>
                </header>
                <main>
                    <div class='parking-lot'>
                        <h2>Tempat Parkir</h2>
                        <div id='parking-spots' class='spots'>
                            <!-- Tempat parkir akan ditambahkan secara dinamis -->
                        </div>
                    </div>
                    <div class='controls'>
                        <button onclick='parkCar()'>Parkir Motor</button>
                        <button onclick='removeCar()'>Ambil Motor</button>
                    </div>
                </main>
            </div>

            <script>
                const totalSpots = 16;
                let parkingStatus = Array(totalSpots).fill(false); // Status parkir disimpan di memori
                let selectedSpot = null;

                const parkingSpotsContainer = document.getElementById('parking-spots');

                // Fungsi untuk merender tempat parkir
                function renderParkingSpots() {
                    parkingSpotsContainer.innerHTML = ''; // Kosongkan kontainer

                    parkingStatus.forEach((isOccupied, index) => {
                        const spot = document.createElement('div');
                        spot.className = 'spot';
                        spot.id = 'spot-' + index;
                        spot.textContent = isOccupied ? 'X' : index + 1;
                        spot.style.backgroundColor = isOccupied ? 'red' : 'green';

                        if (!isOccupied) {
                            spot.addEventListener('click', () => selectSpot(index));
                        }

                        parkingSpotsContainer.appendChild(spot);
                    });
                }

                // Fungsi untuk memilih tempat parkir
                function selectSpot(index) {
                    if (parkingStatus[index]) {
                        alert('Tempat parkir ' + (index + 1) + ' sudah terisi!'); // Notifikasi jika tempat sudah terisi
                        return;
                    }
                    document.querySelectorAll('.spot').forEach(spot => spot.classList.remove('selected'));
                    selectedSpot = index;
                    document.getElementById('spot-' + index).classList.add('selected');
                    alert('Tempat parkir ' + (index + 1) + ' dipilih');
                }

                // Fungsi untuk parkir motor
                function parkCar() {
                    if (selectedSpot !== null) {
                        if (!parkingStatus[selectedSpot]) {
                            parkingStatus[selectedSpot] = true; // Tandai tempat parkir sebagai terisi
                            alert('Motor dengan NISN: \"$nisn\" diparkir di tempat ' + (selectedSpot + 1));
                            renderParkingSpots();
                        } else {
                            alert('Tempat parkir ' + (selectedSpot + 1) + ' sudah terisi!'); // Notifikasi jika tempat sudah terisi
                        }
                    } else {
                        alert('Pilih tempat parkir terlebih dahulu!');
                    }
                }

                // Fungsi untuk mengambil motor
                function removeCar() {
                    if (selectedSpot !== null && parkingStatus[selectedSpot]) {
                        parkingStatus[selectedSpot] = false; // Tandai tempat parkir sebagai kosong
                        alert('Motor di tempat ' + (selectedSpot + 1) + ' diambil');
                        selectedSpot = null;
                        renderParkingSpots();
                    } else {
                        alert('Pilih tempat yang terisi untuk mengambil motor!');
                    }
                }

                // Render tempat parkir saat halaman dimuat
                renderParkingSpots();
            </script>
        </body>
        </html>";
    } else {
        echo "Gagal menyimpan NISN: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Pilih NISN terlebih dahulu!";
}

$conn->close();
?>
