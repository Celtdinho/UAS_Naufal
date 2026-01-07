<?php
class Controller {
    protected $data = [];
    
    public function model($model) {
        $modelFile = 'app/models/' . $model . '.php';
        
        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model();
        } else {
            die('Model ' . $model . ' tidak ditemukan');
        }
    }
    
    public function view($view, $data = []) {
        // Start session jika belum
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check authentication for protected pages
        $protectedPages = ['mobil', 'sewa'];
        $currentPage = explode('/', $view)[0];
        
        if (in_array($currentPage, $protectedPages)) {
            if (!isset($_SESSION['user_id'])) {
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            }
            
            // Check admin access for mobil pages
            if ($currentPage == 'mobil' && $_SESSION['role'] != 'admin') {
                header('Location: ' . BASEURL . '/home');
                exit;
            }
        }
        
        // Extract data to variables
        extract($data);
        $this->data = array_merge($this->data, $data);
        
        // Include header
        require_once 'app/views/layouts/header.php';
        
        // Include sidebar if logged in
        if (isset($_SESSION['user_id'])) {
            require_once 'app/views/layouts/sidebar.php';
        }
        
        // Include main content
        $viewFile = 'app/views/' . $view . '.php';
        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die('View ' . $view . ' tidak ditemukan');
        }
        
        // Include footer
        require_once 'app/views/layouts/footer.php';
    }
    
    public function redirect($url) {
        header('Location: ' . BASEURL . '/' . $url);
        exit;
    }
    
    protected function uploadImage($file, $fieldName = 'gambar') {
        if (!isset($file[$fieldName]) || $file[$fieldName]['error'] !== UPLOAD_ERR_OK) {
            return false;
        }
        
        $targetDir = UPLOAD_PATH;
        
        // Create upload directory if not exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        
        $originalName = basename($file[$fieldName]['name']);
        $imageFileType = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        
        // Check if image file is a actual image
        $check = getimagesize($file[$fieldName]['tmp_name']);
        if ($check === false) {
            return false;
        }
        
        // Generate unique filename
        $filename = uniqid() . '_' . time() . '.' . $imageFileType;
        $targetFile = $targetDir . $filename;
        
        // Check file size (5MB max)
        if ($file[$fieldName]['size'] > 5000000) {
            return false;
        }
        
        // Allow certain file formats
        $allowedFormats = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($imageFileType, $allowedFormats)) {
            return false;
        }
        
        if (move_uploaded_file($file[$fieldName]['tmp_name'], $targetFile)) {
            return $filename;
        }
        
        return false;
    }
}
?>