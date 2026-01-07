    </div> <!-- Close main-content -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (for datepicker) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap Datepicker -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/locales/bootstrap-datepicker.id.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Mobile sidebar toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            if (mobileMenuToggle && sidebar) {
                mobileMenuToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    mobileMenuToggle.innerHTML = sidebar.classList.contains('show') 
                        ? '<i class="fas fa-times"></i>' 
                        : '<i class="fas fa-bars"></i>';
                });
                
                // Close sidebar when clicking outside on mobile
                document.addEventListener('click', function(event) {
                    if (window.innerWidth < 992) {
                        if (!sidebar.contains(event.target) && !mobileMenuToggle.contains(event.target)) {
                            sidebar.classList.remove('show');
                            mobileMenuToggle.innerHTML = '<i class="fas fa-bars"></i>';
                        }
                    }
                });
            }
            
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
            
            // Form validation
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
            
            // Initialize datepickers
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                language: 'id'
            });
            
            // Calculate total price for rental
            function calculateTotalPrice() {
                const hargaPerHari = parseFloat(document.getElementById('harga_per_hari')?.value) || 0;
                const tanggalSewa = new Date(document.getElementById('tanggal_sewa')?.value);
                const tanggalKembali = new Date(document.getElementById('tanggal_kembali')?.value);
                
                if (!isNaN(tanggalSewa) && !isNaN(tanggalKembali) && tanggalKembali > tanggalSewa) {
                    const diffTime = Math.abs(tanggalKembali - tanggalSewa);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                    const totalHarga = diffDays * hargaPerHari;
                    
                    const totalElement = document.getElementById('total_harga');
                    const lamaSewaElement = document.getElementById('lama_sewa');
                    
                    if (totalElement) totalElement.value = totalHarga.toLocaleString('id-ID');
                    if (lamaSewaElement) lamaSewaElement.value = diffDays;
                }
            }
            
            // Attach event listeners for price calculation
            const tanggalInputs = document.querySelectorAll('#tanggal_sewa, #tanggal_kembali');
            tanggalInputs.forEach(input => {
                input.addEventListener('change', calculateTotalPrice);
            });
            
            // Mobile detection
            function isMobile() {
                return window.innerWidth < 992;
            }
            
            // Adjust sidebar on resize
            window.addEventListener('resize', function() {
                if (!isMobile()) {
                    sidebar?.classList.remove('show');
                    if (mobileMenuToggle) {
                        mobileMenuToggle.innerHTML = '<i class="fas fa-bars"></i>';
                    }
                }
            });
            
            // Confirm delete actions
            const deleteButtons = document.querySelectorAll('.btn-delete');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menghapus?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</body>
</html>