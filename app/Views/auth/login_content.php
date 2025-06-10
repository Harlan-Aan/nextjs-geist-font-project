<div class="container">
    <div class="auth-container">
        <div class="text-center mb-4">
            <h2>Welcome Back</h2>
            <p class="text-muted">Please login to your account</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/login') ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" 
                       class="form-control" 
                       id="email" 
                       name="email" 
                       value="<?= old('email') ?>"
                       required 
                       autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" 
                       class="form-control" 
                       id="password" 
                       name="password" 
                       required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" 
                       class="form-check-input" 
                       id="remember" 
                       name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>

            <div class="text-center mt-3">
                <p class="mb-1">
                    <a href="<?= base_url('auth/forgot-password') ?>" class="text-decoration-none">
                        Forgot your password?
                    </a>
                </p>
                <p class="mb-0">
                    Don't have an account? 
                    <a href="<?= base_url('auth/register') ?>" class="text-decoration-none">
                        Register here
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>

<style>
    .auth-container {
        animation: slideUp 0.5s ease-out;
    }

    @keyframes slideUp {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
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
