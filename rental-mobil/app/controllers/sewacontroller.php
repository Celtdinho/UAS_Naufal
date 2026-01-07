<?php
class SewaController extends Controller {
    
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
        
        $sewaModel = $this->model('SewaModel');
        
        // Pagination
        $limit = 6;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);
        $offset = ($page - 1) * $limit;
        
        // Search
        $search = isset($_GET['search']) ? trim($_GET['search']) : null;
        
        // User ID untuk filtering (admin bisa lihat semua)
        $user_id = ($_SESSION['role'] == 'admin') ? null : $_SESSION['user_id'];
        
        // Get data
        $total = $sewaModel->countAll($search, $user_id);
        $sewa = $sewaModel->getAllSewa($limit, $offset, $search, $user_id);
        
        $data = [
            'title' => 'Daftar Sewa - Rental Mobil',
            'sewa' => $sewa,
            'total' => $total,
            'limit' => $limit,
            'page' => $page,
            'search' => $search,
            'total_pages' => ceil($total / $limit),
            'role' => $_SESSION['role']
        ];
        
        $this->view('sewa/index', $data);
    }
    
    public function create($mobil_id = null) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
        
        $mobilModel = $this->model('MobilModel');
        $sewaModel = $this->model('SewaModel');
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tanggal_sewa = $_POST['tanggal_sewa'];
            $tanggal_kembali = $_POST['tanggal_kembali'];
            
            // Validasi tanggal
            if (strtotime($tanggal_sewa) === false || strtotime($tanggal_kembali) === false) {
                $data = [
                    'title' => 'Sewa Mobil - Rental Mobil',
                    'error' => 'Format tanggal tidak valid!',
                    'all_mobil' => $mobilModel->getAvailableCars(),
                    'mobil' => $mobil_id ? $mobilModel->getMobilById($mobil_id) : null
                ];
                $this->view('sewa/create', $data);
                return;
            }
            
            // Pastikan tanggal sewa tidak lebih kecil dari hari ini
            $today = date('Y-m-d');
            if ($tanggal_sewa < $today) {
                $data = [
                    'title' => 'Sewa Mobil - Rental Mobil',
                    'error' => 'Tanggal sewa tidak boleh kurang dari hari ini!',
                    'all_mobil' => $mobilModel->getAvailableCars(),
                    'mobil' => $mobil_id ? $mobilModel->getMobilById($mobil_id) : null
                ];
                $this->view('sewa/create', $data);
                return;
            }
            
            // Pastikan tanggal kembali lebih besar dari tanggal sewa
            if ($tanggal_kembali <= $tanggal_sewa) {
                $data = [
                    'title' => 'Sewa Mobil - Rental Mobil',
                    'error' => 'Tanggal kembali harus lebih besar dari tanggal sewa!',
                    'all_mobil' => $mobilModel->getAvailableCars(),
                    'mobil' => $mobil_id ? $mobilModel->getMobilById($mobil_id) : null
                ];
                $this->view('sewa/create', $data);
                return;
            }
            
            // Calculate days
            $datetime1 = new DateTime($tanggal_sewa);
            $datetime2 = new DateTime($tanggal_kembali);
            $interval = $datetime1->diff($datetime2);
            $lama_sewa = $interval->days + 1; // Include the start day
            
            // Get car price
            $mobil = $mobilModel->getMobilById($_POST['mobil_id']);
            if (!$mobil) {
                $data = [
                    'title' => 'Sewa Mobil - Rental Mobil',
                    'error' => 'Mobil tidak ditemukan!',
                    'all_mobil' => $mobilModel->getAvailableCars(),
                    'mobil' => $mobil_id ? $mobilModel->getMobilById($mobil_id) : null
                ];
                $this->view('sewa/create', $data);
                return;
            }
            
            $total_harga = $lama_sewa * $mobil['harga_per_hari'];
            
            $data = [
                'user_id' => $_SESSION['user_id'],
                'mobil_id' => $_POST['mobil_id'],
                'tanggal_sewa' => $tanggal_sewa,
                'tanggal_kembali' => $tanggal_kembali,
                'lama_sewa' => $lama_sewa,
                'total_harga' => $total_harga,
                'status' => 'pending',
                'catatan' => trim($_POST['catatan'])
            ];
            
            if ($sewaModel->create($data)) {
                $_SESSION['success_message'] = 'Penyewaan berhasil diajukan! Status: Pending';
                $this->redirect('sewa');
            } else {
                $data = [
                    'title' => 'Sewa Mobil - Rental Mobil',
                    'error' => 'Gagal mengajukan penyewaan!',
                    'all_mobil' => $mobilModel->getAvailableCars(),
                    'mobil' => $mobil_id ? $mobilModel->getMobilById($mobil_id) : null
                ];
                $this->view('sewa/create', $data);
            }
        } else {
            $data = [
                'title' => 'Sewa Mobil - Rental Mobil',
                'mobil' => $mobil_id ? $mobilModel->getMobilById($mobil_id) : null,
                'all_mobil' => $mobilModel->getAvailableCars()
            ];
            
            $this->view('sewa/create', $data);
        }
    }
    
    public function updateStatus($id, $status) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Hanya admin yang bisa update status
        if ($_SESSION['role'] != 'admin') {
            $this->redirect('sewa');
        }
        
        $sewaModel = $this->model('SewaModel');
        $mobilModel = $this->model('MobilModel');
        
        // Get sewa data
        $sewa = $sewaModel->getSewaById($id);
        if (!$sewa) {
            $this->redirect('sewa');
        }
        
        // Update status
        if ($sewaModel->updateStatus($id, $status)) {
            // Jika disetujui, ubah status mobil menjadi tidak tersedia
            if ($status == 'disetujui') {
                $mobilModel->updateStatus($sewa['mobil_id'], 'tidak tersedia');
            }
            
            // Jika selesai, ubah status mobil menjadi tersedia
            if ($status == 'selesai') {
                $mobilModel->updateStatus($sewa['mobil_id'], 'tersedia');
            }
            
            $_SESSION['success_message'] = 'Status penyewaan berhasil diubah!';
        }
        
        $this->redirect('sewa');
    }
    
    public function detail($id) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
        }
        
        $sewaModel = $this->model('SewaModel');
        $sewa = $sewaModel->getSewaById($id);
        
        if (!$sewa) {
            $this->redirect('sewa');
        }
        
        // Cek akses: admin bisa lihat semua, user hanya bisa lihat miliknya sendiri
        if ($_SESSION['role'] != 'admin' && $sewa['user_id'] != $_SESSION['user_id']) {
            $this->redirect('sewa');
        }
        
        $data = [
            'title' => 'Detail Sewa - Rental Mobil',
            'sewa' => $sewa,
            'role' => $_SESSION['role']
        ];
        
        $this->view('sewa/detail', $data);
    }
}
?>