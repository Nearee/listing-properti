// public/assets/js/notifikasi.js

document.addEventListener("DOMContentLoaded", function() {
    var toastEl = document.getElementById('liveToast');
    if (toastEl) {
        // Inisialisasi dan tampilkan toast
        var toast = new bootstrap.Toast(toastEl, { delay: 5000 });
        toast.show();
    }
});