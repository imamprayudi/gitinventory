<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Server Error - GIT Custom Inventory</title>
    <meta name="description" content="Server Error">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="./images/icon_gitinventory.ico">
    <link rel="stylesheet" href="./dashboard/css/bootstrap.min.css">
    <link rel="stylesheet" href="./dashboard/css/font-awesome.min.css">
    <link rel="stylesheet" href="./dashboard/assets/css/style.css">
    <style>
        .error-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .error-card {
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 500px;
        }
        .error-icon {
            font-size: 80px;
            color: #dc3545;
            margin-bottom: 20px;
        }
        .error-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }
        .error-message {
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .btn-home {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: transform 0.3s ease;
        }
        .btn-home:hover {
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }
        .error-details {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            text-align: left;
            font-family: monospace;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-card">
            <div class="error-icon">
                <i class="fa fa-exclamation-triangle"></i>
            </div>
            <h1 class="error-title">500</h1>
            <h2 style="color: #666; margin-bottom: 20px;">Server Error</h2>
            <p class="error-message">
                Maaf, terjadi kesalahan pada server. Tim teknis kami sedang menangani masalah ini.
                <br><br>
                {{-- <strong>Kemungkinan penyebab:</strong><br>
                • Koneksi database bermasalah<br>
                • API eksternal tidak merespons<br>
                • Data tidak tersedia sementara --}}
            </p>
            
            <div style="margin: 20px 0;">
                <a href="{{ url('/') }}" class="btn-home">
                    <i class="fa fa-home"></i> Kembali ke Beranda
                </a>
            </div>
            
            <div style="margin-top: 20px;">
                <button onclick="location.reload()" class="btn btn-outline-secondary">
                    <i class="fa fa-refresh"></i> Coba Lagi
                </button>
            </div>
            
            @if(config('app.debug') && isset($error))
            <div class="error-details">
                <strong>Debug Info:</strong><br>
                {{ $error }}
            </div>
            @endif
            
            <div style="margin-top: 30px; font-size: 12px; color: #999;">
                Error ID: {{ date('YmdHis') }}-{{ substr(md5(time()), 0, 8) }}
            </div>
        </div>
    </div>
    
    <script>
        // Auto refresh setelah 30 detik
        setTimeout(function() {
            if (confirm('Halaman akan dimuat ulang otomatis. Lanjutkan?')) {
                location.reload();
            }
        }, 30000);
    </script>
</body>
</html>