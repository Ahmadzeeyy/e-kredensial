<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun - E-ASKOMKRE</title>
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
      overflow-x: hidden;
      position: relative;
    }

    /* ── BACKGROUND ANIMATION ── */
    body::before, body::after {
      content: ''; position: absolute; border-radius: 50%; z-index: 0; filter: blur(80px); opacity: 0.3;
    }
    body::before { width: 450px; height: 450px; background: var(--teal); top: -150px; left: -100px; }
    body::after { width: 400px; height: 400px; background: var(--blue); bottom: -100px; right: -100px; }

    .register-container {
      position: relative; z-index: 10;
      width: 100%; max-width: 500px;
      padding: 40px 20px;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.96);
      backdrop-filter: blur(10px);
      border-radius: 32px;
      padding: 48px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .brand { text-align: center; margin-bottom: 32px; }
    .brand h1 { font-family: 'Playfair Display', serif; font-size: 28px; color: var(--navy); margin-bottom: 6px; }
    .brand p { font-size: 14px; color: var(--gray); font-weight: 500; }

    .grid { display: grid; grid-template-columns: 1fr; gap: 20px; }
    
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
      border-color: var(--teal); background: white;
      box-shadow: 0 0 0 4px rgba(14, 159, 140, 0.1);
    }

    .btn-submit {
      width: 100%; padding: 16px; border-radius: 14px;
      background: linear-gradient(135deg, var(--teal) 0%, #14b89d 100%);
      color: white; border: none; font-size: 16px; font-weight: 700;
      cursor: pointer; transition: all 0.2s; margin-top: 20px;
      box-shadow: 0 10px 20px -5px rgba(14, 159, 140, 0.4);
    }
    .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 15px 30px -5px rgba(14, 159, 140, 0.5); }

    .footer-links { text-align: center; margin-top: 32px; font-size: 14px; color: var(--gray); }
    .footer-links a { color: var(--teal); font-weight: 700; text-decoration: none; }
    .footer-links a:hover { text-decoration: underline; }

    .error-list {
      background: #fee2e2; color: var(--danger); padding: 12px 20px;
      border-radius: 12px; font-size: 12px; font-weight: 600;
      margin-bottom: 24px; list-style: none; border: 1px solid #fecaca;
    }
  </style>
</head>
<body>

  <div class="register-container">
    <div class="glass-card">
      <div class="brand">
        <h1>Daftar Akun</h1>
        <p>Lengkapi data untuk mulai asesmen</p>
      </div>

      @if($errors->any())
        <ul class="error-list">
          @foreach($errors->all() as $error)
            <li>• {{ $error }}</li>
          @endforeach
        </ul>
      @endif

      <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="grid">
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama sesuai ijazah">
          </div>

          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required placeholder="Pilih username pendek">
          </div>

          <div class="form-group">
            <label>Alamat Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required placeholder="contoh@gmail.com">
          </div>

          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required placeholder="Minimal 8 karakter">
          </div>

          <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required placeholder="Ulangi password">
          </div>
        </div>

        <button type="submit" class="btn-submit">Buat Akun Sekarang</button>
      </form>

      <div class="footer-links">
        Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
      </div>
    </div>
  </div>

</body>
</html>
