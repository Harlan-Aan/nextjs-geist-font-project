<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'INI Clone' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Common styles */
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .nav-link {
            font-weight: 500;
            color: #333 !important;
            padding: 0.5rem 1rem !important;
            margin: 0 0.2rem;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #007bff !important;
        }

        .btn-primary {
            padding: 0.8rem 2rem;
            border-radius: 30px;
            font-weight: 600;
        }

        .main-content {
            flex: 1;
            padding-top: 76px; /* Navbar height + some padding */
        }

        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 50px 0;
            margin-top: auto;
        }

        /* Flash messages */
        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
        }

        /* Custom card styles */
        .custom-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        /* Additional utility classes */
        .text-primary-dark {
            color: #0056b3;
        }

        .bg-light-gray {
            background-color: #f8f9fa;
        }

        .rounded-custom {
            border-radius: 15px;
        }

        /* Custom styles for specific pages can be added here */
        <?= $additionalStyles ?? '' ?>
    </style>
    <?= $additionalHead ?? '' ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url() ?>">INI Clone</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('about') ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('contact') ?>">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (session()->get('isLoggedIn')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                Welcome, <?= esc(session()->get('username')) ?>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if (session()->get('role') === 'admin'): ?>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/dashboard') ?>">Admin Dashboard</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('profile') ?>">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?= base_url('auth/logout') ?>">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('auth/login') ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-primary text-white" href="<?= base_url('auth/register') ?>">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="container mt-4">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <?= $content ?? '' ?>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About Us</h5>
                    <p>INI Clone is a modern web application built with CodeIgniter 4, featuring comprehensive user management and content organization.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url('about') ?>" class="text-white">About</a></li>
                        <li><a href="<?= base_url('contact') ?>" class="text-white">Contact</a></li>
                        <li><a href="<?= base_url('privacy') ?>" class="text-white">Privacy Policy</a></li>
                        <li><a href="<?= base_url('terms') ?>" class="text-white">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <ul class="list-unstyled">
                        <li>Email: info@iniclone.com</li>
                        <li>Phone: (123) 456-7890</li>
                        <li>Address: 123 Web Street, Internet City</li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-4 border-top border-light">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">&copy; <?= date('Y') ?> INI Clone. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?= $additionalScripts ?? '' ?>
</body>
</html>
