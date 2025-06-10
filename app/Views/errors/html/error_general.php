<div class="error-page">
    <div class="error-content text-center">
        <div class="error-illustration">
            <svg width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 15H13V17H11V15ZM11 7H13V13H11V7ZM12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z" fill="#6c757d"/>
            </svg>
        </div>
        
        <h1 class="error-title"><?= $code ?? '000' ?></h1>
        <h2 class="error-subtitle">Unexpected Error</h2>
        
        <p class="error-description">
            An unexpected error occurred while processing your request.
        </p>
        
        <div class="error-actions">
            <button onclick="window.location.reload()" class="btn btn-primary btn-lg">
                Try Again
            </button>
            <a href="<?= base_url() ?>" class="btn btn-outline-secondary btn-lg ms-2">
                Go to Homepage
            </a>
        </div>

        <div class="error-help mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Troubleshooting Steps</h5>
                    <div class="steps-container mt-3">
                        <div class="step">
                            <div class="step-number">1</div>
                            <div class="step-content">
                                <h6>Refresh the Page</h6>
                                <p class="text-muted small">Try refreshing the page to see if the error resolves.</p>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-number">2</div>
                            <div class="step-content">
                                <h6>Clear Browser Cache</h6>
                                <p class="text-muted small">Clear your browser cache and cookies, then try again.</p>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-number">3</div>
                            <div class="step-content">
                                <h6>Check Your Connection</h6>
                                <p class="text-muted small">Ensure you have a stable internet connection.</p>
                            </div>
                        </div>
                        <div class="step">
                            <div class="step-number">4</div>
                            <div class="step-content">
                                <h6>Contact Support</h6>
                                <p class="text-muted small">If the problem persists, please contact our support team.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="support-contact mt-4">
            <p class="text-muted mb-0">
                Need help? Contact our support team at 
                <a href="mailto:<?= config('AppConfig')->contactInfo['email'] ?>" class="text-primary">
                    <?= config('AppConfig')->contactInfo['email'] ?>
                </a>
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
    animation: rotate 10s linear infinite;
}

@keyframes rotate {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.error-title {
    font-size: 6rem;
    font-weight: 700;
    color: #6c757d;
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
}

.steps-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.step {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.step-number {
    width: 30px;
    height: 30px;
    background-color: #e9ecef;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    color: #6c757d;
    flex-shrink: 0;
}

.step-content {
    flex-grow: 1;
}

.step-content h6 {
    margin-bottom: 0.25rem;
    color: #495057;
}

.support-contact a {
    text-decoration: none;
}

.support-contact a:hover {
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
