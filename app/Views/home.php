<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                        url('https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            margin-bottom: 50px;
        }
        
        .feature-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.3s ease;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
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
        }

        .nav-link:hover {
            color: #007bff !important;
        }

        .btn-primary {
            padding: 0.8rem 2rem;
            border-radius: 30px;
            font-weight: 600;
        }

        .footer {
            background-color: #2c3e50;
            color: white;
            padding: 50px 0;
            margin-top: 100px;
        }
    </style>
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
                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                Welcome, <?= esc($username) ?>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if ($role === 'admin'): ?>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Welcome to INI Clone</h1>
            <p class="lead mb-5">Discover amazing content and connect with our community</p>
            <?php if (!$isLoggedIn): ?>
                <a href="<?= base_url('auth/register') ?>" class="btn btn-primary btn-lg">Get Started</a>
            <?php endif; ?>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container mb-5">
        <h2 class="text-center mb-5">Our Features</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card feature-card">
                    <div class="card-body text-center">
                        <h3 class="h4 mb-3">User Management</h3>
                        <p class="text-muted">Comprehensive user roles and permissions system for secure access control.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card">
                    <div class="card-body text-center">
                        <h3 class="h4 mb-3">Content Management</h3>
                        <p class="text-muted">Easy-to-use interface for managing and organizing your content.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card">
                    <div class="card-body text-center">
                        <h3 class="h4 mb-3">Analytics</h3>
                        <p class="text-muted">Detailed insights and statistics about your website's performance.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-primary text-white py-5 text-center">
        <div class="container">
            <h2 class="mb-4">Ready to get started?</h2>
            <p class="lead mb-4">Join our community today and experience all the features we offer.</p>
            <?php if (!$isLoggedIn): ?>
                <a href="<?= base_url('auth/register') ?>" class="btn btn-light btn-lg">Sign Up Now</a>
            <?php endif; ?>
        </div>
    </section>

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
</body>
</html>
