<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-car me-2"></i>Kelola Mobil</h2>
        <a href="<?= BASEURL ?>/mobil/create" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Mobil
        </a>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="" class="search-box">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari mobil (merk/model/plat)" value="<?= htmlspecialchars($search ?? '') ?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <?php if (!empty($search)): ?>
                        <a href="<?= BASEURL ?>/mobil" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-md-end mt-2 mt-md-0">
            <div class="text-muted">
                Total: <?= $total ?> mobil
            </div>
        </div>
    </div>

    <!-- Mobil Table -->
    <?php if (empty($mobil)): ?>
        <div class="empty-state">
            <i class="fas fa-car fa-3x mb-3"></i>
            <h4>Tidak ada data mobil</h4>
            <p class="text-muted">Mulai dengan menambahkan mobil baru</p>
            <a href="<?= BASEURL ?>/mobil/create" class="btn btn-primary mt-3">
                <i class="fas fa-plus me-2"></i>Tambah Mobil
            </a>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Merk & Model</th>
                        <th>Plat</th>
                        <th>Harga/Hari</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mobil as $index => $car): ?>
                    <tr>
                        <td><?= (($page - 1) * $limit) + $index + 1 ?></td>
                        <td>
                            <?php if ($car['gambar']): ?>
                                <img src="<?= UPLOAD_URL . $car['gambar'] ?>" alt="<?= htmlspecialchars($car['merk']) ?>" class="rounded" width="60" height="40" style="object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:60px; height:40px;">
                                    <i class="fas fa-car text-secondary"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="fw-bold"><?= htmlspecialchars($car['merk']) ?> <?= htmlspecialchars($car['model']) ?></div>
                            <small class="text-muted">
                                <?= $car['tahun'] ?> • <?= $car['bahan_bakar'] ?> • <?= $car['transmisi'] ?>
                            </small>
                        </td>
                        <td>
                            <span class="badge bg-dark"><?= htmlspecialchars($car['plat_nomor']) ?></span>
                        </td>
                        <td class="fw-bold">
                            Rp <?= number_format($car['harga_per_hari'], 0, ',', '.') ?>
                        </td>
                        <td>
                            <span class="status-badge status-<?= $car['status'] == 'tersedia' ? 'disetujui' : 'ditolak' ?>">
                                <?= $car['status'] ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="<?= BASEURL ?>/mobil/detail/<?= $car['id'] ?>" class="btn btn-outline-primary" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= BASEURL ?>/mobil/edit/<?= $car['id'] ?>" class="btn btn-outline-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= BASEURL ?>/mobil/delete/<?= $car['id'] ?>" 
                                   class="btn btn-outline-danger btn-delete" title="Hapus"
                                   onclick="return confirm('Yakin ingin menghapus mobil ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search ?? '') ?>">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search ?? '') ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search ?? '') ?>">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>
    <?php endif; ?>
</div>