<!-- Hero Section -->
<section class="hero-section">
    <div class="container text-center">
        <h1 class="display-4 mb-4">Welcome to INI Clone</h1>
        <p class="lead mb-5">Discover amazing content and connect with our community</p>
        <?php if (!isset($isLoggedIn) || !$isLoggedIn): ?>
            <a href="<?= base_url('auth/register') ?>" class="btn btn-primary btn-lg">Get Started</a>
        <?php endif; ?>
    </div>
</section>

<!-- Features Section -->
<section class="container mb-5">
    <h2 class="text-center mb-5">Our Features</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <h3 class="h4 mb-3">User Management</h3>
                    <p class="text-muted">Comprehensive user roles and permissions system for secure access control.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <h3 class="h4 mb-3">Content Management</h3>
                    <p class="text-muted">Easy-to-use interface for managing and organizing your content.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card custom-card">
                <div class="card-body text-center">
                    <h3 class="h4 mb-3">Analytics</h3>
                    <p class="text-muted">Detailed insights and statistics about your website's performance.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-primary text-white py-5 text-center">
    <div class="container">
        <h2 class="mb-4">Ready to get started?</h2>
        <p class="lead mb-4">Join our community today and experience all the features we offer.</p>
        <?php if (!isset($isLoggedIn) || !$isLoggedIn): ?>
            <a href="<?= base_url('auth/register') ?>" class="btn btn-light btn-lg">Sign Up Now</a>
        <?php endif; ?>
    </div>
</section>

<!-- Additional Styles -->
<style>
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                    url('https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1920');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 100px 0;
        margin-bottom: 50px;
    }
    
    .feature-card {
        margin-bottom: 30px;
    }
</style>
