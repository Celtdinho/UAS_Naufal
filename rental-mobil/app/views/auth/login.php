<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100 py-5">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-body p-5">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <i class="fas fa-car fa-3x text-primary mb-3"></i>
                        <h3 class="fw-bold">Login ke <?= SITENAME ?></h3>
                        <p class="text-muted">Masukkan akun Anda untuk melanjutkan</p>
                    </div>
                    
                    <!-- Error Messages -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i> <?= $error ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Success Message -->
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i> <?= $_SESSION['success_message'] ?>
                        </div>
                        <?php unset($_SESSION['success_message']); ?>
                    <?php endif; ?>
                    
                    <!-- Login Form -->
                    <form action="<?= BASEURL ?>/auth/login" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username atau Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="username" name="username" 
                                       placeholder="Masukkan username atau email" required
                                       value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" 
                                       placeholder="Masukkan password" required>
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </div>
                        
                        <div class="text-center">
                            <p class="mb-0">Belum punya akun? 
                                <a href="<?= BASEURL ?>/auth/register" class="text-decoration-none fw-bold">
                                    Daftar disini
                                </a>
                            </p>
                            <a href="<?= BASEURL ?>/home" class="btn btn-link text-decoration-none mt-2">
                                <i class="fas fa-home me-1"></i> Kembali ke Home
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Demo Accounts Info -->
            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="card-title"><i class="fas fa-info-circle me-2"></i>Akun Demo</h6>
                    <div class="row">
                        <div class="col-6">
                            <p class="small mb-1"><strong>Admin</strong></p>
                            <p class="small mb-1">Username: <code>admin</code></p>
                            <p class="small">Password: <code>admin123</code></p>
                        </div>
                        <div class="col-6">
                            <p class="small mb-1"><strong>User</strong></p>
                            <p class="small mb-1">Register dulu</p>
                            <p class="small">di halaman Register</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
        }
    });
</script>