<div class="container py-4">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="avatar-placeholder">
                            <?= strtoupper(substr($user['username'], 0, 1)) ?>
                        </div>
                    </div>
                    <h5 class="card-title mb-1"><?= esc($user['username']) ?></h5>
                    <p class="text-muted small mb-3"><?= esc($user['email']) ?></p>
                    <div class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'editor' ? 'success' : 'primary') ?> mb-3">
                        <?= ucfirst(esc($user['role'])) ?>
                    </div>
                    <p class="text-muted small mb-0">
                        Member since: <?= date('M Y', strtotime($user['created_at'])) ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Tabs -->
            <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab">
                        Profile Info
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="security-tab" data-bs-toggle="tab" href="#security" role="tab">
                        Security
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="settings-tab" data-bs-toggle="tab" href="#settings" role="tab">
                        Account Settings
                    </a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="profileTabsContent">
                <!-- Profile Info Tab -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Profile Information</h5>
                            
                            <form action="<?= base_url('profile/update') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" 
                                           class="form-control" 
                                           id="username" 
                                           name="username" 
                                           value="<?= esc($user['username']) ?>" 
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" 
                                           class="form-control" 
                                           id="email" 
                                           name="email" 
                                           value="<?= esc($user['email']) ?>" 
                                           required>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Update Profile
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Security Tab -->
                <div class="tab-pane fade" id="security" role="tabpanel">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Change Password</h5>
                            
                            <form action="<?= base_url('profile/change-password') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" 
                                           class="form-control" 
                                           id="current_password" 
                                           name="current_password" 
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="new_password" class="form-label">New Password</label>
                                    <input type="password" 
                                           class="form-control" 
                                           id="new_password" 
                                           name="new_password" 
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label for="confirm_new_password" class="form-label">Confirm New Password</label>
                                    <input type="password" 
                                           class="form-control" 
                                           id="confirm_new_password" 
                                           name="confirm_new_password" 
                                           required>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Account Settings Tab -->
                <div class="tab-pane fade" id="settings" role="tabpanel">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Account Settings</h5>
                            
                            <!-- Delete Account Section -->
                            <div class="border-top pt-4 mt-4">
                                <h6 class="text-danger mb-3">Delete Account</h6>
                                <p class="text-muted mb-3">
                                    Once you delete your account, there is no going back. Please be certain.
                                </p>
                                <button type="button" 
                                        class="btn btn-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteAccountModal">
                                    Delete Account
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete your account? This action cannot be undone.</p>
                <form action="<?= base_url('profile/delete-account') ?>" method="post" id="deleteAccountForm">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm your password</label>
                        <input type="password" 
                               class="form-control" 
                               id="confirm_password" 
                               name="confirm_password" 
                               required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="deleteAccountForm" class="btn btn-danger">Delete Account</button>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar-placeholder {
        width: 80px;
        height: 80px;
        background-color: #007bff;
        color: white;
        font-size: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto;
    }

    .custom-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }

    .nav-tabs .nav-link {
        border: none;
        color: #6c757d;
        padding: 1rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .nav-tabs .nav-link:hover {
        border: none;
        color: #007bff;
    }

    .nav-tabs .nav-link.active {
        border: none;
        color: #007bff;
        border-bottom: 2px solid #007bff;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 123, 255, 0.2);
    }
</style>

<script>
// Show active tab from URL hash
document.addEventListener('DOMContentLoaded', function() {
    const hash = window.location.hash;
    if (hash) {
        const tab = document.querySelector(`[href="${hash}"]`);
        if (tab) {
            tab.click();
        }
    }
});

// Update URL hash when tab changes
const tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
tabLinks.forEach(tabLink => {
    tabLink.addEventListener('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
    });
});
</script>
