<div class="error-page">
    <div class="error-content text-center">
        <div class="error-illustration">
            <svg width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 8h-2.81c-.45-.78-1.07-1.45-1.82-1.96L17 4.41 15.59 3l-2.17 2.17C12.96 5.06 12.49 5 12 5c-.49 0-.96.06-1.41.17L8.41 3 7 4.41l1.62 1.63C7.88 6.55 7.26 7.22 6.81 8H4v2h2.09c-.05.33-.09.66-.09 1v1H4v2h2v1c0 .34.04.67.09 1H4v2h2.81c1.04 1.79 2.97 3 5.19 3s4.15-1.21 5.19-3H20v-2h-2.09c.05-.33.09-.66.09-1v-1h2v-2h-2v-1c0-.34-.04-.67-.09-1H20V8zm-4 4v3c0 2.21-1.79 4-4 4s-4-1.79-4-4v-3c0-2.21 1.79-4 4-4s4 1.79 4 4zm-4 5c1.1 0 2-.9 2-2h-4c0 1.1.9 2 2 2z" fill="#6c757d"/>
            </svg>
        </div>
        
        <div class="status-badge mb-4">
            <span class="badge rounded-pill text-bg-warning">System Status</span>
        </div>

        <h1 class="error-title">Oops!</h1>
        <h2 class="error-subtitle">Something went wrong</h2>
        
        <p class="error-description">
            <?= $message ?? 'We encountered an unexpected error while processing your request.' ?>
        </p>
        
        <div class="error-actions">
            <button onclick="window.location.reload()" class="btn btn-primary btn-lg">
                Try Again
            </button>
            <a href="<?= base_url() ?>" class="btn btn-outline-secondary btn-lg ms-2">
                Go to Homepage
            </a>
        </div>

        <div class="system-status mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title mb-0">System Status</h5>
                        <div class="status-indicator">
                            <span class="status-dot"></span>
                            Investigating
                        </div>
                    </div>
                    <p class="text-muted mb-0">
                        Our team has been notified and is working to resolve the issue.
                        We apologize for any inconvenience this may cause.
                    </p>
                </div>
            </div>
        </div>

        <div class="alternative-actions mt-4">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="action-card">
                        <h6>Check System Status</h6>
                        <p class="small text-muted mb-0">
                            View our system status page for updates
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="action-card">
                        <h6>Contact Support</h6>
                        <p class="small text-muted mb-0">
                            Get help from our support team
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="support-contact mt-4">
            <p class="text-muted mb-0">
                Need immediate assistance? Contact our support team at 
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
    animation: bounce 2s ease infinite;
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

.error-title {
    font-size: 3.5rem;
    font-weight: 700;
    color: #6c757d;
    margin-bottom: 0.5rem;
}

.error-subtitle {
    font-size: 1.5rem;
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

.system-status .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.status-indicator {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background-color: rgba(255, 193, 7, 0.1);
    border-radius: 50px;
    color: #ffc107;
    font-size: 0.875rem;
}

.status-dot {
    width: 8px;
    height: 8px;
    background-color: #ffc107;
    border-radius: 50%;
    display: inline-block;
    animation: pulse 1s ease infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.5);
        opacity: 0.5;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.action-card {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 1.5rem;
    height: 100%;
    transition: all 0.3s ease;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
        font-size: 2.5rem;
    }
    
    .error-subtitle {
        font-size: 1.25rem;
    }
    
    .error-actions .btn {
        display: block;
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .error-actions .btn:last-child {
        margin-bottom: 0;
    }

    .action-card {
        margin-bottom: 1rem;
    }
}
</style>

<script>
// Optional: Add automatic refresh functionality
let refreshAttempts = 0;
const maxAttempts = 3;
const refreshInterval = 30000; // 30 seconds

function attemptRefresh() {
    if (refreshAttempts < maxAttempts) {
        refreshAttempts++;
        window.location.reload();
    }
}

// Uncomment to enable auto-refresh
// setTimeout(attemptRefresh, refreshInterval);
</script>
