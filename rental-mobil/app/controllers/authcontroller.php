<?php
class AuthController extends Controller {
    
    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Jika sudah login, redirect ke home
        if (isset($_SESSION['user_id'])) {
            $this->redirect('home');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            
            $userModel = $this->model('UserModel');
            $user = $userModel->login($username, $password);
            
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['email'] = $user['email'];
                
                // Set session timeout (1 jam)
                $_SESSION['last_activity'] = time();
                
                if ($user['role'] == 'admin') {
                    $this->redirect('mobil');
                } else {
                    $this->redirect('home');
                }
            } else {
                $data = [
                    'title' => 'Login - Rental Mobil',
                    'error' => 'Username atau password salah!'
                ];
                $this->view('auth/login', $data);
            }
        } else {
            $data = [
                'title' => 'Login - Rental Mobil'
            ];
            $this->view('auth/login', $data);
        }
    }
    
    public function register() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Jika sudah login, redirect ke home
        if (isset($_SESSION['user_id'])) {
            $this->redirect('home');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => $_POST['password'],
                'confirm_password' => $_POST['confirm_password']
            ];
            
            $errors = [];
            
            // Validasi
            if (strlen($data['username']) < 3) {
                $errors[] = 'Username minimal 3 karakter';
            }
            
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email tidak valid';
            }
            
            if (strlen($data['password']) < 6) {
                $errors[] = 'Password minimal 6 karakter';
            }
            
            if ($data['password'] !== $data['confirm_password']) {
                $errors[] = 'Password tidak cocok!';
            }
            
            if (empty($errors)) {
                $userModel = $this->model('UserModel');
                
                if ($userModel->register($data)) {
                    $_SESSION['success_message'] = 'Registrasi berhasil! Silakan login.';
                    $this->redirect('auth/login');
                } else {
                    $errors[] = 'Username atau email sudah terdaftar!';
                }
            }
            
            $data = [
                'title' => 'Register - Rental Mobil',
                'errors' => $errors,
                'old_username' => $_POST['username'],
                'old_email' => $_POST['email']
            ];
            $this->view('auth/register', $data);
        } else {
            $data = [
                'title' => 'Register - Rental Mobil'
            ];
            $this->view('auth/register', $data);
        }
    }
    
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Hapus semua session
        $_SESSION = array();
        
        // Hapus session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
        
        $this->redirect('auth/login');
    }
    
    public function profile() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
        
        $userModel = $this->model('UserModel');
        $sewaModel = $this->model('SewaModel');
        
        $data = [
            'title' => 'Profil - Rental Mobil',
            'user' => $userModel->getUserById($_SESSION['user_id']),
            'riwayat_sewa' => $sewaModel->getSewaByUserId($_SESSION['user_id'])
        ];
        
        $this->view('auth/profile', $data);
    }
}
?>