<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Maintenance - <?= config('AppConfig')->appName ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .maintenance-container {
            max-width: 600px;
            padding: 2rem;
            text-align: center;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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

        .maintenance-icon {
            width: 150px;
            height: 150px;
            margin-bottom: 2rem;
        }

        .maintenance-title {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .maintenance-message {
            color: #666;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .status-indicator {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background: #fff3cd;
            border-radius: 50px;
            color: #856404;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .status-indicator::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #ffc107;
            border-radius: 50%;
            margin-right: 8px;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            50% { opacity: 0.5; }
        }

        .social-links {
            margin-top: 2rem;
        }

        .social-links a {
            color: #6c757d;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #007bff;
        }

        .estimated-time {
            margin-top: 1.5rem;
            padding: 1rem;
            background: #e9ecef;
            border-radius: 10px;
            font-size: 0.9rem;
            color: #495057;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="maintenance-container">
            <!-- Maintenance Icon -->
            <svg class="maintenance-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="#007bff" d="M502.6 389.5L378.2 265.1c25.8-40.3 40.9-88.1 40.9-139.6C419.1 56.4 362.7 0 293.6 0c-39.9 0-76.1 15.7-103.5 41C163.1 15.7 126.9 0 87 0C17.9 0-38.5 56.4-38.5 125.5c0 52.3 15.7 100.8 42.3 141.5L-120.6 391c-12.5 12.5-12.5 32.8 0 45.2l186.4 186.4c12.5 12.5 32.8 12.5 45.2 0l391.6-391.6c12.5-12.5 12.5-32.8 0-45.2zM293.6 321.1c-35.6 0-64.5-28.9-64.5-64.5s28.9-64.5 64.5-64.5 64.5 28.9 64.5 64.5-28.9 64.5-64.5 64.5z"/>
            </svg>

            <div class="status-indicator">
                Maintenance in Progress
            </div>

            <h1 class="maintenance-title">We'll Be Back Soon!</h1>
            
            <p class="maintenance-message">
                <?= esc($message) ?>
            </p>

            <div class="estimated-time">
                <strong>Estimated Completion Time:</strong><br>
                We expect to be back online within 2 hours.<br>
                Thank you for your patience!
            </div>

            <div class="social-links">
                <a href="<?= config('AppConfig')->socialLinks['twitter'] ?>" target="_blank">Twitter</a>
                <a href="<?= config('AppConfig')->socialLinks['facebook'] ?>" target="_blank">Facebook</a>
                <a href="<?= config('AppConfig')->socialLinks['instagram'] ?>" target="_blank">Instagram</a>
            </div>
        </div>
    </div>

    <script>
        // Optional: Add a countdown timer if you want to show exact time remaining
        function updateTimer() {
            // Add your countdown logic here
        }
    </script>
</body>
</html>
