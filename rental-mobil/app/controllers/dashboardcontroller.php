<?php
class DashboardController extends Controller {
    
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if ($_SESSION['role'] != 'admin') {
            $this->redirect('home');
        }
        
        $mobilModel = $this->model('MobilModel');
        $sewaModel = $this->model('SewaModel');
        $userModel = $this->model('UserModel');
        
        $data = [
            'title' => 'Dashboard Admin - Rental Mobil',
            'stats' => [
                'total_mobil' => $mobilModel->countAll(),
                'total_sewa' => $sewaModel->countAll(),
                'total_users' => $userModel->countAll(),
                'total_pendapatan' => 0
            ]
        ];
        
        $this->view('dashboard/index', $data);
    }
}
?>