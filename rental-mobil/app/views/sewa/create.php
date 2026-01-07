<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-calendar-plus me-2"></i>Sewa Mobil Baru</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i> <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= BASEURL ?>/sewa/create<?= $mobil ? '/' . $mobil['id'] : '' ?>" method="POST" class="needs-validation" novalidate>
                        <?php if ($mobil): ?>
                            <!-- Display selected car info -->
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <?php if ($mobil['gambar']): ?>
                                                <img src="<?= UPLOAD_URL . $mobil['gambar'] ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($mobil['merk']) ?>">
                                            <?php else: ?>
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 100px;">
                                                    <i class="fas fa-car fa-2x text-secondary"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-9">
                                            <h5><?= htmlspecialchars($mobil['merk']) ?> <?= htmlspecialchars($mobil['model']) ?></h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <small class="text-muted">Tahun: <?= $mobil['tahun'] ?></small>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Bahan Bakar: <?= $mobil['bahan_bakar'] ?></small>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Transmisi: <?= $mobil['transmisi'] ?></small>
                                                </div>
                                                <div class="col-6">
                                                    <small class="text-muted">Kapasitas: <?= $mobil['kapasitas'] ?> orang</small>
                                                </div>
                                            </div>
                                            <div class="mt-2">
                                                <span class="price-tag">Rp <?= number_format($mobil['harga_per_hari'], 0, ',', '.') ?> /hari</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="mobil_id" value="<?= $mobil['id'] ?>">
                        <?php else: ?>
                            <!-- Select car from list -->
                            <div class="mb-3">
                                <label for="mobil_id" class="form-label">Pilih Mobil <span class="text-danger">*</span></label>
                                <select class="form-select" id="mobil_id" name="mobil_id" required>
                                    <option value="">-- Pilih Mobil --</option>
                                    <?php foreach ($all_mobil as $car): ?>
                                        <?php if ($car['status'] == 'tersedia'): ?>
                                            <option value="<?= $car['id'] ?>">
                                                <?= htmlspecialchars($car['merk']) ?> <?= htmlspecialchars($car['model']) ?> 
                                                - Rp <?= number_format($car['harga_per_hari'], 0, ',', '.') ?>/hari
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    Harap pilih mobil
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_sewa" class="form-label">Tanggal Sewa <span class="text-danger">*</span></label>
                                <input type="date" class="form-control datepicker" id="tanggal_sewa" name="tanggal_sewa" required>
                                <div class="invalid-feedback">
                                    Harap pilih tanggal sewa
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggal_kembali" class="form-label">Tanggal Kembali <span class="text-danger">*</span></label>
                                <input type="date" class="form-control datepicker" id="tanggal_kembali" name="tanggal_kembali" required>
                                <div class="invalid-feedback">
                                    Harap pilih tanggal kembali
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="lama_sewa" class="form-label">Lama Sewa (hari)</label>
                                <input type="text" class="form-control" id="lama_sewa" readonly>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="total_harga" class="form-label">Total Harga (Rp)</label>
                                <input type="text" class="form-control" id="total_harga" readonly>
                            </div>
                        </div>

                        <?php if ($mobil): ?>
                            <input type="hidden" id="harga_per_hari" value="<?= $mobil['harga_per_hari'] ?>">
                        <?php else: ?>
                            <!-- Will be populated by JavaScript -->
                            <input type="hidden" id="harga_per_hari" value="0">
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="catatan" class="form-label">Catatan (opsional)</label>
                            <textarea class="form-control" id="catatan" name="catatan" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= BASEURL ?>/sewa" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>Ajukan Sewa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize datepickers
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            startDate: new Date(),
            language: 'id'
        });

        // Function to calculate rental days and total price
        function calculateRental() {
            const tanggalSewa = document.getElementById('tanggal_sewa').value;
            const tanggalKembali = document.getElementById('tanggal_kembali').value;
            
            if (tanggalSewa && tanggalKembali) {
                const start = new Date(tanggalSewa);
                const end = new Date(tanggalKembali);
                
                if (start && end && end > start) {
                    // Calculate days
                    const diffTime = Math.abs(end - start);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                    
                    // Get price per day
                    let hargaPerHari = 0;
                    if (document.getElementById('harga_per_hari').value) {
                        hargaPerHari = parseFloat(document.getElementById('harga_per_hari').value);
                    } else if (document.getElementById('mobil_id')) {
                        // If car not pre-selected, we need to get price from selected option
                        const selectedCar = document.getElementById('mobil_id').selectedOptions[0];
                        if (selectedCar) {
                            const text = selectedCar.text;
                            const priceMatch = text.match(/Rp ([\d.,]+)/);
                            if (priceMatch) {
                                hargaPerHari = parseFloat(priceMatch[1].replace(/\./g, ''));
                            }
                        }
                    }
                    
                    // Calculate total
                    const totalHarga = diffDays * hargaPerHari;
                    
                    // Update fields
                    document.getElementById('lama_sewa').value = diffDays + ' hari';
                    document.getElementById('total_harga').value = 'Rp ' + totalHarga.toLocaleString('id-ID');
                }
            }
        }

        // Add event listeners
        document.getElementById('tanggal_sewa').addEventListener('change', calculateRental);
        document.getElementById('tanggal_kembali').addEventListener('change', calculateRental);
        
        if (document.getElementById('mobil_id')) {
            document.getElementById('mobil_id').addEventListener('change', function() {
                // Update hidden price field
                const selectedOption = this.selectedOptions[0];
                if (selectedOption) {
                    const text = selectedOption.text;
                    const priceMatch = text.match(/Rp ([\d.,]+)/);
                    if (priceMatch) {
                        const price = parseFloat(priceMatch[1].replace(/\./g, ''));
                        document.getElementById('harga_per_hari').value = price;
                        calculateRental();
                    }
                }
            });
        }

        // Initial calculation if dates are already filled
        calculateRental();
    });
</script>