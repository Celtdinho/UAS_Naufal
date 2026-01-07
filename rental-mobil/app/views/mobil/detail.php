<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- Car Image -->
                        <div class="col-md-6 mb-4 mb-md-0">
                            <?php if ($mobil['gambar']): ?>
                                <img src="<?= UPLOAD_URL . $mobil['gambar'] ?>" class="img-fluid rounded car-img-detail" alt="<?= htmlspecialchars($mobil['merk']) ?>">
                            <?php else: ?>
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 300px;">
                                    <i class="fas fa-car fa-5x text-secondary"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Car Details -->
                        <div class="col-md-6">
                            <h2 class="mb-3"><?= htmlspecialchars($mobil['merk']) ?> <?= htmlspecialchars($mobil['model']) ?></h2>
                            
                            <div class="mb-4">
                                <span class="price-tag">Rp <?= number_format($mobil['harga_per_hari'], 0, ',', '.') ?> /hari</span>
                                <span class="status-badge status-<?= $mobil['status'] == 'tersedia' ? 'disetujui' : 'ditolak' ?> ms-2">
                                    <?= $mobil['status'] ?>
                                </span>
                            </div>

                            <div class="row mb-4">
                                <div class="col-6">
                                    <p class="mb-1"><strong>Tahun</strong></p>
                                    <p><?= $mobil['tahun'] ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1"><strong>Warna</strong></p>
                                    <p><?= htmlspecialchars($mobil['warna']) ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1"><strong>Plat Nomor</strong></p>
                                    <p><?= htmlspecialchars($mobil['plat_nomor']) ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1"><strong>Transmisi</strong></p>
                                    <p><?= ucfirst($mobil['transmisi']) ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1"><strong>Bahan Bakar</strong></p>
                                    <p><?= ucfirst($mobil['bahan_bakar']) ?></p>
                                </div>
                                <div class="col-6">
                                    <p class="mb-1"><strong>Kapasitas</strong></p>
                                    <p><?= $mobil['kapasitas'] ?> orang</p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <h5>Deskripsi</h5>
                                <p class="text-muted"><?= nl2br(htmlspecialchars($mobil['deskripsi'])) ?></p>
                            </div>

                            <div class="d-flex flex-wrap gap-3">
                                <a href="<?= BASEURL ?>/mobil" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                                
                                <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'admin'): ?>
                                    <a href="<?= BASEURL ?>/mobil/edit/<?= $mobil['id'] ?>" class="btn btn-warning">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </a>
                                <?php endif; ?>

                                <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'user' && $mobil['status'] == 'tersedia'): ?>
                                    <a href="<?= BASEURL ?>/sewa/create/<?= $mobil['id'] ?>" class="btn btn-primary">
                                        <i class="fas fa-calendar-check me-2"></i>Sewa Sekarang
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>