<div class="error-page">
    <div class="error-content text-center">
        <div class="error-illustration">
            <svg width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1ZM12 11.99H19C18.47 16.11 15.72 19.78 12 20.93V12H5V6.3L12 3.19V11.99Z" fill="#dc3545"/>
            </svg>
        </div>
        
        <h1 class="error-title">403</h1>
        <h2 class="error-subtitle">Access Forbidden</h2>
        
        <p class="error-description">
            Sorry, you don't have permission to access this page.
        </p>
        
        <div class="error-actions">
            <?php if (!session()->get('isLoggedIn')): ?>
                <a href="<?= base_url('auth/login') ?>" class="btn btn-primary btn-lg">
                    Login
                </a>
            <?php endif; ?>
            <a href="<?= base_url() ?>" class="btn btn-outline-secondary btn-lg ms-2">
                Go to Homepage
            </a>
        </div>

        <div class="error-help mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Need Help?</h5>
                    <p class="card-text text-muted">
                        If you believe you should have access to this page:
                    </p>
                    <ul class="text-start text-muted mb-0">
                        <li>Make sure you're logged in with the correct account</li>
                        <li>Check if you have the necessary permissions</li>
                        <li>Contact your administrator for access</li>
                        <li>Report this as an error if you think this is a mistake</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="contact-support mt-4">
            <p class="text-muted">
                Need assistance? <a href="<?= base_url('contact') ?>">Contact Support</a>
            </p>
        </div>
    </div>
</div>

<style>
.error-page {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.error-content {
    max-width: 600px;
    margin: 0 auto;
}

.error-illustration {
    margin-bottom: 2rem;
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-10px); }
    75% { transform: translateX(10px); }
}

.error-title {
    font-size: 6rem;
    font-weight: 700;
    color: #dc3545;
    margin-bottom: 0;
    line-height: 1;
}

.error-subtitle {
    font-size: 2rem;
    color: #6c757d;
    margin-bottom: 1.5rem;
}

.error-description {
    font-size: 1.1rem;
    color: #6c757d;
    margin-bottom: 2rem;
}

.error-actions {
    margin-bottom: 2rem;
}

.error-actions .btn {
    padding: 0.8rem 2rem;
    border-radius: 50px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.error-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.error-help .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.error-help .card:hover {
    transform: translateY(-5px);
}

.error-help ul {
    list-style-type: none;
    padding-left: 0;
}

.error-help ul li {
    position: relative;
    padding-left: 1.5rem;
    margin-bottom: 0.5rem;
}

.error-help ul li:before {
    content: "•";
    color: #dc3545;
    position: absolute;
    left: 0;
}

.error-help ul li:last-child {
    margin-bottom: 0;
}

.contact-support a {
    color: #007bff;
    text-decoration: none;
    font-weight: 500;
}

.contact-support a:hover {
    text-decoration: underline;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .error-title {
        font-size: 4rem;
    }
    
    .error-subtitle {
        font-size: 1.5rem;
    }
    
    .error-actions .btn {
        display: block;
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .error-actions .btn:last-child {
        margin-bottom: 0;
    }
}
</style>
