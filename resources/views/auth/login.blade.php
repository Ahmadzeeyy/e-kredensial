<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - E-ASKOMKRE</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --blue: #1a5fa8; --sky: #3b9de8; --navy: #0f172a;
      --teal: #0e9f8c; --light: #f8fafc; --border: #e2e8f0;
      --gray: #64748b; --danger: #ef4444;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
      font-family: 'Plus Jakarta Sans', sans-serif; 
      background: var(--navy); 
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    /* ── BACKGROUND ANIMATION ── */
    body::before, body::after {
      content: ''; position: absolute; border-radius: 50%; z-index: 0; filter: blur(80px); opacity: 0.4;
    }
    body::before { width: 400px; height: 400px; background: var(--blue); top: -100px; right: -100px; }
    body::after { width: 350px; height: 350px; background: var(--sky); bottom: -100px; left: -100px; }

    .login-container {
      position: relative; z-index: 10;
      width: 100%; max-width: 450px;
      padding: 20px;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 28px;
      padding: 48px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .brand { text-align: center; margin-bottom: 40px; }
    .brand-icon { 
      font-size: 40px; margin-bottom: 16px; 
      display: inline-block;
      background: #eff6ff; width: 80px; height: 80px;
      line-height: 80px; border-radius: 24px;
    }
    .brand h1 { font-family: 'Playfair Display', serif; font-size: 28px; color: var(--navy); margin-bottom: 6px; }
    .brand p { font-size: 14px; color: var(--gray); font-weight: 500; }

    .form-group { margin-bottom: 24px; }
    .form-group label { 
      display: block; font-size: 13px; font-weight: 700; color: var(--navy); 
      margin-bottom: 8px; margin-left: 4px;
    }
    .form-group input {
      width: 100%; padding: 14px 18px; border-radius: 14px;
      border: 1.5px solid var(--border); background: #fcfdfe;
      font-size: 15px; font-family: inherit; transition: all 0.2s;
      outline: none;
    }
    .form-group input:focus {
      border-color: var(--sky); background: white;
      box-shadow: 0 0 0 4px rgba(59, 157, 232, 0.1);
    }

    .btn-submit {
      width: 100%; padding: 16px; border-radius: 14px;
      background: linear-gradient(135deg, var(--blue) 0%, var(--sky) 100%);
      color: white; border: none; font-size: 16px; font-weight: 700;
      cursor: pointer; transition: all 0.2s; margin-top: 10px;
      box-shadow: 0 10px 20px -5px rgba(26, 95, 168, 0.4);
    }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 15px 30px -5px rgba(26, 95, 168, 0.5); }
    .btn-submit:active { transform: translateY(0); }

    .footer-links { text-align: center; margin-top: 32px; font-size: 14px; color: var(--gray); }
    .footer-links a { color: var(--blue); font-weight: 700; text-decoration: none; }
    .footer-links a:hover { text-decoration: underline; }

    .error-box {
      background: #fee2e2; color: var(--danger); padding: 12px;
      border-radius: 12px; font-size: 13px; font-weight: 600;
      margin-bottom: 24px; text-align: center; border: 1px solid #fecaca;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="glass-card">
      <div class="brand">
        <div class="brand-icon">🏥</div>
        <h1>E-ASKOMKRE</h1>
        <p>Silakan masuk ke akun Anda</p>
      </div>

      @if($errors->any())
        <div class="error-box">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
          <label>Username / Email</label>
          <input type="text" name="login" value="{{ old('login') }}" required placeholder="Masukkan username atau email..." autofocus>
        </div>

        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" required placeholder="••••••••">
        </div>

        <button type="submit" class="btn-submit">Masuk Sekarang</button>
      </form>

      <div class="footer-links">
        Belum punya akun? <a href="{{ route('register') }}">Daftar sebagai User</a>
      </div>
    </div>
  </div>

</body>
</html>
