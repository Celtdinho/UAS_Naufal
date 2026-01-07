<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100 py-5">
        <div class="col-md-8 col-lg-6">
            <div class="card">
                <div class="card-body p-5">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <i class="fas fa-user-plus fa-3x text-primary mb-3"></i>
                        <h3 class="fw-bold">Daftar Akun Baru</h3>
                        <p class="text-muted">Buat akun untuk mulai menyewa mobil</p>
                    </div>
                    
                    <!-- Error Messages -->
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <ul class="mb-0 ps-3">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Registration Form -->
                    <form action="<?= BASEURL ?>/auth/register" method="POST" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="username" name="username" 
                                           placeholder="Minimal 3 karakter" required
                                           value="<?= isset($old_username) ? htmlspecialchars($old_username) : '' ?>"
                                           minlength="3">
                                    <div class="invalid-feedback">
                                        Username minimal 3 karakter
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           placeholder="contoh@email.com" required
                                           value="<?= isset($old_email) ? htmlspecialchars($old_email) : '' ?>">
                                    <div class="invalid-feedback">
                                        Masukkan email yang valid
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="Minimal 6 karakter" required minlength="6">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">
                                        Password minimal 6 karakter
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                                           placeholder="Ulangi password" required minlength="6">
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword2">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">
                                        Password harus sama
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                Saya menyetujui <a href="#" class="text-decoration-none">Syarat & Ketentuan</a>
                            </label>
                            <div class="invalid-feedback">
                                Anda harus menyetujui syarat & ketentuan
                            </div>
                        </div>
                        
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                            </button>
                        </div>
                        
                        <div class="text-center">
                            <p class="mb-0">Sudah punya akun? 
                                <a href="<?= BASEURL ?>/auth/login" class="text-decoration-none fw-bold">
                                    Login disini
                                </a>
                            </p>
                            <a href="<?= BASEURL ?>/home" class="btn btn-link text-decoration-none mt-2">
                                <i class="fas fa-home me-1"></i> Kembali ke Home
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        function setupPasswordToggle(toggleId, passwordId) {
            const toggle = document.getElementById(toggleId);
            const passwordInput = document.getElementById(passwordId);
            
            if (toggle && passwordInput) {
                toggle.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
                });
            }
        }
        
        setupPasswordToggle('togglePassword1', 'password');
        setupPasswordToggle('togglePassword2', 'confirm_password');
        
        // Password confirmation validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirm_password');
        
        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity('Password tidak cocok');
            } else {
                confirmPassword.setCustomValidity('');
            }
        }
        
        if (password && confirmPassword) {
            password.onchange = validatePassword;
            confirmPassword.onkeyup = validatePassword;
        }
    });
</script>