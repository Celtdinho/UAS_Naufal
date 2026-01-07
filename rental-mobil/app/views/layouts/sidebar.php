    <!-- Sidebar -->
    <?php if (isset($_SESSION['user_id'])): ?>
    <div class="sidebar d-lg-block" id="sidebar">
        <div class="d-flex flex-column h-100">
            <!-- User Info -->
            <div class="text-center p-4 border-bottom">
                <div class="mb-3">
                    <i class="fas fa-user-circle fa-3x text-dark-blue"></i>
                </div>
                <h6 class="mb-1"><?= htmlspecialchars($_SESSION['username']) ?></h6>
                <small class="text-muted"><?= htmlspecialchars($_SESSION['email']) ?></small>
                <div class="mt-2">
                    <span class="badge bg-primary"><?= $_SESSION['role'] ?></span>
                </div>
            </div>
            
            <!-- Navigation -->
            <div class="flex-grow-1 p-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/home" class="nav-link <?= ($_SERVER['REQUEST_URI'] == BASEURL . '/home' || $_SERVER['REQUEST_URI'] == BASEURL . '/') ? 'active' : '' ?>">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/mobil" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/mobil') !== false ? 'active' : '' ?>">
                            <i class="fas fa-car"></i> Kelola Mobil
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/sewa" class="nav-link <?= strpos($_SERVER['REQUEST_URI'], '/sewa') !== false ? 'active' : '' ?>">
                            <i class="fas fa-list-alt"></i> Daftar Sewa
                        </a>
                    </li>
                    
                    <?php if ($_SESSION['role'] == 'user'): ?>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/sewa/create" class="nav-link <?= $_SERVER['REQUEST_URI'] == BASEURL . '/sewa/create' ? 'active' : '' ?>">
                            <i class="fas fa-plus-circle"></i> Sewa Mobil Baru
                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if ($_SESSION['role'] == 'admin'): ?>
                    <li class="nav-item mt-3">
                        <div class="nav-link disabled text-muted">
                            <small>ADMIN MENU</small>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>/dashboard" class="nav-link">
                            <i class="fas fa-chart-bar"></i> Dashboard
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                
                <!-- Search Box -->
                <div class="mt-4 p-3">
                    <form action="<?= BASEURL ?>/mobil" method="GET" class="search-box">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari mobil...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Logout -->
            <div class="p-3 border-top">
                <a href="<?= BASEURL ?>/auth/logout" class="btn btn-outline-danger w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Success/Error Messages -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> <?= $_SESSION['success_message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> <?= $_SESSION['error_message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>