<div class="error-page">
    <div class="error-content text-center">
        <div class="error-illustration">
            <svg width="200" height="200" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 13H11V7H13M13 17H11V15H13M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2Z" fill="#6c757d"/>
            </svg>
        </div>
        
        <h1 class="error-title">404</h1>
        <h2 class="error-subtitle">Page Not Found</h2>
        
        <p class="error-description">
            The page you're looking for doesn't exist or has been moved.
        </p>
        
        <div class="error-actions">
            <a href="<?= base_url() ?>" class="btn btn-primary btn-lg">
                Go to Homepage
            </a>
            <button onclick="window.history.back()" class="btn btn-outline-secondary btn-lg ms-2">
                Go Back
            </button>
        </div>

        <div class="error-search mt-4">
            <p class="text-muted mb-3">Try searching for what you're looking for:</p>
            <form action="<?= base_url('search') ?>" method="get" class="search-form">
                <div class="input-group">
                    <input type="text" 
                           class="form-control" 
                           placeholder="Search..." 
                           name="q" 
                           aria-label="Search">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

        <div class="error-help mt-4">
            <p class="text-muted">
                If you believe this is a mistake, please <a href="<?= base_url('contact') ?>">contact us</a>.
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
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-20px);
    }
    100% {
        transform: translateY(0px);
    }
}

.error-title {
    font-size: 6rem;
    font-weight: 700;
    color: #2c3e50;
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

.search-form {
    max-width: 400px;
    margin: 0 auto;
}

.search-form .input-group {
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    border-radius: 50px;
    overflow: hidden;
}

.search-form .form-control {
    border: none;
    padding: 0.8rem 1.5rem;
}

.search-form .form-control:focus {
    box-shadow: none;
}

.search-form .btn {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
    border: none;
}

.error-help a {
    color: #007bff;
    text-decoration: none;
}

.error-help a:hover {
    text-decoration: underline;
}
</style>
