<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="mb-0">Detail Penyewaan</h3>
                        <span class="status-badge status-<?= $sewa['status'] ?>">
                            <?= ucfirst($sewa['status']) ?>
                        </span>
                    </div>

                    <div class="row">
                        <!-- Car Info -->
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-car me-2"></i>Informasi Mobil</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <?php if ($sewa['gambar']): ?>
                                                <img src="<?= UPLOAD_URL . $sewa['gambar'] ?>" class="img-fluid rounded" alt="<?= htmlspecialchars($sewa['merk']) ?>">
                                            <?php else: ?>
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 150px;">
                                                    <i class="fas fa-car fa-3x text-secondary"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-8">
                                            <h5><?= htmlspecialchars($sewa['merk']) ?> <?= htmlspecialchars($sewa['model']) ?></h5>
                                            <div class="row">
                                                <div class="col-6">
                                                    <p class="mb-1"><small class="text-muted">Harga/Hari</small></p>
                                                    <p class="fw-bold">Rp <?= number_format($sewa['harga_per_hari'], 0, ',', '.') ?></p>
                                                </div>
                                                <div class="col-6">
                                                    <p class="mb-1"><small class="text-muted">Plat Nomor</small></p>
                                                    <p><?= htmlspecialchars($mobil['plat_nomor'] ?? '-') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rental Info -->
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Informasi Penyewaan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Tanggal Sewa</strong></p>
                                            <p><?= date('d M Y', strtotime($sewa['tanggal_sewa'])) ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Tanggal Kembali</strong></p>
                                            <p><?= date('d M Y', strtotime($sewa['tanggal_kembali'])) ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Lama Sewa</strong></p>
                                            <p><span class="badge bg-info"><?= $sewa['lama_sewa'] ?> hari</span></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Total Harga</strong></p>
                                            <h5 class="text-primary">Rp <?= number_format($sewa['total_harga'], 0, ',', '.') ?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- User Info and Notes -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>Informasi Penyewa</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Nama</strong></p>
                                            <p><?= htmlspecialchars($sewa['username']) ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1"><strong>Email</strong></p>
                                            <p><?= htmlspecialchars($sewa['email']) ?></p>
                                        </div>
                                        <div class="col-12">
                                            <p class="mb-1"><strong>Tanggal Pengajuan</strong></p>
                                            <p><?= date('d M Y H:i', strtotime($sewa['created_at'])) ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-sticky-note me-2"></i>Catatan</h5>
                                </div>
                                <div class="card-body">
                                    <?php if ($sewa['catatan']): ?>
                                        <p class="mb-0"><?= nl2br(htmlspecialchars($sewa['catatan'])) ?></p>
                                    <?php else: ?>
                                        <p class="text-muted mb-0">Tidak ada catatan</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= BASEURL ?>/sewa" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                        </a>
                        
                        <?php if ($role == 'admin'): ?>
                            <div class="btn-group">
                                <?php if ($sewa['status'] == 'pending'): ?>
                                    <a href="<?= BASEURL ?>/sewa/updateStatus/<?= $sewa['id'] ?>/diproses" class="btn btn-warning">
                                        <i class="fas fa-cog me-2"></i>Proses
                                    </a>
                                    <a href="<?= BASEURL ?>/sewa/updateStatus/<?= $sewa['id'] ?>/disetujui" class="btn btn-success">
                                        <i class="fas fa-check me-2"></i>Setujui
                                    </a>
                                    <a href="<?= BASEURL ?>/sewa/updateStatus/<?= $sewa['id'] ?>/ditolak" class="btn btn-danger">
                                        <i class="fas fa-times me-2"></i>Tolak
                                    </a>
                                <?php elseif ($sewa['status'] == 'diproses'): ?>
                                    <a href="<?= BASEURL ?>/sewa/updateStatus/<?= $sewa['id'] ?>/disetujui" class="btn btn-success">
                                        <i class="fas fa-check me-2"></i>Setujui
                                    </a>
                                    <a href="<?= BASEURL ?>/sewa/updateStatus/<?= $sewa['id'] ?>/ditolak" class="btn btn-danger">
                                        <i class="fas fa-times me-2"></i>Tolak
                                    </a>
                                <?php elseif ($sewa['status'] == 'disetujui'): ?>
                                    <a href="<?= BASEURL ?>/sewa/updateStatus/<?= $sewa['id'] ?>/selesai" class="btn btn-info">
                                        <i class="fas fa-flag-checkered me-2"></i>Tandai Selesai
                                    </a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>