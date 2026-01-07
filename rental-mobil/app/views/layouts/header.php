<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title . ' - ' . SITENAME : SITENAME; ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-blue: #e3f2fd;
            --secondary-blue: #bbdefb;
            --dark-blue: #1976d2;
            --light-blue: #f5fbff;
            --accent-blue: #64b5f6;
            --text-dark: #333;
            --text-light: #666;
            --success: #4caf50;
            --warning: #ff9800;
            --danger: #f44336;
            --gray: #f8f9fa;
        }
        
        body {
            background-color: var(--light-blue);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text-dark);
            padding-top: 56px; /* Offset for fixed navbar */
        }
        
        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, var(--dark-blue) 0%, #2196f3 100%);
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        .navbar-brand i {
            margin-right: 10px;
        }
        
        /* Sidebar */
        .sidebar {
            background-color: white;
            min-height: calc(100vh - 56px);
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            padding: 20px 0;
            position: fixed;
            width: 250px;
            left: 0;
            top: 56px;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }
        
        .sidebar .nav-link {
            color: var(--text-dark);
            padding: 12px 25px;
            margin: 5px 15px;
            border-radius: 10px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link:hover {
            background-color: var(--primary-blue);
            color: var(--dark-blue);
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background-color: var(--dark-blue);
            color: white;
        }
        
        .sidebar .nav-link i {
            width: 25px;
            margin-right: 10px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }
        
        .card-header {
            background-color: var(--primary-blue);
            border-bottom: 2px solid var(--secondary-blue);
            font-weight: 600;
            padding: 15px 20px;
        }
        
        .card-body {
            padding: 20px;
        }
        
        /* Buttons */
        .btn-primary {
            background-color: var(--dark-blue);
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #1565c0;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25, 118, 210, 0.3);
        }
        
        .btn-success {
            background-color: var(--success);
            border: none;
            border-radius: 10px;
        }
        
        .btn-warning {
            background-color: var(--warning);
            border: none;
            border-radius: 10px;
        }
        
        .btn-danger {
            background-color: var(--danger);
            border: none;
            border-radius: 10px;
        }
        
        /* Search Box */
        .search-box {
            margin: 20px 0;
        }
        
        .search-box .form-control {
            border-radius: 25px;
            padding: 10px 20px;
            border: 2px solid var(--secondary-blue);
        }
        
        /* Car Images */
        .car-img {
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            width: 100%;
        }
        
        .car-img-detail {
            height: 300px;
            object-fit: cover;
            border-radius: 15px;
            width: 100%;
        }
        
        /* Price Tag */
        .price-tag {
            background-color: var(--dark-blue);
            color: white;
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
        }
        
        /* Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
        }
        
        /* Table */
        .table {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }
        
        .table thead th {
            background-color: var(--primary-blue);
            border-bottom: 2px solid var(--secondary-blue);
            color: var(--dark-blue);
            font-weight: 600;
            padding: 15px;
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }
        
        /* Alert Messages */
        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }
        
        /* Status Badges */
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-disetujui {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .status-selesai {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        /* Pagination */
        .pagination .page-link {
            color: var(--dark-blue);
            border: 1px solid var(--secondary-blue);
            margin: 0 3px;
            border-radius: 8px;
        }
        
        .pagination .page-item.active .page-link {
            background-color: var(--dark-blue);
            border-color: var(--dark-blue);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
            border-radius: 20px;
            padding: 50px;
            margin-bottom: 40px;
        }
        
        /* Car Card */
        .car-card {
            transition: all 0.3s;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .car-card:hover {
            border-color: var(--accent-blue);
        }
        
        /* Form Controls */
        .form-control, .form-select {
            border-radius: 10px;
            padding: 10px 15px;
            border: 2px solid #e0e0e0;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--dark-blue);
            box-shadow: 0 0 0 0.25rem rgba(25, 118, 210, 0.25);
        }
        
        /* Mobile Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1001;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .navbar-toggler {
                order: -1;
            }
            
            .mobile-menu-toggle {
                display: block;
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1002;
                background-color: var(--dark-blue);
                color: white;
                width: 50px;
                height: 50px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            }
        }
        
        @media (max-width: 768px) {
            .hero-section {
                padding: 30px 20px;
            }
            
            .table-responsive {
                font-size: 14px;
            }
            
            .card-body {
                padding: 15px;
            }
        }
        
        /* Dashboard Stats */
        .stat-card {
            border-radius: 15px;
            padding: 25px;
            color: white;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .stat-card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }
        
        .stat-card .number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stat-card .label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        /* Loading Spinner */
        .spinner-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 200px;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: var(--text-light);
        }
        
        .empty-state i {
            font-size: 3rem;
            color: var(--secondary-blue);
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASEURL ?>">
                <i class="fas fa-car"></i> <?= SITENAME ?>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i> <?= htmlspecialchars($_SESSION['username']) ?>
                                <span class="badge bg-light text-dark ms-1"><?= $_SESSION['role'] ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?= BASEURL ?>/auth/profile"><i class="fas fa-user-circle me-2"></i> Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= BASEURL ?>/auth/logout"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL ?>/auth/login">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL ?>/auth/register">
                                <i class="fas fa-user-plus me-1"></i> Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Toggle Button -->
    <button class="mobile-menu-toggle d-lg-none" id="mobileMenuToggle">
        <i class="fas fa-bars"></i>
    </button>