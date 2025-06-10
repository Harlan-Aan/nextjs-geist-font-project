<div class="error-page">
    <div class="error-content text-center">
        <div class="error-illustration">
            <svg width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM13 17H11V15H13V17ZM13 13H11V7H13V13Z" fill="#ffc107"/>
            </svg>
        </div>
        
        <h1 class="error-title">500</h1>
        <h2 class="error-subtitle">Internal Server Error</h2>
        
        <p class="error-description">
            Oops! Something went wrong on our end. We're working to fix it.
        </p>
        
        <div class="error-actions">
            <button onclick="window.location.reload()" class="btn btn-primary btn-lg">
                Try Again
            </button>
            <a href="<?= base_url() ?>" class="btn btn-outline-secondary btn-lg ms-2">
                Go to Homepage
            </a>
        </div>

        <div class="error-details mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">What you can do:</h5>
                    <div class="accordion" id="errorAccordion">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#refresh">
                                    Refresh the page
                                </button>
                            </h2>
                            <div id="refresh" class="accordion-collapse collapse" data-bs-parent="#errorAccordion">
                                <div class="accordion-body text-muted">
                                    The issue might be temporary. Try refreshing the page to see if it resolves.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#clear">
                                    Clear your browser cache
                                </button>
                            </h2>
                            <div id="clear" class="accordion-collapse collapse" data-bs-parent="#errorAccordion">
                                <div class="accordion-body text-muted">
                                    Old cached data might be causing issues. Try clearing your browser cache and cookies.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contact">
                                    Contact support
                                </button>
                            </h2>
                            <div id="contact" class="accordion-collapse collapse" data-bs-parent="#errorAccordion">
                                <div class="accordion-body text-muted">
                                    If the problem persists, please contact our support team for assistance.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="error-status mt-4">
            <div class="alert alert-warning d-inline-flex align-items-center" role="alert">
                <svg class="me-2" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 5.99L19.53 19H4.47L12 5.99M12 2L1 21h22L12 2zm1 14h-2v2h2v-2zm0-6h-2v4h2v-4z"/>
                </svg>
                Our team has been notified and is working on the issue
            </div>
        </div>

        <div class="support-contact mt-4">
            <p class="text-muted mb-0">
                Need immediate assistance? 
                <a href="<?= base_url('contact') ?>" class="text-primary">Contact Support</a>
                or email us at <a href="mailto:<?= config('AppConfig')->contactInfo['email'] ?>" class="text-primary">
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
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.8;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.error-title {
    font-size: 6rem;
    font-weight: 700;
    color: #ffc107;
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

.error-details .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.accordion-button {
    background: none;
    border: none;
    padding: 1rem;
    font-weight: 500;
    color: #495057;
}

.accordion-button:not(.collapsed) {
    background-color: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}

.accordion-button:focus {
    box-shadow: none;
    border-color: rgba(255, 193, 7, 0.1);
}

.accordion-body {
    padding: 1rem;
    background-color: #f8f9fa;
    border-radius: 0 0 15px 15px;
}

.error-status .alert {
    border: none;
    border-radius: 50px;
    padding: 0.8rem 1.5rem;
    font-size: 0.9rem;
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
