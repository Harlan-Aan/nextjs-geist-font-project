<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - INI Clone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.8);
            padding: 15px 20px;
            border-radius: 5px;
            margin: 5px 0;
        }
        .sidebar .nav-link:hover {
            color: white;
            background: rgba(255,255,255,.1);
        }
        .sidebar .nav-link.active {
            background: #3498db;
            color: white;
        }
        .main-content {
            min-height: 100vh;
            background: #f8f9fa;
        }
        .header {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            padding: 15px 0;
            margin-bottom: 30px;
        }
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="p-3">
                    <h4 class="text-center mb-4">INI Clone</h4>
                    <div class="nav flex-column">
                        <a href="<?= base_url('dashboard') ?>" class="nav-link active">
                            Dashboard
                        </a>
                        <?php if($role === 'admin'): ?>
                            <a href="<?= base_url('admin/users') ?>" class="nav-link">
                                Manage Users
                            </a>
                        <?php endif; ?>
                        <?php if(in_array($role, ['admin', 'editor'])): ?>
                            <a href="<?= base_url('editor/articles') ?>" class="nav-link">
                                Manage Articles
                            </a>
                        <?php endif; ?>
                        <a href="<?= base_url('profile') ?>" class="nav-link">
                            My Profile
                        </a>
                        <a href="<?= base_url('auth/logout') ?>" class="nav-link text-danger">
                            Logout
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Header -->
                <div class="header">
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0">Welcome, <?= esc($username) ?></h4>
                            <div>
                                <span class="badge bg-primary"><?= ucfirst(esc($role)) ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="stat-card">
                                <h5>Total Articles</h5>
                                <h2>150</h2>
                                <p class="text-muted mb-0">Published articles</p>
                            </div>
                        </div>
                        <?php if($role === 'admin'): ?>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <h5>Total Users</h5>
                                <h2>45</h2>
                                <p class="text-muted mb-0">Registered users</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <h5>New Comments</h5>
                                <h2>28</h2>
                                <p class="text-muted mb-0">Pending moderation</p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Recent Activity -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Recent Activity</h5>
                                </div>
                                <div class="card-body">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">New article published</h6>
                                                <small>3 days ago</small>
                                            </div>
                                            <p class="mb-1">Article "Getting Started with CodeIgniter" was published.</p>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h6 class="mb-1">User comment</h6>
                                                <small>5 days ago</small>
                                            </div>
                                            <p class="mb-1">New comment on "Web Development Tips"</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
