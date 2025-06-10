<div class="container">
    <div class="auth-container">
        <div class="text-center mb-4">
            <h2>Create Account</h2>
            <p class="text-muted">Join our community today</p>
        </div>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul class="mb-0 list-unstyled">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/register') ?>" method="post" class="needs-validation" novalidate>
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" 
                       class="form-control <?= session()->getFlashdata('errors.username') ? 'is-invalid' : '' ?>" 
                       id="username" 
                       name="username" 
                       value="<?= old('username') ?>"
                       required 
                       minlength="3"
                       autofocus>
                <div class="invalid-feedback">
                    Please choose a username (minimum 3 characters).
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" 
                       class="form-control <?= session()->getFlashdata('errors.email') ? 'is-invalid' : '' ?>" 
                       id="email" 
                       name="email" 
                       value="<?= old('email') ?>"
                       required>
                <div class="invalid-feedback">
                    Please provide a valid email address.
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" 
                       class="form-control <?= session()->getFlashdata('errors.password') ? 'is-invalid' : '' ?>" 
                       id="password" 
                       name="password" 
                       required 
                       minlength="6">
                <div class="form-text">Password must be at least 6 characters long.</div>
                <div class="invalid-feedback">
                    Please provide a valid password.
                </div>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" 
                       class="form-control <?= session()->getFlashdata('errors.confirm_password') ? 'is-invalid' : '' ?>" 
                       id="confirm_password" 
                       name="confirm_password" 
                       required>
                <div class="invalid-feedback">
                    Passwords do not match.
                </div>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" 
                       class="form-check-input" 
                       id="terms" 
                       name="terms" 
                       required>
                <label class="form-check-label" for="terms">
                    I agree to the <a href="<?= base_url('terms') ?>" target="_blank">Terms of Service</a> and 
                    <a href="<?= base_url('privacy') ?>" target="_blank">Privacy Policy</a>
                </label>
                <div class="invalid-feedback">
                    You must agree to the terms and conditions.
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Create Account</button>
            </div>

            <div class="text-center mt-3">
                <p class="mb-0">
                    Already have an account? 
                    <a href="<?= base_url('auth/login') ?>" class="text-decoration-none">
                        Login here
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

    /* Custom validation styles */
    .form-control.is-invalid:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }

    .form-check-input:checked {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }
</style>

<script>
// Custom form validation
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                // Check if passwords match
                var password = document.getElementById('password')
                var confirmPassword = document.getElementById('confirm_password')
                if (password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity('Passwords do not match')
                    event.preventDefault()
                    event.stopPropagation()
                } else {
                    confirmPassword.setCustomValidity('')
                }

                form.classList.add('was-validated')
            }, false)
        })
})()
</script>
