const totalSpots = 16; // Jumlah tempat parkir
const parkingSpotsContainer = document.getElementById('parking-spots');

// Inisialisasi status parkir dari localStorage
let parkingStatus = JSON.parse(localStorage.getItem('parkingStatus')) || Array(totalSpots).fill(false);
let selectedSpot = null; // Variabel untuk menyimpan tempat parkir yang dipilih

// Fungsi untuk merender tempat parkir berdasarkan status
function renderParkingSpots() {
    parkingSpotsContainer.innerHTML = ''; // Kosongkan kontainer

    parkingStatus.forEach((isOccupied, index) => {
        const spot = document.createElement('div');
        spot.className = 'spot';
        spot.id = `spot-${index}`;
        spot.textContent = isOccupied ? 'X' : index + 1;
        spot.style.backgroundColor = isOccupied ? 'red' : 'green';

        // Hanya tambahkan event listener jika tempat kosong
        if (!isOccupied) {
            spot.addEventListener('click', () => selectSpot(index));
        }

        parkingSpotsContainer.appendChild(spot);
    });
}




// Fungsi untuk memilih tempat parkir
function selectSpot(index) {
    selectedSpot = index; // Simpan indeks tempat yang dipilih
    alert(`Tempat parkir ${index + 1} dipilih`);
}

// Fungsi untuk parkir motor di tempat yang dipilih
function parkCar() {
    const nisn = document.getElementById('nisn').value;
    if (!nisn) {
        alert('Masukkan NISN terlebih dahulu!');
        return;
    }

    if (selectedSpot !== null) {
        parkingStatus[selectedSpot] = true; // Tandai tempat sebagai terisi
        localStorage.setItem('parkingStatus', JSON.stringify(parkingStatus)); // Simpan status ke localStorage
        alert(`Motor diparkir di tempat ${selectedSpot + 1}`);

        // Redirect ke konfirmasi.php dengan NISN sebagai parameter
        window.location.href = `konfirmasi.php?nisn=${nisn}&spot=${selectedSpot + 1}`;
    } else {
        alert('Pilih tempat parkir terlebih dahulu!');
    }
}

// Fungsi untuk mengambil motor
function removeCar() {
    const filledSpotIndex = parkingStatus.indexOf(true); // Cari tempat terisi
    if (filledSpotIndex !== -1) {
        parkingStatus[filledSpotIndex] = false; // Tandai tempat sebagai kosong
        localStorage.setItem('parkingStatus', JSON.stringify(parkingStatus)); // Simpan status ke localStorage
        alert(`Motor di tempat ${filledSpotIndex + 1} diambil`);
    } else {
        alert('Tidak ada motor yang diparkir!');
    }
    renderParkingSpots(); // Perbarui tampilan
}

// Render tempat parkir saat halaman dimuat
renderParkingSpots();

