<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="fas fa-plus me-2"></i>Tambah Mobil Baru</h4>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i> <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= BASEURL ?>/mobil/create" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="merk" class="form-label">Merk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="merk" name="merk" required>
                                <div class="invalid-feedback">
                                    Harap isi merk mobil
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="model" class="form-label">Model <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="model" name="model" required>
                                <div class="invalid-feedback">
                                    Harap isi model mobil
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="tahun" class="form-label">Tahun <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="tahun" name="tahun" min="2000" max="<?= date('Y') + 1 ?>" required>
                                <div class="invalid-feedback">
                                    Harap isi tahun mobil (2000-<?= date('Y') + 1 ?>)
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="warna" class="form-label">Warna</label>
                                <input type="text" class="form-control" id="warna" name="warna">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="plat_nomor" class="form-label">Plat Nomor <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" required>
                                <div class="invalid-feedback">
                                    Harap isi plat nomor
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="harga_per_hari" class="form-label">Harga per Hari <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="harga_per_hari" name="harga_per_hari" min="100000" required>
                                </div>
                                <div class="invalid-feedback">
                                    Harap isi harga sewa (minimal 100.000)
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="transmisi" class="form-label">Transmisi</label>
                                <select class="form-select" id="transmisi" name="transmisi">
                                    <option value="manual">Manual</option>
                                    <option value="automatic">Automatic</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="bahan_bakar" class="form-label">Bahan Bakar</label>
                                <select class="form-select" id="bahan_bakar" name="bahan_bakar">
                                    <option value="bensin">Bensin</option>
                                    <option value="solar">Solar</option>
                                    <option value="listrik">Listrik</option>
                                    <option value="hybrid">Hybrid</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="kapasitas" class="form-label">Kapasitas (orang)</label>
                                <input type="number" class="form-control" id="kapasitas" name="kapasitas" min="2" max="10" value="4">
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="tersedia">Tersedia</option>
                                    <option value="tidak tersedia">Tidak Tersedia</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="gambar" class="form-label">Gambar Mobil</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG, GIF. Maksimal 5MB</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi mobil..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= BASEURL ?>/mobil" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Mobil
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>