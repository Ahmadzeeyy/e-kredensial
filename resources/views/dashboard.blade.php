<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Asesi - RSUD Kredensial</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
  <style>
    :root {
      --blue: #1a5fa8; --sky: #3b9de8; --navy: #0f172a;
      --teal: #0e9f8c; --light: #f8fafc; --border: #e2e8f0;
      --gray: #64748b; --accent: #f59e0b;
    }
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { 
      font-family: 'Plus Jakarta Sans', sans-serif; 
      background: #fcfdfe; 
      color: var(--navy);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* ── TOP NAVIGATION ── */
    nav {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(10px);
      padding: 16px 60px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid var(--border);
      position: sticky; top: 0; z-index: 100;
    }
    .logo h1 { font-family: 'Playfair Display', serif; font-size: 22px; color: var(--navy); }
    .logo p { font-size: 10px; color: var(--gray); font-weight: 800; letter-spacing: 0.15em; text-transform: uppercase; text-transform: uppercase; }
    
    .user-menu { display: flex; align-items: center; gap: 24px; }
    .user-profile { display: flex; align-items: center; gap: 12px; text-align: right; }
    .user-name { font-weight: 700; font-size: 14px; color: var(--navy); }
    .user-role { font-size: 11px; color: var(--gray); font-weight: 600; }
    .avatar { width: 40px; height: 40px; background: #e0eeff; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 18px; }

    .btn-logout {
      color: #ef4444; font-size: 13px; font-weight: 700; text-decoration: none;
      padding: 8px 16px; border-radius: 8px; transition: background 0.2s;
    }
    .btn-logout:hover { background: #fee2e2; }

    /* ── HERO SECTION ── */
    .hero {
      background: linear-gradient(145deg, #f8fafc 0%, #eff6ff 100%);
      padding: 60px 60px 100px;
      border-bottom: 1px solid var(--border);
    }
    .hero-content {
      max-width: 1200px; margin: 0 auto;
      display: flex; justify-content: space-between; align-items: center;
    }
    .hero-text h2 { font-family: 'Playfair Display', serif; font-size: 40px; margin-bottom: 12px; }
    .hero-text p { color: var(--gray); font-size: 16px; max-width: 500px; line-height: 1.6; }

    /* Redesigned Button */
    .cta-button {
      background: var(--navy);
      color: white;
      padding: 20px 36px;
      border-radius: 20px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 16px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.3);
      position: relative;
      overflow: hidden;
    }
    .cta-button::before {
      content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
      background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent);
      opacity: 0; transition: 0.3s;
    }
    .cta-button:hover {
      transform: translateY(-5px);
      box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.4);
      background: var(--blue);
    }
    .cta-button:hover::before { opacity: 1; }
    .cta-icon {
      width: 44px; height: 44px; background: rgba(255,255,255,0.15);
      border-radius: 12px; display: flex; align-items: center; justify-content: center;
      font-size: 24px; transition: 0.3s;
    }
    .cta-button:hover .cta-icon { transform: rotate(90deg); background: white; color: var(--blue); }
    .cta-text b { display: block; font-size: 16px; letter-spacing: 0.02em; }
    .cta-text span { font-size: 12px; opacity: 0.7; font-weight: 500; }

    /* ── DASHBOARD GRID ── */
    .main-grid {
      max-width: 1200px; margin: -60px auto 60px; padding: 0 60px;
      display: grid; grid-template-columns: 1fr; gap: 32px;
    }

    .card {
      background: white; border-radius: 24px;
      padding: 40px; border: 1px solid var(--border);
      box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }
    
    /* Stats */
    .stats-row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 32px; }
    .stat-card {
      background: #fcfdfe; border: 1px solid var(--border); padding: 24px; border-radius: 20px;
      display: flex; align-items: center; gap: 16px;
    }
    .stat-icon { width: 50px; height: 50px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .stat-info .val { display: block; font-size: 24px; font-weight: 800; color: var(--navy); }
    .stat-info .lab { font-size: 12px; color: var(--gray); font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; }

    /* Table Styling */
    .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
    .table-header h3 { font-family: 'Playfair Display', serif; font-size: 22px; }
    
    .k-table { width: 100%; border-collapse: collapse; }
    .k-table th { text-align: left; padding: 16px; font-size: 11px; color: var(--gray); text-transform: uppercase; letter-spacing: 0.1em; border-bottom: 2px solid var(--light); }
    .k-table td { padding: 24px 16px; border-bottom: 1px solid var(--light); font-size: 14px; }
    .k-table tr:hover { background: #fafbff; }

    .status-pill {
      display: inline-flex; align-items: center; gap: 6px;
      padding: 6px 14px; border-radius: 99px; font-size: 11px; font-weight: 700;
    }
    .status-pill::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

    .btn-view {
      color: var(--blue); font-weight: 700; text-decoration: none;
      font-size: 13px; display: flex; align-items: center; gap: 6px;
    }
    .btn-view:hover { text-decoration: underline; }

    .empty-box {
      text-align: center; padding: 80px 0;
    }
    .empty-box .icon { font-size: 48px; margin-bottom: 20px; display: block; }
    .empty-box p { color: var(--gray); font-size: 15px; }

    @media (max-width: 900px) {
      .hero-content { flex-direction: column; text-align: center; gap: 32px; }
      .stats-row { grid-template-columns: 1fr; }
      nav { padding: 16px 24px; }
      .hero { padding: 40px 24px 80px; }
      .main-grid { padding: 0 24px; }
    }
  </style>
</head>
<body>

  <nav>
    <div class="logo">
      <h1>RSUD KREDENSIAL</h1>
      <p>Asesmen Kompetensi Digital</p>
    </div>
    <div class="user-menu">
      <div class="user-profile">
        <div>
          <span class="user-name">{{ auth()->user()->name }}</span>
          <span class="user-role">ASESI / PERAWAT</span>
        </div>
        <div class="avatar">👤</div>
      </div>
      <form action="{{ route('logout') }}" method="POST" style="display:inline">
        @csrf
        <button type="submit" class="btn-logout" style="border:none; cursor:pointer; background:none;">Keluar</button>
      </form>
    </div>
  </nav>

  <section class="hero">
    <div class="hero-content">
      <div class="hero-text">
        <h2>Selamat Datang, {{ explode(' ', auth()->user()->name)[0] }}!</h2>
        <p>Pantau kemajuan berkas kredensial Anda atau buat pengajuan baru untuk meningkatkan jenjang kompetensi profesi Anda.</p>
      </div>
      
      <a href="{{ route('form') }}" class="cta-button">
        <div class="cta-icon">＋</div>
        <div class="cta-text">
          <b>Buat Pengajuan</b>
          <span>Mulai Kredensial Baru</span>
        </div>
      </a>
    </div>
  </section>

  <main class="main-grid">
    <!-- STATS -->
    <div class="card">
      <div class="stats-row">
        <div class="stat-card">
          <div class="stat-icon" style="background: #eef2ff; color: #6366f1;">📄</div>
          <div class="stat-info">
            <span class="val">{{ $kredensials->count() }}</span>
            <span class="lab">Total Pengajuan</span>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background: #fffbeb; color: #f59e0b;">⏳</div>
          <div class="stat-info">
            <span class="val">{{ $kredensials->where('status', 'Submitted')->count() }}</span>
            <span class="lab">Menunggu Review</span>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon" style="background: #ecfdf5; color: #10b981;">✅</div>
          <div class="stat-info">
            <span class="val">{{ $kredensials->where('status', 'Approved')->count() }}</span>
            <span class="lab">Disetujui</span>
          </div>
        </div>
      </div>

      <div class="table-header">
        <h3>Riwayat Pengajuan</h3>
      </div>

      @if($kredensials->isEmpty())
        <div class="empty-box">
          <span class="icon">📁</span>
          <p>Belum ada riwayat pengajuan. Klik tombol "Buat Pengajuan" untuk memulai.</p>
        </div>
      @else
        <table class="k-table">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Jabatan / Unit</th>
              <th>Status Progress</th>
              <th width="120">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($kredensials as $k)
              @php $lbl = $k->status_label; @endphp
              <tr>
                <td style="font-weight: 700;">{{ $k->created_at->format('d M Y') }}</td>
                <td>
                  <div style="font-weight: 600;">{{ $k->jabatan }}</div>
                  <div style="font-size: 12px; color: var(--gray);">{{ $k->data_lengkap['prof_unit_kerja'] ?? '-' }}</div>
                </td>
                <td>
                  <span class="status-pill" style="background: {{ $lbl['bg'] }}; color: {{ $lbl['color'] }};">
                    {{ $lbl['text'] }}
                  </span>
                </td>
                <td>
                  <div style="display: flex; gap: 8px; align-items: center;">
                    <a href="#" class="btn-view">Detail →</a>
                    @if($k->status === 'Approved')
                      <a href="{{ route('kredensial.sertifikat', $k->id) }}" class="btn-view" style="color: #c2410c; background: #fff7ed; padding: 4px 8px; border-radius: 6px; border: 1px solid #fdba74;">
                        📜 Sertifikat
                      </a>
                    @endif
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </div>
  </main>

</body>
</html>
