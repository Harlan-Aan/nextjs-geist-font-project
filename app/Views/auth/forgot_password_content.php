<div class="container">
    <div class="auth-container">
        <div class="text-center mb-4">
            <h2>Reset Password</h2>
            <p class="text-muted">Enter your email to receive password reset instructions</p>
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

        <form action="<?= base_url('auth/forgot-password') ?>" method="post" class="needs-validation" novalidate>
            <?= csrf_field() ?>

            <div class="mb-4">
                <label for="email" class="form-label">Email address</label>
                <input type="email" 
                       class="form-control" 
                       id="email" 
                       name="email" 
                       value="<?= old('email') ?>"
                       required 
                       autofocus>
                <div class="invalid-feedback">
                    Please provide a valid email address.
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Send Reset Link</button>
            </div>

            <div class="text-center mt-4">
                <p class="mb-0">
                    Remember your password? 
                    <a href="<?= base_url('auth/login') ?>" class="text-decoration-none">
                        Back to Login
                    </a>
                </p>
            </div>
        </form>

        <!-- Password Reset Instructions -->
        <div class="mt-4 p-3 bg-light rounded">
            <h5 class="h6 mb-3">What happens next?</h5>
            <ol class="small text-muted mb-0">
                <li>We'll send a secure password reset link to your email</li>
                <li>Click the link in the email (valid for 1 hour)</li>
                <li>Create your new password</li>
                <li>Log in with your new password</li>
            </ol>
        </div>
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

    /* Instructions section */
    ol {
        padding-left: 1.2rem;
    }

    ol li {
        margin-bottom: 0.5rem;
    }

    ol li:last-child {
        margin-bottom: 0;
    }
</style>

<script>
// Custom form validation
(function () {
    'use strict'

    var forms = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()
</script>
