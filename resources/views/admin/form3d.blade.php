<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 3D - Instrumen Evaluasi Bukti Portofolio</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        :root {
            --primary: #1a5fa8;
            --secondary: #3b9de8;
            --bg-color: #f0f6ff;
            --card-bg: #FFFFFF;
            --border-color: #e2e8f0;
            --text-main: #1e293b;
            --text-muted: #64748b;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: linear-gradient(135deg, #e8f0fc 0%, #f0f9ff 50%, #e8f4f0 100%); color: var(--text-main); padding: 2rem 2rem 6rem; min-height: 100vh; }
        .container { max-width: 900px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; background: white; padding: 1.5rem 2rem; border-radius: 16px; box-shadow: 0 4px 24px rgba(13,43,85,0.05); }
        h1 { font-size: 1.4rem; font-weight: 700; color: var(--primary); letter-spacing: -0.02em; }
        
        .card { background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 24px rgba(13,43,85,0.05); border: 1px solid rgba(255,255,255,0.5); margin-bottom: 1.5rem; }
        
        .info-grid { display: grid; grid-template-columns: auto 1fr auto 1fr; gap: 12px 24px; margin-bottom: 30px; font-size: 13.5px; background: #f8fafc; padding: 1.5rem; border-radius: 12px; border: 1px solid #f1f5f9; }
        .info-label { font-weight: 600; color: var(--text-muted); }
        
        table { width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 1rem; border-radius: 12px; overflow: hidden; border: 1px solid var(--border-color); margin-bottom: 2rem; }
        th { background: #06b6d4; padding: 14px; text-align: center; font-size: 13px; font-weight: 800; color: white; text-transform: uppercase; letter-spacing: 0.05em; border-right: 1px solid rgba(255,255,255,0.2); }
        th:last-child { border-right: none; }
        td { padding: 12px 14px; border-bottom: 1px solid #f1f5f9; border-right: 1px solid #f1f5f9; font-size: 13.5px; background: white; vertical-align: middle; line-height: 1.5; text-align: center; }
        td:nth-child(2) { text-align: left; font-weight: 600; color: #334155; }
        td:last-child { border-right: none; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #f8fafc; }
        
        .radio-group { display: flex; justify-content: center; align-items: center; }
        .radio-group input { cursor: pointer; width: 20px; height: 20px; }
        .radio-ya { accent-color: #10B981 !important; }
        .radio-tdk { accent-color: #EF4444 !important; }
        .radio-by { accent-color: #f59e0b !important; }
        
        .btn { padding: 0.7rem 1.4rem; border-radius: 10px; font-weight: 600; cursor: pointer; border: none; font-size: 13.5px; text-decoration: none; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; }
        .btn-primary { background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white; box-shadow: 0 4px 12px rgba(26,95,168,0.25); }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(26,95,168,0.35); }
        .btn-secondary { background: white; border: 1.5px solid #cbd5e1; color: #475569; }
        .btn-secondary:hover { background: #f8fafc; border-color: #94a3b8; }
        
        .footer { position: fixed; bottom: 0; left: 0; right: 0; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); padding: 1rem 2rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 1rem; z-index: 100; box-shadow: 0 -4px 20px rgba(0,0,0,0.02); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>FORM-03 D: Instrumen Evaluasi Bukti Portofolio</h1>
                <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Pengecekan kelengkapan dan validitas dokumen bukti portofolio asesi.</p>
            </div>
            <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        <form action="{{ route('admin.form3d.store', $kredensial->id) }}" method="POST" style="padding-bottom: 80px;">
            @csrf
            <div class="card">
                <div class="info-grid">
                    <div class="info-label">Nama</div>
                    <div>: {{ $kredensial->nama_asesi }}</div>
                    <div class="info-label">Tanggal/waktu</div>
                    <div>: {{ \Carbon\Carbon::now()->format('d F Y H:i') }} WIB</div>
                    
                    <div class="info-label">Nama Asessor</div>
                    <div>: {{ auth()->user()->name }}</div>
                    <div class="info-label">Tempat</div>
                    <div>: RSUD dr. M. Soewandhie Surabaya</div>
                </div>

                @php
                    $saved = $kredensial->data_form3d ?? [];
                    if (empty($saved)) {
                        $saved = [
                            ['dokumen' => 'ASKEP', 'hasil' => ''],
                            ['dokumen' => 'LOG BOOK', 'hasil' => ''],
                            ['dokumen' => 'SERTIFIKAT PELATIHAN DASAR', 'hasil' => ''],
                            ['dokumen' => 'SERTIFIKAT PELATIHAN', 'hasil' => ''],
                            ['dokumen' => 'SERTIFIKAT PENINGKATAN KOMPETENSI', 'hasil' => ''],
                            ['dokumen' => 'DISKUSI REFLEKSI KASUS', 'hasil' => ''],
                            ['dokumen' => 'IJASAH DAN TRANSKIP', 'hasil' => ''],
                        ];
                    }
                @endphp

                <table>
                    <thead>
                        <tr>
                            <th style="width: 10%;">NO</th>
                            <th style="width: 45%; text-align: left;">DOKUMEN</th>
                            <th style="width: 15%;">Ya</th>
                            <th style="width: 15%;">Tidak</th>
                            <th style="width: 15%;">Belum Yakin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($saved as $index => $row)
                        <tr>
                            <td style="font-weight: 700; color: #94a3b8;">{{ $index + 1 }}</td>
                            <td>
                                {{ $row['dokumen'] }}
                                <input type="hidden" name="form3d[{{ $index }}][dokumen]" value="{{ $row['dokumen'] }}">
                            </td>
                            <td>
                                <div class="radio-group">
                                    <input type="radio" class="radio-ya" name="form3d[{{ $index }}][hasil]" value="Ya" {{ ($row['hasil'] ?? '') == 'Ya' ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <input type="radio" class="radio-tdk" name="form3d[{{ $index }}][hasil]" value="Tidak" {{ ($row['hasil'] ?? '') == 'Tidak' ? 'checked' : '' }}>
                                </div>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <input type="radio" class="radio-by" name="form3d[{{ $index }}][hasil]" value="Belum Yakin" {{ ($row['hasil'] ?? '') == 'Belum Yakin' ? 'checked' : '' }}>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="footer">
                <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary" style="background: #f1f5f9; border: 1px solid #cbd5e1; color: #475569;">Batal</a>
                <button type="submit" name="action" value="simpan" class="btn btn-secondary" style="background: #1e293b; color: white; border: none; flex: 1;">💾 Simpan Draft Form 3D</button>
            </div>
        </form>
    </div>
</body>
</html>
