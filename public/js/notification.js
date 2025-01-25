function loadNotifications() {
    fetch('http://tirta-bugar-laravel-version.test/notif')
        .then(response => response.json())
        .then(data => {
            const notificationList = document.getElementById('notification-list');
            const notificationBadge = document.querySelector('.notification-badge');
            
            // Kosongkan daftar notifikasi yang ada
            notificationList.innerHTML = '';

            // Periksa jumlah notifikasi
            if (data.count === 0) {
                // Jika tidak ada notifikasi, sembunyikan badge
                notificationBadge.style.display = 'none';
                
                // Tambahkan pesan "Tidak ada notifikasi"
                const li = document.createElement('li');
                li.textContent = 'Tidak ada notifikasi';
                notificationList.appendChild(li);
            } else {
                // Jika ada notifikasi, tampilkan badge dan isi daftar
                notificationBadge.classList.remove('hidden');
                notificationBadge.style.display = 'inline-block'; // Alternatif: tampilkan dengan inline style
                notificationBadge.textContent = data.count;

                data.messages.forEach(message => {
                    const li = document.createElement('li');
                    li.textContent = message;
                    notificationList.appendChild(li);
                });
            }
        })
        .catch(error => console.error('Error:', error));
}

// Inisialisasi notifikasi saat halaman dimuat
document.addEventListener('DOMContentLoaded', () => {
    loadNotifications();

    // Toggle popup saat mengklik ikon notifikasi
    const notificationIcon = document.getElementById('notificationIcon');
    const notificationPopup = document.getElementById('notification-popup');
    const closePopup = document.getElementById('close-popup');

    notificationIcon.addEventListener('click', (e) => {
        e.stopPropagation();
        notificationPopup.classList.toggle('hidden');
    });

    // Tutup popup saat mengklik tombol close
    closePopup.addEventListener('click', () => {
        notificationPopup.classList.add('hidden');
    });

    // Tutup popup saat mengklik di luar
    document.addEventListener('click', (e) => {
        if (!notificationPopup.contains(e.target) && e.target !== notificationIcon) {
            notificationPopup.classList.add('hidden');
        }
    });
});
