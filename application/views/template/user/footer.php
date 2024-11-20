<body class="d-flex flex-column min-vh-100">
    <!-- Konten Halaman Lain -->
    
    <footer class="bg-light text-center py-4 mt-auto">
        <p>&copy; 2024 SistemManagementSeminar. By 
            <a href="https://instagram.com/ridwansaputra_62" target="_blank" rel="noopener noreferrer">ME</a>.
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const profileButton = document.getElementById('profileButton');
            const navbarCollapse = document.getElementById('navbarNav');
            const namaUser = profileButton.querySelector('span'); // Asumsi nama user berada di dalam elemen <span>

            profileButton.addEventListener('click', function () {
                this.classList.toggle('active'); // Toggle the active class on click
            });

            // Ketika navbar dibuka
            navbarCollapse.addEventListener('shown.bs.collapse', function () {
                if (namaUser) {
                    namaUser.style.display = 'none'; // Sembunyikan nama user
                }
            });

            // Ketika navbar ditutup
            navbarCollapse.addEventListener('hidden.bs.collapse', function () {
                if (namaUser) {
                    namaUser.style.display = 'inline'; // Tampilkan kembali nama user
                }
            });
        });
    </script>
    
</body>
