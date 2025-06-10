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
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .role-badge {
            font-size: 0.8em;
            padding: 5px 10px;
        }
        .user-table th, .user-table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 px-0 sidebar">
                <div class="p-3">
                    <h4 class="text-center mb-4">Admin Panel</h4>
                    <div class="nav flex-column">
                        <a href="<?= base_url('admin/dashboard') ?>" class="nav-link active">
                            Dashboard
                        </a>
                        <a href="<?= base_url('admin/users') ?>" class="nav-link">
                            User Management
                        </a>
                        <a href="<?= base_url('editor/articles') ?>" class="nav-link">
                            Content Management
                        </a>
                        <a href="<?= base_url('dashboard') ?>" class="nav-link">
                            Main Dashboard
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
                            <h4 class="mb-0">Admin Dashboard</h4>
                            <div>
                                <span class="badge bg-danger">Administrator</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dashboard Content -->
                <div class="container-fluid">
                    <!-- Statistics Cards -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="stat-card bg-primary text-white">
                                <h5>Total Users</h5>
                                <h2><?= $total_users ?></h2>
                                <p class="mb-0">Registered accounts</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card bg-success text-white">
                                <h5>Administrators</h5>
                                <h2><?= $user_roles['admin'] ?></h2>
                                <p class="mb-0">Admin users</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card bg-info text-white">
                                <h5>Editors</h5>
                                <h2><?= $user_roles['editor'] ?></h2>
                                <p class="mb-0">Content editors</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stat-card bg-warning text-dark">
                                <h5>Regular Users</h5>
                                <h2><?= $user_roles['user'] ?></h2>
                                <p class="mb-0">Standard accounts</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Users Table -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Recent Users</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover user-table">
                                            <thead>
                                                <tr>
                                                    <th>Username</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Joined</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($recent_users as $user): ?>
                                                <tr>
                                                    <td><?= esc($user['username']) ?></td>
                                                    <td><?= esc($user['email']) ?></td>
                                                    <td>
                                                        <select class="form-select form-select-sm role-select" 
                                                                data-user-id="<?= $user['id'] ?>"
                                                                style="width: auto;">
                                                            <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                                            <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
                                                            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                                        </select>
                                                    </td>
                                                    <td><?= date('M d, Y', strtotime($user['created_at'])) ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
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
    <script>
        // Handle role changes
        document.querySelectorAll('.role-select').forEach(select => {
            select.addEventListener('change', function() {
                const userId = this.dataset.userId;
                const newRole = this.value;

                fetch(`/admin/dashboard/updateUserRole/${userId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ role: newRole })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Role updated successfully');
                    } else {
                        alert('Failed to update role: ' + data.message);
                        // Reset the select to its previous value
                        this.value = this.dataset.originalRole;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating the role');
                    this.value = this.dataset.originalRole;
                });
            });

            // Store the original role value
            select.dataset.originalRole = select.value;
        });
    </script>
</body>
</html>
