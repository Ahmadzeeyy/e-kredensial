<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Formulir Kredensial – RSUD dr. M. Soewandhie</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --navy:   #0d2b55;
    --blue:   #1a5fa8;
    --sky:    #3b9de8;
    --teal:   #0e9f8c;
    --accent: #e8a020;
    --light:  #f0f6ff;
    --white:  #ffffff;
    --gray:   #64748b;
    --border: #cbd5e1;
    --danger: #dc2626;
    --success:#16a34a;
    --card-shadow: 0 4px 24px rgba(13,43,85,0.10);
    --radius: 14px;
  }

  * { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: linear-gradient(135deg, #e8f0fc 0%, #f0f9ff 50%, #e8f4f0 100%);
    min-height: 100vh;
    color: #1e293b;
  }

  /* ── HEADER ── */
  header {
    background: linear-gradient(135deg, var(--navy) 0%, var(--blue) 60%, #1e7bb8 100%);
    color: white;
    padding: 0;
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 4px 20px rgba(13,43,85,0.35);
  }
  .header-inner {
    max-width: 1100px;
    margin: 0 auto;
    padding: 18px 24px;
    display: flex;
    align-items: center;
    gap: 18px;
  }
  .header-logo {
    width: 52px; height: 52px;
    background: rgba(255,255,255,0.15);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
    border: 1.5px solid rgba(255,255,255,0.3);
  }
  .header-text h1 {
    font-family: 'Playfair Display', serif;
    font-size: 18px;
    font-weight: 700;
    letter-spacing: 0.01em;
    line-height: 1.2;
  }
  .header-text p {
    font-size: 12px;
    opacity: 0.75;
    margin-top: 3px;
    font-weight: 400;
  }

  /* ── PROGRESS BAR ── */
  .progress-bar {
    background: rgba(255,255,255,0.15);
    height: 4px;
  }
  .progress-fill {
    background: var(--accent);
    height: 100%;
    transition: width 0.4s ease;
    width: 0%;
  }

  /* ── STEPPER ── */
  .stepper-wrap {
    background: white;
    border-bottom: 1px solid var(--border);
    padding: 16px 0;
    overflow-x: auto;
  }
  .stepper {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    gap: 6px;
    align-items: center;
    justify-content: center;
  }
  .step {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    flex-shrink: 0;
    padding: 6px 12px;
    border-radius: 99px;
    transition: background 0.2s;
  }
  .step:hover .step-label { color: var(--blue); }
  .step-num {
    width: 26px; height: 26px;
    border-radius: 50%;
    background: var(--border);
    color: var(--gray);
    font-size: 12px;
    font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.3s;
    flex-shrink: 0;
  }
  .step.active .step-num { background: var(--blue); color: white; }
  .step.done .step-num { background: var(--teal); color: white; }
  .step-label {
    font-size: 12px;
    font-weight: 500;
    color: var(--gray);
    white-space: nowrap;
    transition: color 0.2s;
  }
  .step.active .step-label { color: var(--blue); font-weight: 600; }
  .step.done .step-label { color: var(--teal); }
  .step-divider { width: 20px; height: 1px; background: var(--border); flex-shrink: 0; }

  /* ── MAIN ── */
  main {
    max-width: 1100px;
    margin: 0 auto;
    padding: 32px 24px 60px;
  }

  /* ── SECTION ── */
  .section { display: none; }
  .section.active { display: block; animation: fadeIn 0.3s ease; }
  @keyframes fadeIn { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:none; } }

  .section-header {
    margin-bottom: 28px;
  }
  .section-badge {
    display: inline-block;
    background: var(--light);
    color: var(--blue);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 4px 12px;
    border-radius: 99px;
    margin-bottom: 10px;
    border: 1px solid #c7ddf7;
  }
  .section-title {
    font-family: 'Playfair Display', serif;
    font-size: 26px;
    color: var(--navy);
    font-weight: 700;
    line-height: 1.2;
  }
  .section-desc {
    margin-top: 8px;
    color: var(--gray);
    font-size: 14px;
    line-height: 1.6;
  }

  /* ── CARD ── */
  .card {
    background: white;
    border-radius: var(--radius);
    box-shadow: var(--card-shadow);
    padding: 28px;
    margin-bottom: 20px;
    border: 1px solid rgba(203,213,225,0.6);
  }
  .card-title {
    font-size: 13px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
    color: var(--blue);
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .card-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border);
  }

  /* ── FORM GRID ── */
  .grid { display: grid; gap: 18px; }
  .grid-2 { grid-template-columns: 1fr 1fr; }
  .grid-3 { grid-template-columns: 1fr 1fr 1fr; }
  @media (max-width: 620px) {
    .grid-2, .grid-3 { grid-template-columns: 1fr; }
  }
  .col-full { grid-column: 1 / -1; }

  /* ── FIELD ── */
  .field label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
    letter-spacing: 0.02em;
  }
  .field label span.req { color: var(--danger); margin-left: 2px; }
  .field label span.opt { color: var(--gray); font-weight: 400; font-size: 11px; margin-left: 4px; }

  .field input, .field select, .field textarea {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid var(--border);
    border-radius: 9px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    color: #1e293b;
    background: #fafbff;
    transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    outline: none;
  }
  .field input:focus, .field select:focus, .field textarea:focus {
    border-color: var(--sky);
    background: white;
    box-shadow: 0 0 0 3px rgba(59,157,232,0.15);
  }
  .field input.invalid { border-color: var(--danger); }
  .field textarea { min-height: 160px; resize: vertical; }
  .field select { cursor: pointer; }
  .err-msg { font-size: 11px; color: var(--danger); margin-top: 4px; display: none; }
  .field.has-error .err-msg { display: block; }
  .field.has-error input, .field.has-error select { border-color: var(--danger); }

  /* ── TOGGLE GROUP ── */
  .toggle-group {
    display: flex;
    border: 1.5px solid var(--border);
    border-radius: 9px;
    overflow: hidden;
    background: #fafbff;
  }
  .toggle-group label {
    flex: 1;
    text-align: center;
    padding: 10px 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    border-right: 1.5px solid var(--border);
    color: var(--gray);
  }
  .toggle-group label:last-child { border-right: none; }
  .toggle-group input[type=radio] { display: none; }
  .toggle-group input[type=radio]:checked + label {
    background: var(--blue);
    color: white;
  }

  /* ── YES/NO QUESTIONS ── */
  .yn-list { display: flex; flex-direction: column; gap: 10px; }
  .yn-item {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    background: var(--light);
    border-radius: 10px;
    padding: 12px 16px;
    border: 1px solid #dbeafe;
    transition: background 0.2s;
  }
  .yn-item:hover { background: #e0eeff; }
  .yn-question { flex: 1; font-size: 13px; color: #1e293b; line-height: 1.5; }
  .yn-btns { display: flex; gap: 6px; flex-shrink: 0; }
  .yn-btn {
    padding: 5px 16px;
    border-radius: 7px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    border: 1.5px solid var(--border);
    background: white;
    color: var(--gray);
    transition: all 0.18s;
  }
  .yn-btn.yes.active { background: var(--teal); border-color: var(--teal); color: white; }
  .yn-btn.no.active  { background: #e53e3e;  border-color: #e53e3e;  color: white; }
  .yn-btn:hover:not(.active) { border-color: var(--sky); color: var(--blue); }
  .yn-note {
    width: 250px;
    min-height: 60px;
    padding: 10px 12px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 12px;
    font-family: inherit;
    outline: none;
    background: white;
    transition: all 0.2s;
    resize: vertical;
  }
  .yn-note:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(26,95,168,0.1); }

  /* ── PORTFOLIO ── */
  .porto-list { display: flex; flex-direction: column; gap: 8px; }
  .porto-item {
    display: flex;
    align-items: center;
    gap: 16px;
    background: var(--light);
    border-radius: 10px;
    padding: 12px 16px;
    border: 1px solid #dbeafe;
  }
  .porto-name { flex: 1; font-size: 13px; font-weight: 600; color: #1e293b; }
  .porto-btns { display: flex; gap: 6px; }
  .porto-btn {
    padding: 5px 12px;
    border-radius: 7px;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    border: 1.5px solid var(--border);
    background: white;
    color: var(--gray);
    transition: all 0.18s;
    white-space: nowrap;
  }
  .porto-btn.ya.active     { background: var(--teal);  border-color: var(--teal);  color: white; }
  .porto-btn.tidak.active  { background: #e53e3e;       border-color: #e53e3e;      color: white; }
  .porto-btn.belum.active  { background: var(--accent); border-color: var(--accent);color: white; }

  /* ── NAVIGATION ── */
  .nav-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 32px;
    gap: 12px;
  }
  .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 28px;
    border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    border: none;
    transition: all 0.2s;
  }
  .btn-primary {
    background: linear-gradient(135deg, var(--blue) 0%, var(--sky) 100%);
    color: white;
    box-shadow: 0 4px 14px rgba(26,95,168,0.35);
  }
  .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(26,95,168,0.45); }
  .btn-secondary {
    background: white;
    color: var(--blue);
    border: 1.5px solid var(--border);
  }
  .btn-secondary:hover { background: var(--light); }
  .btn-success {
    background: linear-gradient(135deg, var(--teal) 0%, #14b89d 100%);
    color: white;
    box-shadow: 0 4px 14px rgba(14,159,140,0.35);
    padding: 14px 36px;
    font-size: 15px;
  }
  .btn-success:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(14,159,140,0.45); }
  .btn:disabled { opacity: 0.5; cursor: not-allowed; transform: none !important; }

  /* ── REVIEW TABLE ── */
  .review-table { width: 100%; border-collapse: collapse; font-size: 13px; }
  .review-table td { padding: 9px 14px; border-bottom: 1px solid var(--border); }
  .review-table td:first-child { font-weight: 600; color: var(--gray); width: 45%; }
  .review-table td:last-child { color: #1e293b; }
  .review-table tr:last-child td { border-bottom: none; }

  /* ── SUCCESS ── */
  .success-box {
    text-align: center;
    padding: 60px 24px;
  }
  .success-icon {
    width: 90px; height: 90px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--teal), #14b89d);
    display: flex; align-items: center; justify-content: center;
    font-size: 42px;
    margin: 0 auto 24px;
    box-shadow: 0 8px 30px rgba(14,159,140,0.3);
  }
  .success-box h2 {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    color: var(--navy);
    margin-bottom: 12px;
  }
  .success-box p { color: var(--gray); font-size: 15px; line-height: 1.6; }
  .forms-done {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 10px;
    margin: 28px 0;
    text-align: left;
  }
  .form-chip {
    background: var(--light);
    border: 1px solid #c7ddf7;
    border-radius: 9px;
    padding: 10px 14px;
    font-size: 12px;
    font-weight: 600;
    color: var(--blue);
    display: flex;
    align-items: center;
    gap: 8px;
  }
  .form-chip::before { content: '✓'; color: var(--teal); font-weight: 800; }

  /* ── SPINNER ── */
  .spinner {
    width: 20px; height: 20px;
    border: 2.5px solid rgba(255,255,255,0.35);
    border-top-color: white;
    border-radius: 50%;
    animation: spin 0.7s linear infinite;
    display: none;
  }
  @keyframes spin { to { transform: rotate(360deg); } }
  .btn.loading .spinner { display: block; }
  .btn.loading .btn-text { display: none; }

  /* ── TOAST ── */
  .toast {
    position: fixed;
    bottom: 28px; right: 28px;
    background: var(--navy);
    color: white;
    padding: 14px 20px;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 600;
    box-shadow: 0 8px 30px rgba(0,0,0,0.25);
    transform: translateY(80px);
    opacity: 0;
    transition: all 0.35s cubic-bezier(.34,1.56,.64,1);
    z-index: 999;
    max-width: 320px;
  }
  .toast.show { transform: none; opacity: 1; }
  .toast.error { background: var(--danger); }

  /* Info note */
  .info-note {
    background: #fff8e6;
    border: 1px solid #fcd34d;
    border-radius: 10px;
    padding: 12px 16px;
    font-size: 13px;
    color: #92400e;
    margin-top: 16px;
    display: flex;
    gap: 10px;
    align-items: flex-start;
    line-height: 1.5;
  }
</style>
</head>
<body>

<!-- HEADER -->
<header>
  <div class="header-inner">
    <div class="header-logo">🏥</div>
    <div class="header-text">
      <h1>Formulir Kredensial Asesmen Kompetensi Perawat</h1>
      <p>RSUD dr. Mohamad Soewandhie Surabaya</p>
    </div>
    <div style="margin-left: auto; display: flex; gap: 12px; align-items: center;">
      <a href="{{ route('dashboard') }}" style="color: white; text-decoration: none; font-size: 13px; font-weight: 600; padding: 8px 16px; background: rgba(255,255,255,0.15); border-radius: 8px; border: 1px solid rgba(255,255,255,0.3);">← Dashboard</a>
      <form action="{{ route('logout') }}" method="POST" style="display:inline">
        @csrf
        <button type="submit" style="color: white; text-decoration: none; font-size: 13px; font-weight: 600; padding: 8px 16px; background: rgba(220,38,38,0.6); border-radius: 8px; border: 1px solid rgba(255,255,255,0.3); cursor: pointer;">Keluar</button>
      </form>
    </div>
  </div>
  <div class="progress-bar"><div class="progress-fill" id="progressFill"></div></div>
</header>

<!-- STEPPER -->
<div class="stepper-wrap">
  <div class="stepper" id="stepper"></div>
</div>

<!-- MAIN -->
<main>

  <!-- ═══ SECTION 1: DATA ASESI ═══ -->
  <div class="section active" id="sec1">
    <div class="section-header">
      <div class="section-badge">FORM-01</div>
      <div class="section-title">Data Pribadi Asesi</div>
      <div class="section-desc">Isi data peserta yang akan menjalani asesmen kompetensi.</div>
    </div>

    <div class="card">
      <div class="card-title">Identitas Diri</div>
      <div class="grid grid-2">
        <div class="field col-full">
          <label>Nama Lengkap <span class="req">*</span></label>
          <input type="text" id="nama_asesi" placeholder="contoh: Budi Santoso, S.Kep">
          <div class="err-msg">Nama wajib diisi</div>
        </div>
        <div class="field">
          <label>Tempat / Tanggal Lahir <span class="req">*</span></label>
          <input type="text" id="ttl" placeholder="contoh: Surabaya, 01 Januari 1990">
          <div class="err-msg">Wajib diisi</div>
        </div>
        <div class="field">
          <label>Jenis Kelamin <span class="req">*</span></label>
          <div class="toggle-group">
            <input type="radio" name="jk" id="jk_l" value="Laki-laki">
            <label for="jk_l">♂ Laki-laki</label>
            <input type="radio" name="jk" id="jk_p" value="Perempuan">
            <label for="jk_p">♀ Perempuan</label>
          </div>
        </div>
        <div class="field">
          <label>Kebangsaan <span class="req">*</span></label>
          <input type="text" id="kebangsaan" value="Indonesia">
        </div>
        <div class="field col-full">
          <label>Alamat Rumah <span class="req">*</span></label>
          <textarea id="alamat" placeholder="Jl. contoh No. 10, Surabaya"></textarea>
          <div class="err-msg">Alamat wajib diisi</div>
        </div>
        <div class="field">
          <label>Kode Pos <span class="opt">(opsional)</span></label>
          <input type="text" id="kode_pos" placeholder="60xxx">
        </div>
        <div class="field">
          <label>Nomor HP <span class="req">*</span></label>
          <input type="text" id="no_hp" placeholder="08xxxxxxxxxx">
          <div class="err-msg">No. HP wajib diisi</div>
        </div>
        <div class="field">
          <label>E-mail <span class="opt">(opsional)</span></label>
          <input type="email" id="email" placeholder="nama@email.com">
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-title">Data Pendidikan Formal Terakhir</div>
      <div class="grid grid-2">
        <div class="field">
          <label>Nama Institusi Pendidikan <span class="req">*</span></label>
          <input type="text" id="nama_sekolah" placeholder="Universitas Airlangga">
          <div class="err-msg">Wajib diisi</div>
        </div>
        <div class="field">
          <label>Jurusan / Program Studi <span class="req">*</span></label>
          <input type="text" id="jurusan" placeholder="Ilmu Keperawatan">
          <div class="err-msg">Wajib diisi</div>
        </div>
        <div class="field">
          <label>Strata <span class="opt">(opsional)</span></label>
          <select id="strata">
            <option value="">-- Pilih --</option>
            <option>D3</option><option>D4</option><option>S1</option>
            <option>Ners</option><option>S2</option><option>S3</option>
          </select>
        </div>
        <div class="field">
          <label>Tahun Lulus <span class="req">*</span></label>
          <input type="text" id="tahun_lulus" placeholder="2020">
          <div class="err-msg">Wajib diisi</div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-title">Data Pekerjaan Sekarang</div>
      <div class="grid grid-2">
        <div class="field">
          <label>Nama Lembaga / Rumah Sakit <span class="req">*</span></label>
          <input type="text" id="nama_lembaga" value="RSUD dr. M. Soewandhie">
          <div class="err-msg">Wajib diisi</div>
        </div>
        <div class="field">
          <label>Jabatan / Posisi <span class="req">*</span></label>
          <input type="text" id="jabatan" placeholder="Perawat Pelaksana">
          <div class="err-msg">Wajib diisi</div>
        </div>
        <div class="field col-full">
          <label>Alamat Kantor</label>
          <input type="text" id="alamat_kantor" value="Jl. Dharmahusada No.178, Surabaya">
        </div>
      </div>
    </div>

    <!-- ═══ FORM-01: KOMPETENSI ═══ -->
    <div class="card" style="margin-top: 32px;">
      <div class="card-title">Bagian II: Unit Kompetensi (FORM-01)</div>
      <p style="font-size: 13px; color: var(--gray); margin-bottom: 24px; line-height: 1.5;">
        Berikut adalah daftar unit kompetensi. Silakan isi kolom <b>Keterangan/Pengalaman</b> pada unit yang Anda kuasai.
      </p>

      @php $idx = 0; @endphp
      @foreach($competencyList as $catTitle => $items)
        @php $idx++; @endphp
        <div class="acc-item" id="comp_{{ $idx }}">
          <div class="acc-header" onclick="toggleComp({{ $idx }})" style="padding: 16px 20px; display: flex; justify-content: space-between; align-items: center; cursor: pointer; background: #f8fafc; border-radius: 12px; margin-bottom: 8px; border: 1px solid var(--border);">
            <div style="display: flex; align-items: center; gap: 12px;">
              <span style="background: var(--blue); color: white; width: 24px; height: 24px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 800;">{{ $idx }}</span>
              <span style="font-weight: 700; font-size: 14px; color: var(--navy);">{{ $catTitle }}</span>
            </div>
            <span class="arrow" style="font-size: 12px; color: var(--gray);">▼</span>
          </div>
          <div class="acc-content" style="display: none; padding: 10px 0 20px;">
            <table style="width: 100%; border-collapse: collapse;">
              <thead>
                <tr style="text-align: left; font-size: 11px; color: var(--gray); text-transform: uppercase;">
                  <th style="padding: 12px; border-bottom: 2px solid #f1f5f9;">Unit Kompetensi</th>
                  <th style="padding: 12px; border-bottom: 2px solid #f1f5f9;" width="40%">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                @foreach($items as $key => $val)
                  @if(is_array($val))
                    <tr style="background: #fdfdfd;">
                      <td colspan="2" style="padding: 10px 12px; font-weight: 700; font-size: 12px; color: var(--blue); border-bottom: 1px solid #f1f5f9;">{{ $val['label'] }}</td>
                    </tr>
                    @foreach($val['items'] as $subKey => $subVal)
                      <tr>
                        <td style="padding: 12px; border-bottom: 1px solid #f1f5f9; font-size: 13px;">{{ $subVal }}</td>
                        <td style="padding: 12px; border-bottom: 1px solid #f1f5f9;">
                          <textarea class="comp-input" data-key="{{ $subKey }}" placeholder="Tuliskan pengalaman..." style="width: 100%; padding: 8px; border: 1px solid var(--border); border-radius: 8px; font-size: 12px; font-family: inherit; min-height: 40px;"></textarea>
                        </td>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td style="padding: 12px; border-bottom: 1px solid #f1f5f9; font-size: 13px;">{{ $val }}</td>
                      <td style="padding: 12px; border-bottom: 1px solid #f1f5f9;">
                        <textarea class="comp-input" data-key="{{ $key }}" placeholder="Tuliskan pengalaman..." style="width: 100%; padding: 8px; border: 1px solid var(--border); border-radius: 8px; font-size: 12px; font-family: inherit; min-height: 40px;"></textarea>
                      </td>
                    </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      @endforeach
    </div>

    <div class="nav-bar">
      <div></div>
      <button class="btn btn-primary" onclick="nextSection(1)">
        Selanjutnya →
      </button>
    </div>
  </div>

  <!-- ═══ SECTION 2: DATA ASESMEN ═══ -->
  <div class="section" id="sec2">
    <div class="section-header">
      <div class="section-badge">FORM-02 s/d FORM-06</div>
      <div class="section-title">Data Asesmen</div>
      <div class="section-desc">Isi informasi asesor, unit kompetensi, dan jadwal pelaksanaan.</div>
    </div>

    <div class="card">
      <div class="card-title">Informasi Asesor</div>
      <div class="grid grid-2">
        <div class="field">
          <label>Nama Asesor <span class="req">*</span></label>
          <input type="text" id="nama_asessor" placeholder="dr. Nama Asesor">
          <div class="err-msg">Wajib diisi</div>
        </div>
        <div class="field">
          <label>No. Registrasi Asesor <span class="opt">(opsional)</span></label>
          <input type="text" id="no_reg_asesor" placeholder="ASR-0001">
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-title">Unit Kompetensi</div>
      <div class="grid">
        <div class="field">
          <label>Kode Unit Kompetensi <span class="opt">(opsional)</span></label>
          <input type="text" id="kode_unit" placeholder="KES.PG02.001.01">
        </div>
        <div class="field">
          <label>Judul Unit Kompetensi <span class="req">*</span></label>
          <input type="text" id="judul_unit" value="Memberikan Asuhan Keperawatan Sederhana pada Pasien">
          <div class="err-msg">Wajib diisi</div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-title">Jadwal Pelaksanaan</div>
      <div class="grid grid-3">
        <div class="field">
          <label>Tanggal <span class="req">*</span></label>
          <input type="text" id="tanggal" placeholder="27 April 2026">
          <div class="err-msg">Wajib diisi</div>
        </div>
        <div class="field">
          <label>Waktu <span class="req">*</span></label>
          <input type="text" id="waktu" placeholder="08.00 WIB">
          <div class="err-msg">Wajib diisi</div>
        </div>
        <div class="field">
          <label>Tempat <span class="req">*</span></label>
          <input type="text" id="tempat" value="RSUD dr. M. Soewandhie Surabaya">
          <div class="err-msg">Wajib diisi</div>
        </div>
      </div>
    </div>

    <div class="nav-bar">
      <button class="btn btn-secondary" onclick="prevSection(2)">← Kembali</button>
      <button class="btn btn-primary" onclick="nextSection(2)">Selanjutnya →</button>
    </div>
  </div>

  <!-- ═══ SECTION 3: INFORM CONSENT ═══ -->
  <div class="section" id="sec3">
    <div class="section-header">
      <div class="section-badge">FORM-04</div>
      <div class="section-title">Persetujuan Asesmen</div>
      <div class="section-desc">Konfirmasi persetujuan asesi terhadap proses asesmen kompetensi.</div>
    </div>

    <div class="card">
      <div class="card-title">Pertanyaan Inform Consent</div>
      <div class="yn-list" id="consentList"></div>
    </div>

    <div class="nav-bar">
      <button class="btn btn-secondary" onclick="prevSection(3)">← Kembali</button>
      <button class="btn btn-primary" onclick="nextSection(3)">Selanjutnya →</button>
    </div>
  </div>

  <!-- ═══ SECTION 4: UMPAN BALIK ═══ -->
  <div class="section" id="sec4">
    <div class="section-header">
      <div class="section-badge">FORM-08</div>
      <div class="section-title">Umpan Balik Peserta</div>
      <div class="section-desc">Penilaian peserta terhadap proses asesmen yang telah dilakukan.</div>
    </div>

    <div class="card">
      <div class="card-title">Kuesioner Umpan Balik</div>
      <div class="yn-list" id="umpanList"></div>
    </div>

    <div class="card">
      <div class="card-title">Catatan Pelaksanaan Asesmen</div>
      <div class="grid grid-2">
        <div class="field">
          <label>Aspek Negatif dan Positif</label>
          <textarea id="catatan_aspek" placeholder="Tuliskan aspek negatif dan positif..."></textarea>
        </div>
        <div class="field">
          <label>Pencatatan Penolakan Hasil</label>
          <textarea id="catatan_penolakan" placeholder="Tuliskan catatan penolakan jika ada..."></textarea>
        </div>
        <div class="field col-full">
          <label>Saran Perbaikan</label>
          <textarea id="catatan_saran" placeholder="Tuliskan saran perbaikan..."></textarea>
        </div>
      </div>
    </div>

    <div class="nav-bar">
      <button class="btn btn-secondary" onclick="prevSection(4)">← Kembali</button>
      <button class="btn btn-primary" onclick="nextSection(4)">Selanjutnya →</button>
    </div>
  </div>

  <!-- ═══ SECTION 5: IDENTITAS PROFESI ═══ -->
  <div class="section" id="sec5">
    <div class="section-header">
      <div class="section-badge">DATA PROFESI</div>
      <div class="section-title">Data Identitas Profesi</div>
      <div class="section-desc">Isi data pendidikan terakhir dan identitas keprofesian Anda.</div>
    </div>

    <!-- I. DATA PROFIL -->
    <div class="card">
      <div class="card-title">I. DATA PROFIL</div>
      <div class="grid grid-2">
        <div class="field col-full">
          <label>Nama Lengkap</label>
          <input type="text" id="prof_nama" readonly style="background: #f1f5f9;">
        </div>
        <div class="field">
          <label>NIP / NIK</label>
          <input type="text" id="prof_nip" placeholder="Masukkan NIP/NIK">
        </div>
        <div class="field">
          <label>No. KTP</label>
          <input type="text" id="prof_ktp" placeholder="Masukkan No. KTP">
        </div>
        <div class="field">
          <label>Tempat Lahir</label>
          <input type="text" id="prof_tempat_lahir" readonly style="background: #f1f5f9;">
        </div>
        <div class="field">
          <label>Tanggal Lahir</label>
          <input type="text" id="prof_tgl_lahir" readonly style="background: #f1f5f9;">
        </div>
        <div class="field">
          <label>Jenis Kelamin</label>
          <input type="text" id="prof_jk" readonly style="background: #f1f5f9;">
        </div>
        <div class="field">
          <label>Agama</label>
          <select id="prof_agama">
            <option value="">-- Pilih --</option>
            <option>Islam</option><option>Kristen</option><option>Katolik</option>
            <option>Hindu</option><option>Budha</option><option>Konghucu</option>
          </select>
        </div>
        <div class="field">
          <label>Status Kawin</label>
          <select id="prof_status_kawin">
            <option value="">-- Pilih --</option>
            <option>Kawin</option><option>Belum Kawin</option><option>Janda/Duda</option>
          </select>
        </div>
        <div class="field col-full">
          <label>Alamat Lengkap (Sesuai KTP)</label>
          <textarea id="prof_alamat_ktp" readonly style="background: #f1f5f9; min-height: 80px;"></textarea>
        </div>
        <div class="field">
          <label>Telp. Rumah</label>
          <input type="text" id="prof_telp_rumah" placeholder="031-xxxxxx">
        </div>
        <div class="field">
          <label>No. HP 1 (Aktif)</label>
          <input type="text" id="prof_hp1" readonly style="background: #f1f5f9;">
        </div>
        <div class="field">
          <label>No. HP 2 (Opsional)</label>
          <input type="text" id="prof_hp2" placeholder="08xxxxxxxxxx">
        </div>
        <div class="field">
          <label>Alamat Email Aktif</label>
          <input type="text" id="prof_email_aktif" readonly style="background: #f1f5f9;">
        </div>
      </div>
    </div>

    <!-- II. DATA PENDIDIKAN -->
    <div class="card">
      <div class="card-title">II. DATA PENDIDIKAN</div>
      <div class="grid grid-2">
        <div class="field col-full">
          <label>Ijasah Terakhir</label>
          <input type="text" id="prof_ijazah_terakhir" placeholder="Ners / S1 Keperawatan">
        </div>
        <div class="field">
          <label>No. Ijasah Terakhir</label>
          <input type="text" id="prof_no_ijazah" placeholder="Nomor Ijasah">
        </div>
        <div class="field">
          <label>Tahun Ijasah Terakhir</label>
          <input type="text" id="prof_tahun_ijazah" placeholder="YYYY">
        </div>
        <div class="field col-full">
          <label>Nama Institusi Pendidikan Terakhir</label>
          <input type="text" id="prof_institusi" placeholder="Nama Universitas / Institusi">
        </div>
      </div>
    </div>

    <!-- III. DATA PEKERJAAN -->
    <div class="card">
      <div class="card-title">III. DATA PEKERJAAN</div>
      <div class="grid grid-2">
        <div class="field">
          <label>Jenis Profesi</label>
          <input type="text" id="prof_jenis" placeholder="Perawat">
        </div>
        <div class="field">
          <label>Jenjang Profesi</label>
          <input type="text" id="prof_jenjang" placeholder="Perawat Klinik II">
        </div>
        <div class="field">
          <label>No. STR</label>
          <input type="text" id="prof_no_str" placeholder="Nomor STR">
        </div>
        <div class="field">
          <label>Tanggal Berlaku STR</label>
          <input type="text" id="prof_berlaku_str" placeholder="dd/mm/yyyy atau Seumur Hidup">
        </div>
        <div class="field">
          <label>Unit Kerja Saat Ini</label>
          <input type="text" id="prof_unit_kerja" placeholder="IGD / ICU / Ruang Rawat Inap">
        </div>
        <div class="field">
          <label>Masa Kerja (Tahun)</label>
          <input type="number" id="prof_masa_kerja" placeholder="0">
        </div>
        <div class="field col-full">
          <label>Status Kepegawaian</label>
          <input type="text" id="prof_status_pegawai" placeholder="PNS / Non-PNS / Kontrak">
        </div>
      </div>
    </div>

    <!-- IV. DATA PELATIHAN -->
    <style>
      .dynamic-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
      .dynamic-table th { background: #f8fafc; text-align: left; padding: 12px; font-size: 12px; font-weight: 700; color: #64748b; border-bottom: 2px solid #e2e8f0; }
      .dynamic-table td { padding: 8px; border-bottom: 1px solid #f1f5f9; }
      .dynamic-table input { width: 100%; padding: 8px; border: 1.5px solid #e2e8f0; border-radius: 6px; font-size: 13px; outline: none; }
      .dynamic-table input:focus { border-color: var(--blue); }
      .btn-add-row { margin-top: 15px; background: #eef2ff; color: #4f46e5; border: 1px dashed #c7d2fe; padding: 10px; border-radius: 8px; width: 100%; font-weight: 600; cursor: pointer; transition: all 0.2s; }
      .btn-add-row:hover { background: #e0e7ff; border-style: solid; }
      .btn-del-row { color: #ef4444; cursor: pointer; font-weight: 800; padding: 5px; }
    </style>
    <div class="card">
      <div class="card-title">IV. DATA PELATIHAN</div>
      <table class="dynamic-table" id="tablePelatihan">
        <thead>
          <tr>
            <th>NAMA PELATIHAN</th>
            <th>TAHUN</th>
            <th>JPL</th>
            <th>SKP</th>
            <th width="40"></th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <button class="btn-add-row" onclick="addRow('tablePelatihan')">+ Tambah Pelatihan</button>
    </div>

    <!-- V. DATA RIWAYAT IKI -->
    <div class="card">
      <div class="card-title">V. DATA RIWAYAT IKI</div>
      <table class="dynamic-table" id="tableIKI">
        <thead>
          <tr>
            <th>TAHUN</th>
            <th>BULAN</th>
            <th>NILAI</th>
            <th width="40"></th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <button class="btn-add-row" onclick="addRow('tableIKI')">+ Tambah Riwayat IKI</button>
    </div>

    <!-- VI. DATA ASSESMENT -->
    <div class="card">
      <div class="card-title">VI. DATA ASSESMENT KOMPETENSI KEPERAWATAN</div>
      <table class="dynamic-table" id="tableAsesmen">
        <thead>
          <tr>
            <th>TANGGAL PENGAJUAN</th>
            <th>JENJANG PENGAJUAN</th>
            <th>JADWAL ASESMEN</th>
            <th>HASIL ASESMEN</th>
            <th width="40"></th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
      <button class="btn-add-row" onclick="addRow('tableAsesmen')">+ Tambah Data Asesmen</button>
    </div>

    <div class="nav-bar">
      <button class="btn btn-secondary" onclick="prevSection(5)">← Kembali</button>
      <button class="btn btn-primary" onclick="nextSection(5)">Selanjutnya →</button>
    </div>
  </div>

  <!-- ═══ SECTION 6: KELENGKAPAN DOKUMEN ═══ -->
  <style>
    .split-upload {
      display: flex;
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 25px rgba(0,0,0,0.05);
      min-height: 450px;
      border: 1px solid #eef2f6;
    }
    
    /* Left Side: Drop Area */
    .upload-left {
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: #fcfdfe;
      border-right: 1px solid #f1f5f9;
      text-align: center;
    }
    .drop-zone {
      width: 100%;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      border: 2px dashed #cbd5e1;
      border-radius: 16px;
      padding: 30px;
      transition: all 0.3s;
      cursor: pointer;
    }
    .drop-zone:hover { border-color: #3b82f6; background: #f8faff; }
    .drop-zone.active { border-color: #3b82f6; background: #eff6ff; }
    
    .upload-main-icon {
      font-size: 60px;
      color: #3b82f6;
      margin-bottom: 20px;
      transition: transform 0.3s;
    }
    .drop-zone:hover .upload-main-icon { transform: translateY(-5px); }
    
    .drop-text { font-size: 18px; font-weight: 500; color: #334155; margin-bottom: 8px; }
    .drop-or { color: #94a3b8; font-size: 14px; margin: 10px 0; }
    .btn-browse {
      background: #3b82f6;
      color: white;
      padding: 12px 40px;
      border-radius: 10px;
      font-weight: 600;
      font-size: 15px;
      border: none;
      box-shadow: 0 4px 12px rgba(59,130,246,0.3);
    }
    
    /* Right Side: File List */
    .upload-right {
      flex: 1.2;
      padding: 30px;
      background: white;
      max-height: 500px;
      overflow-y: auto;
    }
    .file-list-header {
      font-size: 14px;
      font-weight: 700;
      color: #1e293b;
      margin-bottom: 20px;
      padding-bottom: 10px;
      border-bottom: 1px solid #f1f5f9;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .file-row {
      display: flex;
      align-items: center;
      padding: 12px;
      border-radius: 12px;
      margin-bottom: 8px;
      transition: all 0.2s;
      border: 1px solid transparent;
      cursor: pointer;
      position: relative;
    }
    .file-row:hover { background: #f8fafc; border-color: #e2e8f0; }
    .file-row.active { background: #f0f7ff; border-color: #bfdbfe; }
    .file-row.done { background: #f0fdf4; }
    
    .file-type-icon {
      width: 40px; height: 40px;
      border-radius: 50%;
      border: 1px solid #3b82f6;
      color: #3b82f6;
      display: flex; align-items: center; justify-content: center;
      font-size: 10px; font-weight: 800;
      margin-right: 15px;
      background: white;
    }
    .file-row.done .file-type-icon { border-color: #22c55e; color: #22c55e; }
    
    .file-details { flex: 1; }
    .file-name-label { display: block; font-size: 13px; font-weight: 600; color: #334155; }
    .file-status-text { font-size: 11px; color: #94a3b8; }
    .file-row.done .file-status-text { color: #22c55e; font-weight: 500; }
    
    .file-check {
      width: 20px; height: 20px;
      display: flex; align-items: center; justify-content: center;
      color: #cbd5e1;
      font-size: 14px;
    }
    .file-row.done .file-check { color: #22c55e; }
  </style>

  <!-- ═══ SECTION 6: KELENGKAPAN DOKUMEN ═══ -->
  <div class="section" id="sec6">
    <div class="section-header">
      <div class="section-badge">UPLOAD CENTER</div>
      <div class="section-title">Kelengkapan Dokumen</div>
      <div class="section-desc">Klik nama dokumen di kanan, lalu upload filenya di sebelah kiri.</div>
    </div>

    <div class="split-upload">
      <!-- LEFT -->
      <div class="upload-left">
        <label for="active_file_input" class="drop-zone" id="dropZone">
          <div class="upload-main-icon">📤</div>
          <div class="drop-text">Drag and Drop file</div>
          <div class="drop-or">or</div>
          <div class="btn-browse">Browse</div>
          <input type="file" id="active_file_input" accept=".pdf" style="display: none;" onchange="processFile(this)">
        </label>
      </div>

      <!-- RIGHT -->
      <div class="upload-right">
        <div class="file-list-header">Daftar Dokumen (PDF)</div>
        
        @php
          $docs = [
            'file_ijazah' => 'Ijazah',
            'file_transkrip' => 'Transkrip Nilai',
            'file_str' => 'Surat Tanda Registrasi',
            'file_praktik' => 'Praktik Perawat/Bidan',
            'file_sertifikat' => 'Sertifikat Pelatihan',
            'file_logbook' => 'Log Book / Buku Putih',
            'file_form' => 'Form Asessmen Kompetensi',
          ];
        @endphp

        @foreach($docs as $id => $label)
        <div class="file-row" id="row_{{ $id }}" onclick="selectFileSlot('{{ $id }}')">
          <div class="file-type-icon">PDF</div>
          <div class="file-details">
            <span class="file-name-label">{{ $label }}</span>
            <span class="file-status-text" id="status_{{ $id }}">Belum diunggah</span>
          </div>
          <div class="file-check" id="check_{{ $id }}">✓</div>
          <!-- Hidden inputs that will actually be submitted -->
          <input type="file" name="{{ $id }}" id="input_{{ $id }}" accept=".pdf" style="display: none;" onchange="updateFileState('{{ $id }}')">
        </div>
        @endforeach
      </div>
    </div>

    <div class="nav-bar">
      <button class="btn btn-secondary" onclick="prevSection(6)">← Kembali</button>
      <button class="btn btn-primary" onclick="nextSection(6)">Review & Unduh →</button>
    </div>
  </div>

  <!-- ═══ SECTION 7: REVIEW ═══ -->
  <div class="section" id="sec7">
    <div class="section-header">
      <div class="section-badge">FINAL STEP</div>
      <div class="section-title">Konfirmasi & Kirim</div>
      <div class="section-desc">Periksa kembali data Anda. Setelah dikirim, data akan diverifikasi oleh tim Asesor.</div>
    </div>

    <div class="card">
      <div class="card-title">Ringkasan Data</div>
      <table class="review-table" id="reviewTable"></table>
    </div>

    <div style="text-align:center; margin-top: 32px;">
      <button class="btn btn-success" id="downloadBtn" onclick="submitApplication()">
        <div class="spinner" id="btnSpinner"></div>
        <span class="btn-text">🚀 Kirim Pengajuan</span>
      </button>
    </div>

    <div class="nav-bar" style="margin-top: 40px;">
      <button class="btn btn-secondary" onclick="prevSection(7)">← Kembali Edit</button>
      <div></div>
    </div>
  </div>

</main>

<!-- TOAST -->
<div class="toast" id="toast"></div>

<script>
const v = (id) => document.getElementById(id)?.value || "";
let currentSlot = 'file_ijazah';

function selectFileSlot(id) {
  currentSlot = id;
  document.querySelectorAll('.file-row').forEach(r => r.classList.remove('active'));
  document.getElementById('row_' + id).classList.add('active');
  
  // Trigger file input click
  document.getElementById('input_' + id).click();
}

function updateFileState(id) {
  const input = document.getElementById('input_' + id);
  const file = input.files[0];
  const row = document.getElementById('row_' + id);
  const status = document.getElementById('status_' + id);
  
  if (file) {
    const sizeMB = file.size / (1024 * 1024);
    const isPDF = file.type === 'application/pdf';
    
    if (sizeMB > 5 || !isPDF) {
      showToast("Gagal! File harus PDF & Maks 5MB.", true);
      input.value = '';
      row.classList.remove('done');
      status.textContent = "Belum diunggah";
      return;
    }
    
    // Success
    row.classList.add('done');
    status.textContent = "✅ " + file.name + " (" + (file.size/1024).toFixed(1) + " KB)";
    showToast("Dokumen '" + file.name + "' berhasil dipilih.");
  }
}

function processFile(input) {
  // Not used as we trigger specific inputs
}

// Drag & Drop Support
document.addEventListener('DOMContentLoaded', () => {
  const zone = document.getElementById('dropZone');
  if (zone) {
    zone.addEventListener('dragover', (e) => {
      e.preventDefault();
      zone.classList.add('active');
    });
    zone.addEventListener('dragleave', () => {
      zone.classList.remove('active');
    });
    zone.addEventListener('drop', (e) => {
      e.preventDefault();
      zone.classList.remove('active');
      const files = e.dataTransfer.files;
      if (files.length > 0) {
        // Assign to current selected slot
        const input = document.getElementById('input_' + currentSlot);
        input.files = files;
        updateFileState(currentSlot);
      }
    });
  }
});

const STEPS = [
  { label: "Data Asesi" },
  { label: "Data Asesmen" },
  { label: "Inform Consent" },
  { label: "Umpan Balik" },
  { label: "Identitas Profesi" },
  { label: "Kelengkapan" },
  { label: "Kirim" },
];

const CONSENT_QUESTIONS = [
  "Apakah tujuan asesmen dan konsekuensi sudah dijelaskan dengan benar?",
  "Apakah asesi telah menerima dan dijelaskan standar kompetensi yang akan di-ases?",
  "Apakah asesi mengerti bukti apa saja yang akan dikumpulkan?",
  "Apakah hak-hak asesi selama asesmen telah dijelaskan dengan rinci?",
  "Apakah asesi telah dijelaskan dengan rinci proses banding terhadap asesmen?",
  "Apakah asesi telah mengetahui bahwa bukti-bukti informasi yang dikumpulkan hanya untuk kepentingan asesmen dan disimpan serta diakses hanya oleh orang tertentu?",
];

const UMPAN_QUESTIONS = [
  "Saya mendapatkan penjelasan yang cukup memadai mengenai proses asesmen",
  "Saya diberikan kesempatan mempelajari standar kompetensi dan menilai diri sendiri",
  "Asesor memberikan kesempatan mendiskusikan metoda, instrumen, dan jadwal asesmen",
  "Asesor berusaha menggali seluruh bukti pendukung sesuai latar belakang saya",
  "Saya mendapatkan jaminan kerahasiaan hasil asesmen",
  "Saya sepenuhnya diberikan kesempatan mendemonstrasikan kompetensi selama asesmen",
  "Saya mendapatkan penjelasan yang memadai mengenai keputusan asesmen",
  "Asesor memberikan umpan balik yang mendukung setelah asesmen",
  "Asesor menggunakan keterampilan komunikasi yang efektif selama asesmen",
  "Asesor bersama saya menandatangani semua dokumen hasil asesmen",
];

const PORTO_ITEMS = [
  "ASKEP (Asuhan Keperawatan)",
  "LOG BOOK",
  "SERTIFIKAT PELATIHAN DASAR",
  "SERTIFIKAT PELATIHAN",
  "SERTIFIKAT PENINGKATAN KOMPETENSI",
  "DISKUSI REFLEKSI KASUS",
  "IJASAH DAN TRANSKIP",
];

let consentState  = new Array(CONSENT_QUESTIONS.length).fill(null);
let consentNotes  = new Array(CONSENT_QUESTIONS.length).fill("");
let umpanState    = new Array(UMPAN_QUESTIONS.length).fill(null);
let umpanNotes    = new Array(UMPAN_QUESTIONS.length).fill("");
let portoState    = new Array(PORTO_ITEMS.length).fill(null);
let currentSec    = 1;

function init() {
  buildStepper();
  buildYNList("consentList", CONSENT_QUESTIONS, consentState, "consent");
  buildYNList("umpanList",   UMPAN_QUESTIONS,   umpanState,   "umpan");
  buildPortoList();
  updateProgress();

  const today = new Date();
  const opts = { day:'2-digit', month:'long', year:'numeric' };
  const tglEl = document.getElementById("tanggal");
  if (tglEl) tglEl.value = today.toLocaleDateString("id-ID", opts);
}

function buildStepper() {
  const el = document.getElementById("stepper");
  el.innerHTML = STEPS.map((s, i) => {
    const n = i + 1;
    const cls = n === 1 ? "active" : "";
    const div = n < STEPS.length ? `<div class="step-divider"></div>` : "";
    return `<div class="step ${cls}" id="stepEl${n}" onclick="goToStep(${n})">
      <div class="step-num">${n}</div>
      <span class="step-label">${s.label}</span>
    </div>${div}`;
  }).join("");
}

function updateStepper(current) {
  STEPS.forEach((_, i) => {
    const n = i + 1;
    const el = document.getElementById(`stepEl${n}`);
    el.className = "step";
    if (n < current) el.classList.add("done");
    else if (n === current) el.classList.add("active");
  });
}

function updateProgress() {
  const pct = ((currentSec - 1) / (STEPS.length - 1)) * 100;
  document.getElementById("progressFill").style.width = pct + "%";
}

function goToStep(n) {
  if (n < currentSec) showSection(n);
}

function showSection(n) {
  document.querySelectorAll(".section").forEach(s => s.classList.remove("active"));
  document.getElementById(`sec${n}`).classList.add("active");
  currentSec = n;
  updateStepper(n);
  updateProgress();
  window.scrollTo({ top: 0, behavior: "smooth" });
}

function nextSection(current) {
  if (!validateSection(current)) return;
  if (current === 4) syncProfile(); // Sync profile when moving to Step 5
  if (current === STEPS.length - 1) buildReview();
  showSection(current + 1);
}

function syncProfile() {
  const ttl = v('ttl');
  const ttlParts = ttl.split(',');
  
  const elNama = document.getElementById('prof_nama');
  const elTempat = document.getElementById('prof_tempat_lahir');
  const elTgl = document.getElementById('prof_tgl_lahir');
  const elJk = document.getElementById('prof_jk');
  const elAlamat = document.getElementById('prof_alamat_ktp');
  const elHp = document.getElementById('prof_hp1');
  const elEmail = document.getElementById('prof_email_aktif');

  if (elNama) elNama.value = v('nama_asesi');
  if (elTempat) elTempat.value = ttlParts[0]?.trim() || '';
  if (elTgl) elTgl.value = ttlParts[1]?.trim() || '';
  if (elJk) elJk.value = document.querySelector('input[name="jk"]:checked')?.value || '';
  if (elAlamat) elAlamat.value = v('alamat');
  if (elHp) elHp.value = v('no_hp');
  if (elEmail) elEmail.value = v('email');
}

function addRow(tableId) {
  const tbody = document.getElementById(tableId).querySelector('tbody');
  const tr = document.createElement('tr');
  
  let html = '';
  if (tableId === 'tablePelatihan') {
    html = `<td><input type="text" class="p_nama"></td><td><input type="text" class="p_tahun"></td><td><input type="text" class="p_jpl"></td><td><input type="text" class="p_skp"></td>`;
  } else if (tableId === 'tableIKI') {
    html = `<td><input type="text" class="iki_tahun"></td><td><input type="text" class="iki_bulan"></td><td><input type="text" class="iki_nilai"></td>`;
  } else if (tableId === 'tableAsesmen') {
    html = `<td><input type="text" class="ase_tgl"></td><td><input type="text" class="ase_jenjang"></td><td><input type="text" class="ase_jadwal"></td><td><input type="text" class="ase_hasil"></td>`;
  }
  
  tr.innerHTML = html + `<td><span class="btn-del-row" onclick="this.parentElement.parentElement.remove()">×</span></td>`;
  tbody.appendChild(tr);
}

function getTableData(tableId, rowSelector = 'tr') {
    const rows = document.querySelectorAll(`#${tableId} tbody ${rowSelector}`);
    return Array.from(rows).map(row => {
      const inputs = row.querySelectorAll('input, select');
      const rowData = {};
      inputs.forEach(input => {
        const fieldName = input.id.split('_').pop();
        rowData[fieldName] = input.value;
      });
      return rowData;
    });
  }

  function getCompData() {
    const data = {};
    document.querySelectorAll('.comp-input').forEach(tx => {
      if (tx.value.trim() !== '') {
        data[tx.dataset.key] = tx.value;
      }
    });
    return data;
  }

  function toggleComp(id) {
    const item = document.getElementById('comp_' + id);
    const content = item.querySelector('.acc-content');
    const arrow = item.querySelector('.arrow');
    const isActive = content.style.display === 'block';
    
    content.style.display = isActive ? 'none' : 'block';
    arrow.style.transform = isActive ? 'rotate(0deg)' : 'rotate(180deg)';
  }

function prevSection(current) {
  showSection(current - 1);
}

function validateSection(sec) {
  let ok = true;
  const required = {
    1: ["nama_asesi", "ttl", "alamat", "no_hp", "nama_sekolah", "jurusan", "tahun_lulus", "nama_lembaga", "jabatan"],
    2: ["nama_asessor", "judul_unit", "tanggal", "waktu", "tempat"],
  };
  
  if (required[sec]) {
    required[sec].forEach(id => {
      const field = document.getElementById(id);
      if (!field) return; // Skip if field doesn't exist
      
      const parent = field.closest(".field");
      if (!field.value || !field.value.trim()) {
        if (parent) parent.classList.add("has-error");
        ok = false;
      } else {
        if (parent) parent.classList.remove("has-error");
      }
    });
  }

  if (sec === 1) {
    const jk = document.querySelector('input[name="jk"]:checked');
    if (!jk) { 
      showToast("Pilih jenis kelamin terlebih dahulu", true); 
      ok = false; 
    }
  }

  if (!ok) showToast("Ada kolom wajib yang belum diisi", true);
  return ok;
}

function buildYNList(containerId, questions, stateArr, prefix) {
  const container = document.getElementById(containerId);
  container.innerHTML = questions.map((q, i) => `
    <div class="yn-item" id="${prefix}_item_${i}">
      <span class="yn-question">${i+1}. ${q}</span>
      <div class="yn-btns">
        <button class="yn-btn yes" onclick="setYN('${prefix}',${i},true)">Ya</button>
        <button class="yn-btn no"  onclick="setYN('${prefix}',${i},false)">Tidak</button>
      </div>
      <textarea class="yn-note" placeholder="Catatan/Komentar Peserta" oninput="setYNNote('${prefix}',${i},this.value)"></textarea>
    </div>
  `).join("");
}

function setYNNote(prefix, idx, val) {
  const arr = prefix === "consent" ? consentNotes : umpanNotes;
  arr[idx] = val;
}

function setYN(prefix, idx, val) {
  const arr = prefix === "consent" ? consentState : umpanState;
  arr[idx] = val;
  const item = document.getElementById(`${prefix}_item_${idx}`);
  item.querySelector(".yes").classList.toggle("active", val === true);
  item.querySelector(".no").classList.toggle("active",  val === false);
}

function buildPortoList() {
  const container = document.getElementById("portoList");
  container.innerHTML = PORTO_ITEMS.map((item, i) => `
    <div class="porto-item">
      <span class="porto-name">${i+1}. ${item}</span>
      <div class="porto-btns">
        <button class="porto-btn ya"    onclick="setPorto(${i},'ya')">✓ Ada</button>
        <button class="porto-btn tidak" onclick="setPorto(${i},'tidak')">✗ Tidak Ada</button>
        <button class="porto-btn belum" onclick="setPorto(${i},'belum')">? Belum Yakin</button>
      </div>
    </div>
  `).join("");
}

function setPorto(idx, val) {
  portoState[idx] = val;
  const item = document.querySelectorAll(".porto-item")[idx];
  item.querySelectorAll(".porto-btn").forEach(b => b.classList.remove("active"));
  item.querySelector(`.porto-btn.${val}`).classList.add("active");
}

function buildReview() {
  const rows = [
    ["Nama Asesi", v("nama_asesi")],
    ["Tempat/Tgl Lahir", v("ttl")],
    ["Jenis Kelamin", document.querySelector('input[name="jk"]:checked')?.value || "-"],
    ["Alamat", v("alamat")],
    ["No. HP", v("no_hp")],
    ["Pendidikan (Lama)", `${v("nama_sekolah")} – ${v("jurusan")} (${v("strata")}) Lulus ${v("tahun_lulus")}`],
    ["Pendidikan Profesi", `${v("prof_institusi")} – ${v("prof_ijazah_terakhir")} (${v("prof_tahun_ijazah")})`],
    ["Lembaga/Jabatan", `${v("nama_lembaga")} – ${v("jabatan")}`],
    ["Jenis/Jenjang Profesi", `${v("prof_jenis")} / ${v("prof_jenjang")}`],
    ["KTA / NIRA", `${v("prof_no_kta")} (Berlaku: ${v("prof_berlaku_kta")})`],
    ["STR", `${v("prof_no_str")} (Berlaku: ${v("prof_berlaku_str")})`],
    ["SIKP / SIKB", `${v("prof_no_sikp")} (Berlaku: ${v("prof_berlaku_sikp")})`],
    ["SPK", `${v("prof_no_spk")} (Berlaku: ${v("prof_berlaku_spk")})`],
    ["Nama Asesor", v("nama_asessor")],
    ["No. Reg Asesor", v("no_reg_asesor") || "-"],
    ["Kode Unit", v("kode_unit") || "-"],
    ["Judul Unit", v("judul_unit")],
    ["Tanggal Asesmen", v("tanggal")],
    ["Waktu / Tempat", `${v("waktu")} / ${v("tempat")}`],
    ["Unit Kerja / Masa Kerja", `${v("prof_unit_kerja")} / ${v("prof_masa_kerja")} Tahun`],
    ["Pelatihan Utama", v("prof_pelatihan")],
    ["Riwayat IKI", v("prof_riwayat_iki")],
  ];
  const table = document.getElementById("reviewTable");
  table.innerHTML = rows.map(([k, val]) => `<tr><td>${k}</td><td>${val}</td></tr>`).join("");
}

async function submitApplication() {
  const btn = document.getElementById("downloadBtn");
  btn.disabled = true;
  btn.classList.add("loading");

  try {
    const fd = new FormData();

    // Step 1: Identitas
    fd.append("nama_asesi", v("nama_asesi"));
    fd.append("ttl", v("ttl"));
    fd.append("jenis_kelamin", document.querySelector('input[name="jk"]:checked')?.value || "");
    fd.append("kebangsaan", v("kebangsaan"));
    fd.append("alamat", v("alamat"));
    fd.append("kode_pos", v("kode_pos"));
    fd.append("no_hp", v("no_hp"));
    fd.append("email", v("email"));
    fd.append("nama_sekolah", v("nama_sekolah"));
    fd.append("jurusan", v("jurusan"));
    fd.append("strata", v("strata"));
    fd.append("tahun_lulus", v("tahun_lulus"));
    fd.append("nama_lembaga", v("nama_lembaga"));
    fd.append("jabatan", v("jabatan"));
    fd.append("alamat_kantor", v("alamat_kantor"));
    fd.append("no_telp_kantor", v("no_telp_kantor"));
    fd.append("email_kantor", v("email_kantor"));

    // Step 2: Asesmen
    fd.append("nama_asessor", v("nama_asessor"));
    fd.append("no_reg_asesor", v("no_reg_asesor"));
    fd.append("kode_unit", v("kode_unit"));
    fd.append("judul_unit", v("judul_unit"));
    fd.append("tanggal", v("tanggal"));
    fd.append("waktu", v("waktu"));
    fd.append("tempat", v("tempat"));

    // Kompetensi
    fd.append("data_kompetensi", JSON.stringify(getCompData()));

    // Consent & Umpan Balik
    fd.append("consent", JSON.stringify(consentState.map(x => x !== false)));
    fd.append("umpan_balik", JSON.stringify(umpanState.map(x => x !== false)));
    fd.append("portofolio", JSON.stringify(portoState));

    // Step 5: Profesi
    fd.append("prof_unit_kerja", v("prof_unit_kerja"));
    fd.append("prof_pendidikan", v("prof_ijazah_terakhir"));
    fd.append("pelatihan", JSON.stringify(getTableData('tablePelatihan')));
    fd.append("iki", JSON.stringify(getTableData('tableIKI')));
    fd.append("asesmen_history", JSON.stringify(getTableData('tableAsesmen')));

    // Step 6: Dokumen
    const fileFields = ['file_ijazah', 'file_transkrip', 'file_str', 'file_praktik', 'file_sertifikat', 'file_logbook', 'file_form'];
    fileFields.forEach(f => {
      const input = document.getElementById('input_' + f);
      if (input && input.files[0]) fd.append(f, input.files[0]);
    });

    const res = await fetch("{{ route('generate') }}", {
      method: "POST",
      headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
      body: fd,
    });

    const result = await res.json();
    if (!res.ok) throw new Error(result.error || "Gagal mengirim pengajuan");

    showToast("✅ Pengajuan berhasil dikirim!");
    setTimeout(() => { window.location.href = "{{ route('dashboard') }}"; }, 1500);

  } catch (err) {
    showToast("❌ " + err.message, true);
    console.error("Submit error:", err);
  } finally {
    btn.classList.remove("loading");
    btn.disabled = false;
  }
}

let toastTimer;
function showToast(msg, isError = false) {
  const t = document.getElementById("toast");
  t.textContent = msg;
  t.className = "toast" + (isError ? " error" : "");
  t.classList.add("show");
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => t.classList.remove("show"), 3500);
}

init();
</script>
</body>
</html>
