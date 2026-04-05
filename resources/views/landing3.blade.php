<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bimbel BS | Bimbingan Belajar Terpercaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0f7fa, #e8f5e9);
            font-family: 'Poppins', sans-serif;
        }
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }
        .hero h1 {
            font-weight: 700;
            font-size: 3rem;
            color: #2e7d32;
        }
        .hero p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 30px;
        }
        .btn {
            line-height: 1.5; /* balances vertical centering */
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-main {
            background-color: #2e7d32;
            color: white;
            padding: 12px 28px;
            font-size: 1.1rem;
            border-radius: 30px;
            transition: all 0.3s ease;
        }
        .btn-main:hover {
            background-color: #43a047;
        }
        footer {
            text-align: center;
            padding: 20px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="hero container">
        <h1>Bimbel BS</h1>
        <p>Bimbingan Belajar untuk Masa Depanmu 🌱</p>
        <div class="d-flex gap-3 justify-content-center">
            <a href="{{ route('login') }}" class="btn btn-outline-success px-4">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary px-4">Register</a>
            <a href="https://wa.me/085369319188" target="_blank" class="btn btn-main">
                Hubungi Kami di WhatsApp
            </a>
        </div>
    </div>
    <footer>
        &copy; {{ date('Y') }} Bimbel BS. All rights reserved.
    </footer>
</body>
</html>
