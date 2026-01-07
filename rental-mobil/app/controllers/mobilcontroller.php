<?php
class MobilController extends Controller {
    
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Cek admin access
        if ($_SESSION['role'] != 'admin') {
            $this->redirect('home');
        }
        
        $mobilModel = $this->model('MobilModel');
        
        // Pagination
        $limit = 6;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page); // Pastikan minimal page 1
        $offset = ($page - 1) * $limit;
        
        // Search
        $search = isset($_GET['search']) ? trim($_GET['search']) : null;
        
        // Get data
        $total = $mobilModel->countAll($search);
        $mobil = $mobilModel->getAllMobil($limit, $offset, $search);
        
        $data = [
            'title' => 'Kelola Mobil - Rental Mobil',
            'mobil' => $mobil,
            'total' => $total,
            'limit' => $limit,
            'page' => $page,
            'search' => $search,
            'total_pages' => ceil($total / $limit)
        ];
        
        $this->view('mobil/index', $data);
    }
    
    public function create() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Cek admin access
        if ($_SESSION['role'] != 'admin') {
            $this->redirect('home');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Upload gambar
            $gambar = '';
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $gambar = $this->uploadImage($_FILES, 'gambar');
                if (!$gambar) {
                    $data = [
                        'title' => 'Tambah Mobil - Rental Mobil',
                        'error' => 'Gagal mengupload gambar. Pastikan file adalah gambar (jpg, png, gif) dan ukuran maksimal 5MB.'
                    ];
                    $this->view('mobil/create', $data);
                    return;
                }
            }
            
            $data = [
                'merk' => trim($_POST['merk']),
                'model' => trim($_POST['model']),
                'tahun' => (int)$_POST['tahun'],
                'warna' => trim($_POST['warna']),
                'plat_nomor' => trim($_POST['plat_nomor']),
                'harga_per_hari' => (float)$_POST['harga_per_hari'],
                'transmisi' => $_POST['transmisi'],
                'bahan_bakar' => $_POST['bahan_bakar'],
                'kapasitas' => (int)$_POST['kapasitas'],
                'deskripsi' => trim($_POST['deskripsi']),
                'gambar' => $gambar,
                'status' => $_POST['status']
            ];
            
            // Validasi
            if (empty($data['merk']) || empty($data['model']) || empty($data['plat_nomor'])) {
                $data = [
                    'title' => 'Tambah Mobil - Rental Mobil',
                    'error' => 'Merk, model, dan plat nomor wajib diisi!'
                ];
                $this->view('mobil/create', $data);
                return;
            }
            
            $mobilModel = $this->model('MobilModel');
            if ($mobilModel->create($data)) {
                $_SESSION['success_message'] = 'Mobil berhasil ditambahkan!';
                $this->redirect('mobil');
            } else {
                $data = [
                    'title' => 'Tambah Mobil - Rental Mobil',
                    'error' => 'Gagal menambahkan mobil!'
                ];
                $this->view('mobil/create', $data);
            }
        } else {
            $data = [
                'title' => 'Tambah Mobil - Rental Mobil'
            ];
            $this->view('mobil/create', $data);
        }
    }
    
    public function edit($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Cek admin access
        if ($_SESSION['role'] != 'admin') {
            $this->redirect('home');
        }
        
        $mobilModel = $this->model('MobilModel');
        $mobil = $mobilModel->getMobilById($id);
        
        if (!$mobil) {
            $this->redirect('mobil');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'merk' => trim($_POST['merk']),
                'model' => trim($_POST['model']),
                'tahun' => (int)$_POST['tahun'],
                'warna' => trim($_POST['warna']),
                'plat_nomor' => trim($_POST['plat_nomor']),
                'harga_per_hari' => (float)$_POST['harga_per_hari'],
                'transmisi' => $_POST['transmisi'],
                'bahan_bakar' => $_POST['bahan_bakar'],
                'kapasitas' => (int)$_POST['kapasitas'],
                'deskripsi' => trim($_POST['deskripsi']),
                'status' => $_POST['status']
            ];
            
            // Jika ada gambar baru
            if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
                $gambar = $this->uploadImage($_FILES, 'gambar');
                if ($gambar) {
                    $data['gambar'] = $gambar;
                }
            }
            
            // Validasi
            if (empty($data['merk']) || empty($data['model']) || empty($data['plat_nomor'])) {
                $data = [
                    'title' => 'Edit Mobil - Rental Mobil',
                    'mobil' => $mobil,
                    'error' => 'Merk, model, dan plat nomor wajib diisi!'
                ];
                $this->view('mobil/edit', $data);
                return;
            }
            
            if ($mobilModel->update($id, $data)) {
                $_SESSION['success_message'] = 'Mobil berhasil diperbarui!';
                $this->redirect('mobil');
            } else {
                $data = [
                    'title' => 'Edit Mobil - Rental Mobil',
                    'mobil' => $mobil,
                    'error' => 'Gagal memperbarui mobil!'
                ];
                $this->view('mobil/edit', $data);
            }
        } else {
            $data = [
                'title' => 'Edit Mobil - Rental Mobil',
                'mobil' => $mobil
            ];
            $this->view('mobil/edit', $data);
        }
    }
    
    public function delete($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Cek admin access
        if ($_SESSION['role'] != 'admin') {
            $this->redirect('home');
        }
        
        $mobilModel = $this->model('MobilModel');
        $mobilModel->delete($id);
        
        $_SESSION['success_message'] = 'Mobil berhasil dihapus!';
        $this->redirect('mobil');
    }
    
    public function detail($id) {
        $mobilModel = $this->model('MobilModel');
        $mobil = $mobilModel->getMobilById($id);
        
        if (!$mobil) {
            $this->redirect('home');
        }
        
        $data = [
            'title' => $mobil['merk'] . ' ' . $mobil['model'] . ' - Rental Mobil',
            'mobil' => $mobil
        ];
        
        $this->view('mobil/detail', $data);
    }
}
?>