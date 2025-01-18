// fungsi show password
function showPassword() {
    let passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

function updateEndDate() {
    const paketSelect = document.getElementById('durasi');
    const startDateInput = document.getElementById('tanggal-awal');
    const endDateInput = document.getElementById('tanggal-akhir');

    const startDate = new Date(startDateInput.value);
    let duration = 0;

    switch (paketSelect.value) {
        case '1':
            duration = 1; // 1 bulan
            break;
        case '2':
            duration = 1; // 1 bulan
            break;
        case '3':
            duration = 3; // 3 bulan
            break;
        case '4':
            duration = 1; // 1 bulan
            break;
        default:
            duration = 0; // default atau paket lainnya
    }

    if (duration > 0) {
        const endDate = new Date(startDate);
        endDate.setMonth(endDate.getMonth() + duration);
        
        // Format tanggal menjadi yyyy-mm-dd
        const month = String(endDate.getMonth() + 1).padStart(2, '0'); 
        const day = String(endDate.getDate()).padStart(2, '0');
        const year = endDate.getFullYear();

        endDateInput.value = `${year}-${month}-${day}`;
    }
}

// Call updateEndDate when the page loads to set initial end date
document.addEventListener('DOMContentLoaded', updateEndDate);