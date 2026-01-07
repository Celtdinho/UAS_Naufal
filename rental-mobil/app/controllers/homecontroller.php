<?php
class HomeController extends Controller {
    
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $mobilModel = $this->model('MobilModel');
        $sewaModel = $this->model('SewaModel');
        
        $data = [
            'title' => 'Beranda - Rental Mobil',
            'mobil' => $mobilModel->getAvailableCars(),
            'featured_cars' => array_slice($mobilModel->getAvailableCars(), 0, 3),
            'is_logged_in' => isset($_SESSION['user_id']),
            'user_role' => $_SESSION['role'] ?? 'guest'
        ];
        
        $this->view('home/index', $data);
    }
}
?>