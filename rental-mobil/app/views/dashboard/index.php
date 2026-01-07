<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dark"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin</h2>
    </div>
    
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>
        Dashboard admin berhasil diakses! Fitur statistik lengkap akan tersedia setelah data terisi.
    </div>
    
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3><i class="fas fa-car text-primary"></i></h3>
                    <h5>Kelola Mobil</h5>
                    <a href="<?= BASEURL ?>/mobil" class="btn btn-primary btn-sm">Lihat</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3><i class="fas fa-list-alt text-success"></i></h3>
                    <h5>Kelola Sewa</h5>
                    <a href="<?= BASEURL ?>/sewa" class="btn btn-success btn-sm">Lihat</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3><i class="fas fa-users text-warning"></i></h3>
                    <h5>Data User</h5>
                    <a href="<?= BASEURL ?>/home" class="btn btn-warning btn-sm">Lihat</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card text-center">
                <div class="card-body">
                    <h3><i class="fas fa-chart-bar text-info"></i></h3>
                    <h5>Statistik</h5>
                    <a href="<?= BASEURL ?>/dashboard" class="btn btn-info btn-sm">Refresh</a>
                </div>
            </div>
        </div>
    </div>
</div>