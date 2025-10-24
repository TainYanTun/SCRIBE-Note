<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Access Denied</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #191919;
            color: #e9e9e7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 520px;
            width: 100%;
        }

        .error-card {
            background: #191919;
            border: 1px solid #2f2f2f;
            border-radius: 8px;
            padding: 64px 48px;
            text-align: center;
        }

        .error-code {
            font-size: 64px;
            font-weight: 600;
            color: #6b6b68;
            margin-bottom: 24px;
            letter-spacing: -1px;
        }

        .error-title {
            font-size: 20px;
            font-weight: 600;
            color: #e9e9e7;
            margin-bottom: 12px;
        }

        .error-description {
            font-size: 15px;
            line-height: 1.6;
            color: #9b9a97;
            margin-bottom: 40px;
        }

        .suggestions {
            text-align: left;
            margin-bottom: 40px;
            padding: 0;
        }

        .suggestion-item {
            font-size: 14px;
            color: #9b9a97;
            margin-bottom: 8px;
            line-height: 1.5;
        }

        .suggestion-item::before {
            content: "•";
            color: #6b6b68;
            margin-right: 12px;
        }

        .actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .btn {
            padding: 10px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.15s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #2f2f2f;
            color: #e9e9e7;
        }

        .btn-primary:hover {
            background: #3f3f3f;
        }

        .btn-secondary {
            background: transparent;
            color: #9b9a97;
        }

        .btn-secondary:hover {
            background: #252525;
        }

        @media (max-width: 640px) {
            .error-card {
                padding: 48px 32px;
            }

            .error-code {
                font-size: 48px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-card">
            <div class="error-code">403</div>
            <h1 class="error-title">Access Denied</h1>
            <p class="error-description">
                You don't have permission to access this resource.
            </p>

            <div class="suggestions">
                <div class="suggestion-item">Check if you're logged in with the correct account</div>
                <div class="suggestion-item">Verify you have the necessary permissions</div>
                <div class="suggestion-item">Contact an administrator if you need access</div>
            </div>

            <div class="actions">
                <a href="javascript:history.back()" class="btn btn-secondary">Go Back</a>
                <a href="{{ url('/') }}" class="btn btn-primary">Go to Homepage</a>
            </div>
        </div>
    </div>
</body>
</html>