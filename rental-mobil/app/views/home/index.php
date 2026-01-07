<div class="container-fluid">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h1 class="display-4 fw-bold mb-3 text-dark">Sewa Mobil Mudah & Cepat</h1>
                <p class="lead mb-4">Temukan mobil terbaik untuk perjalanan Anda dengan harga terjangkau. Pilihan lengkap, proses mudah, dan pelayanan terbaik.</p>
                
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="<?= BASEURL ?>/auth/register" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                        </a>
                        <a href="<?= BASEURL ?>/auth/login" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                    </div>
                <?php else: ?>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="<?= BASEURL ?>/sewa" class="btn btn-primary btn-lg">
                            <i class="fas fa-list me-2"></i> Lihat Sewa Saya
                        </a>
                        <?php if ($_SESSION['role'] == 'user'): ?>
                            <a href="<?= BASEURL ?>/sewa/create" class="btn btn-success btn-lg">
                                <i class="fas fa-plus me-2"></i> Sewa Mobil Baru
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                     class="img-fluid rounded shadow-lg" alt="Car Rental">
            </div>
        </div>
    </div>

    <!-- Featured Cars -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-dark"><i class="fas fa-star me-2"></i>Mobil Tersedia</h2>
                <?php if (count($mobil) > 3): ?>
                    <a href="<?= BASEURL ?>/mobil" class="btn btn-outline-primary">
                        Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                <?php endif; ?>
            </div>
            
            <?php if (empty($mobil)): ?>
                <div class="empty-state">
                    <i class="fas fa-car"></i>
                    <h4 class="mb-3">Tidak ada mobil tersedia</h4>
                    <p class="text-muted">Silakan hubungi admin untuk informasi lebih lanjut.</p>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach (array_slice($mobil, 0, 3) as $car): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card car-card h-100">
                            <?php if ($car['gambar']): ?>
                                <img src="<?= UPLOAD_URL . $car['gambar'] ?>" class="card-img-top car-img" alt="<?= $car['merk'] ?> <?= $car['model'] ?>">
                            <?php else: ?>
                                <div class="card-img-top car-img bg-light d-flex align-items-center justify-content-center">
                                    <i class="fas fa-car fa-3x text-secondary"></i>
                                </div>
                            <?php endif; ?>
                            
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0"><?= htmlspecialchars($car['merk']) ?> <?= htmlspecialchars($car['model']) ?></h5>
                                    <span class="badge bg-<?= $car['status'] == 'tersedia' ? 'success' : 'danger' ?>">
                                        <?= $car['status'] ?>
                                    </span>
                                </div>
                                
                                <p class="card-text text-muted mb-3">
                                    <small>
                                        <i class="fas fa-calendar me-1"></i> <?= $car['tahun'] ?> |
                                        <i class="fas fa-gas-pump me-1"></i> <?= $car['bahan_bakar'] ?> |
                                        <i class="fas fa-users me-1"></i> <?= $car['kapasitas'] ?> Kursi
                                    </small>
                                </p>
                                
                                <p class="card-text mb-3"><?= nl2br(htmlspecialchars(substr($car['deskripsi'], 0, 100))) ?>...</p>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price-tag">Rp <?= number_format($car['harga_per_hari'], 0, ',', '.') ?>/hari</span>
                                    
                                    <div class="btn-group">
                                        <a href="<?= BASEURL ?>/mobil/detail/<?= $car['id'] ?>" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'user' && $car['status'] == 'tersedia'): ?>
                                            <a href="<?= BASEURL ?>/sewa/create/<?= $car['id'] ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-calendar-check me-1"></i> Sewa
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Features Section -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="text-center mb-5">Mengapa Memilih Kami?</h2>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-shield-alt fa-3x text-primary"></i>
                    </div>
                    <h4 class="card-title">Terpercaya</h4>
                    <p class="card-text">Lebih dari 5 tahun melayani dengan ribuan pelanggan puas.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-bolt fa-3x text-warning"></i>
                    </div>
                    <h4 class="card-title">Proses Cepat</h4>
                    <p class="card-text">Penyewaan selesai dalam hitungan menit dengan sistem online.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card text-center h-100">
                <div class="card-body">
                    <div class="mb-3">
                        <i class="fas fa-headset fa-3x text-success"></i>
                    </div>
                    <h4 class="card-title">Support 24/7</h4>
                    <p class="card-text">Tim support siap membantu kapan saja Anda membutuhkan.</p>
                </div>
            </div>
        </div>
    </div>
</div>