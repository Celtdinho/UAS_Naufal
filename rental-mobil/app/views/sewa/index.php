<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-list-alt me-2"></i>Daftar Sewa</h2>
        <?php if ($role == 'user'): ?>
            <a href="<?= BASEURL ?>/sewa/create" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Sewa Baru
            </a>
        <?php endif; ?>
    </div>

    <!-- Search and Filter -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="GET" action="" class="search-box">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari sewa (merk/model/status)" value="<?= htmlspecialchars($search ?? '') ?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <?php if (!empty($search)): ?>
                        <a href="<?= BASEURL ?>/sewa" class="btn btn-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="col-md-6 text-md-end mt-2 mt-md-0">
            <div class="text-muted">
                Total: <?= $total ?> penyewaan
            </div>
        </div>
    </div>

    <!-- Sewa Table -->
    <?php if (empty($sewa)): ?>
        <div class="empty-state">
            <i class="fas fa-calendar-alt fa-3x mb-3"></i>
            <h4>Tidak ada data penyewaan</h4>
            <p class="text-muted">Mulai dengan menyewa mobil baru</p>
            <?php if ($role == 'user'): ?>
                <a href="<?= BASEURL ?>/sewa/create" class="btn btn-primary mt-3">
                    <i class="fas fa-plus me-2"></i>Sewa Mobil Baru
                </a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mobil</th>
                        <th>Tanggal Sewa</th>
                        <th>Lama Sewa</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sewa as $index => $s): ?>
                    <tr>
                        <td><?= (($page - 1) * $limit) + $index + 1 ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <?php if ($s['gambar']): ?>
                                    <img src="<?= UPLOAD_URL . $s['gambar'] ?>" alt="<?= htmlspecialchars($s['merk']) ?>" class="rounded me-3" width="50" height="35" style="object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center me-3" style="width:50px; height:35px;">
                                        <i class="fas fa-car text-secondary"></i>
                                    </div>
                                <?php endif; ?>
                                <div>
                                    <div class="fw-bold"><?= htmlspecialchars($s['merk']) ?> <?= htmlspecialchars($s['model']) ?></div>
                                    <small class="text-muted">Oleh: <?= htmlspecialchars($s['username']) ?></small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div><?= date('d M Y', strtotime($s['tanggal_sewa'])) ?></div>
                            <small class="text-muted">s/d <?= date('d M Y', strtotime($s['tanggal_kembali'])) ?></small>
                        </td>
                        <td>
                            <span class="badge bg-info"><?= $s['lama_sewa'] ?> hari</span>
                        </td>
                        <td class="fw-bold">
                            Rp <?= number_format($s['total_harga'], 0, ',', '.') ?>
                        </td>
                        <td>
                            <?php
                            $status_class = [
                                'pending' => 'status-pending',
                                'diproses' => 'status-diproses',
                                'disetujui' => 'status-disetujui',
                                'ditolak' => 'status-ditolak',
                                'selesai' => 'status-selesai'
                            ];
                            ?>
                            <span class="status-badge <?= $status_class[$s['status']] ?? 'status-pending' ?>">
                                <?= ucfirst($s['status']) ?>
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="<?= BASEURL ?>/sewa/detail/<?= $s['id'] ?>" class="btn btn-outline-primary" title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <?php if ($role == 'admin'): ?>
                                    <?php if ($s['status'] == 'pending'): ?>
                                        <a href="<?= BASEURL ?>/sewa/updateStatus/<?= $s['id'] ?>/diproses" class="btn btn-outline-warning" title="Proses">
                                            <i class="fas fa-cog"></i>
                                        </a>
                                        <a href="<?= BASEURL ?>/sewa/updateStatus/<?= $s['id'] ?>/disetujui" class="btn btn-outline-success" title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="<?= BASEURL ?>/sewa/updateStatus/<?= $s['id'] ?>/ditolak" class="btn btn-outline-danger" title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    <?php elseif ($s['status'] == 'diproses'): ?>
                                        <a href="<?= BASEURL ?>/sewa/updateStatus/<?= $s['id'] ?>/disetujui" class="btn btn-outline-success" title="Setujui">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="<?= BASEURL ?>/sewa/updateStatus/<?= $s['id'] ?>/ditolak" class="btn btn-outline-danger" title="Tolak">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    <?php elseif ($s['status'] == 'disetujui'): ?>
                                        <a href="<?= BASEURL ?>/sewa/updateStatus/<?= $s['id'] ?>/selesai" class="btn btn-outline-info" title="Selesai">
                                            <i class="fas fa-flag-checkered"></i>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
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