<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 05 - Daftar Cek Konsultasi Pra Asesmen</title>
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
        .container { max-width: 1100px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; background: white; padding: 1.5rem 2rem; border-radius: 16px; box-shadow: 0 4px 24px rgba(13,43,85,0.05); }
        h1 { font-size: 1.4rem; font-weight: 700; color: var(--primary); letter-spacing: -0.02em; }
        
        .card { background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 24px rgba(13,43,85,0.05); border: 1px solid rgba(255,255,255,0.5); margin-bottom: 1.5rem; }
        
        .info-grid { display: grid; grid-template-columns: auto 1fr auto 1fr; gap: 12px 24px; margin-bottom: 30px; font-size: 13.5px; background: #f8fafc; padding: 1.5rem; border-radius: 12px; border: 1px solid #f1f5f9; }
        .info-label { font-weight: 600; color: var(--text-muted); }
        
        table { width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 1rem; border-radius: 12px; overflow: hidden; border: 1px solid var(--border-color); margin-bottom: 2rem; }
        th { background: #bbf7d0; padding: 14px; text-align: center; font-size: 12px; font-weight: 800; color: #166534; border-bottom: 1px solid var(--border-color); border-right: 1px solid rgba(0,0,0,0.05); }
        th:last-child { border-right: none; }
        td { padding: 12px 14px; border-bottom: 1px solid #f1f5f9; border-right: 1px solid #f1f5f9; font-size: 13.5px; background: white; vertical-align: middle; line-height: 1.5; }
        td:last-child { border-right: none; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fdfdfd; }
        
        .col-no { width: 40px; text-align: center; font-weight: 700; color: var(--text-muted); }
        .col-langkah { width: 180px; font-weight: 600; color: #334155; }
        
        .radio-group { display: flex; justify-content: center; align-items: center; }
        .radio-group input { cursor: pointer; width: 18px; height: 18px; }
        .radio-ya { accent-color: #10B981 !important; }
        .radio-tdk { accent-color: #EF4444 !important; }
        
        input[type="text"] { width: 100%; padding: 8px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 13px; transition: all 0.2s; outline: none; background: #f8fafc; }
        input[type="text"]:focus { border-color: var(--secondary); background: white; box-shadow: 0 0 0 3px rgba(59,157,232,0.1); }
        
        .btn { padding: 0.7rem 1.4rem; border-radius: 10px; font-weight: 600; cursor: pointer; border: none; font-size: 13.5px; text-decoration: none; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; }
        .btn-primary { background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white; box-shadow: 0 4px 12px rgba(26,95,168,0.25); }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(26,95,168,0.35); }
        .btn-secondary { background: white; border: 1.5px solid #cbd5e1; color: #475569; }
        .btn-secondary:hover { background: #f8fafc; border-color: #94a3b8; }
        
        .footer { position: fixed; bottom: 0; left: 0; right: 0; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); padding: 1rem 2rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 1rem; z-index: 100; box-shadow: 0 -4px 20px rgba(0,0,0,0.02); }
        
        .sign-area { display: flex; justify-content: space-between; margin-top: 3rem; padding: 0 4rem; text-align: center; }
        .sign-box { display: flex; flex-direction: column; align-items: center; gap: 4rem; font-weight: 700; color: #334155; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>FORM-05: DAFTAR CEK KONSULTASI PRA ASESMEN</h1>
                <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Instrumen pemeriksaan dan verifikasi pra asesmen.</p>
            </div>
            <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        <form action="{{ route('admin.form5.store', $kredensial->id) }}" method="POST" style="padding-bottom: 80px;">
            @csrf
            <div class="card">
                <div class="info-grid">
                    <div class="info-label">Nama Asesi</div>
                    <div>: {{ $kredensial->nama_asesi }}</div>
                    <div class="info-label">Tanggal</div>
                    <div>: {{ \Carbon\Carbon::now()->format('d F Y') }}</div>
                    
                    <div class="info-label">Nama Asessor</div>
                    <div>: {{ auth()->user()->name }}</div>
                    <div class="info-label">Waktu</div>
                    <div>: {{ \Carbon\Carbon::now()->format('H:i') }} WIB</div>
                    
                    <div class="info-label">Kode Unit</div>
                    <div>: {{ $kredensial->data_lengkap['kode_unit'] ?? '-' }}</div>
                    <div class="info-label">Tempat</div>
                    <div>: RSUD dr. M. Soewandhie Surabaya</div>
                    
                    <div class="info-label">Judul Unit</div>
                    <div style="grid-column: span 3;">: {{ $kredensial->data_lengkap['judul_unit'] ?? 'Memberikan Asuhan Keperawatan Sederhana pada Pasien' }}</div>
                </div>

                @php
                    $saved = $kredensial->data_form5 ?? [];
                    // Ensure we handle old data gracefully if it doesn't match new format
                    if(isset($saved[0]) && isset($saved[0]['q'])) {
                        $saved = []; // clear old incompatible data
                    }

                    $steps = [
                        [
                            'no' => 1,
                            'langkah' => 'Pembukaan',
                            'kegiatan' => [
                                ['id' => '1_1', 'text' => 'Memberikan salam dan memperkenalkan diri', 'cat' => ''],
                                ['id' => '1_2', 'text' => 'Menempatkan assesi dalam kondisi yang kondusif', 'cat' => ''],
                                ['id' => '1_3', 'text' => 'Menjelaskan dan mendiskusikan tujuan konsultasi pra asesmen', 'cat' => ''],
                            ]
                        ],
                        [
                            'no' => 2,
                            'langkah' => 'Penjelasan asesmen',
                            'kegiatan' => [
                                ['id' => '2_1', 'text' => 'Menjelaskan proses dan hasil asesmen, termasuk SKKNI/Unit Kompetensi dan proses banding', 'cat' => '']
                            ]
                        ],
                        [
                            'no' => 3,
                            'langkah' => 'Mengkonfirmasikan tujuan asesmen',
                            'kegiatan' => [
                                ['id' => '3_1', 'text' => 'Mengkonfirmasikan tujuan asesmen kepada assesi.', 'cat' => '']
                            ]
                        ],
                        [
                            'no' => 4,
                            'langkah' => 'Menilai kesesuaian bukti-bukti pendukung (persyaratan sertiifikasi)',
                            'kegiatan' => [
                                ['id' => '4_1', 'text' => 'Bukti Tidak Langsung dipadankan dengan kesesuaian', 'cat' => 'FORM-01'],
                                ['id' => '4_2', 'text' => 'Merekomendasikan keikutsertaan asesmen lanjut', 'cat' => ''],
                                ['id' => '4_3', 'text' => 'Hasil asesmen (K/BK) yang telah diisi oleh asesi dan', 'cat' => 'FORM-02'],
                                ['id' => '4_4', 'text' => 'Merekomendasikan keikutsertaan asesmen lanjut (gunakan form 02 penilaian mandiri kolom rekomendasi dan catatan)', 'cat' => 'FORM-02'],
                            ]
                        ],
                        [
                            'no' => 5,
                            'langkah' => 'Membangun metode dan perangkat asesmen',
                            'kegiatan' => [
                                ['id' => '5_1', 'text' => 'Menjelaskan bukti dan jenis bukti', 'cat' => 'FORM-03'],
                                ['id' => '5_2', 'text' => 'Mengidentifikasi dan menetapkan penyesuaian yang diperlukan (jika ada)', 'cat' => ''],
                            ]
                        ],
                        [
                            'no' => 6,
                            'langkah' => '',
                            'kegiatan' => [
                                ['id' => '6_1', 'text' => 'Menjelaskan hal-hal yang terkait dengan tata tertib asesmen, aturan-aturan', 'cat' => '']
                            ]
                        ],
                        [
                            'no' => 7,
                            'langkah' => '',
                            'kegiatan' => [
                                ['id' => '7_1', 'text' => 'Mengkonfirmasikan jadwal asesmen (Tanggal dan waktu/durasi penilaian )', 'cat' => '']
                            ]
                        ],
                        [
                            'no' => 8,
                            'langkah' => '',
                            'kegiatan' => [
                                ['id' => '8_1', 'text' => 'Menandatangani rencana asesmen', 'cat' => 'FORM-03']
                            ]
                        ],
                        [
                            'no' => 9,
                            'langkah' => '',
                            'kegiatan' => [
                                ['id' => '9_1', 'text' => 'Menutup konsultasi pra asesmen dan memberikan salam', 'cat' => '']
                            ]
                        ],
                    ];
                @endphp

                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" colspan="2" style="width: 25%;">Langkah</th>
                            <th rowspan="2" style="width: 45%;">Kegiatan</th>
                            <th colspan="2" style="width: 15%;">Pencapaian</th>
                            <th rowspan="2" style="width: 15%;">Catatan</th>
                        </tr>
                        <tr>
                            <th style="background: #dcfce7;">Ya</th>
                            <th style="background: #fee2e2; color: #991b1b;">Tidak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($steps as $s)
                            @php $rowspan = count($s['kegiatan']); @endphp
                            @foreach($s['kegiatan'] as $i => $keg)
                                @php
                                    $id = $keg['id'];
                                    $resYaTdk = $saved[$id]['pencapaian'] ?? '';
                                    $catatan = $saved[$id]['catatan'] ?? $keg['cat'];
                                @endphp
                                <tr>
                                    @if($i == 0)
                                        @if($s['langkah'] !== '')
                                            <td class="col-no" rowspan="{{ $rowspan }}">{{ $s['no'] }}</td>
                                            <td class="col-langkah" rowspan="{{ $rowspan }}">{{ $s['langkah'] }}</td>
                                        @else
                                            <td class="col-no">{{ $s['no'] }}</td>
                                            <td class="col-langkah"></td>
                                        @endif
                                    @endif
                                    
                                    <td>{{ $keg['text'] }}</td>
                                    <td>
                                        <div class="radio-group">
                                            <input type="radio" class="radio-ya" name="form5[{{ $id }}][pencapaian]" value="Ya" {{ $resYaTdk == 'Ya' ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio-group">
                                            <input type="radio" class="radio-tdk" name="form5[{{ $id }}][pencapaian]" value="Tidak" {{ $resYaTdk == 'Tidak' ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="text" name="form5[{{ $id }}][catatan]" value="{{ $catatan }}">
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

                <div class="sign-area">
                    <div class="sign-box">
                        <div>Asesi</div>
                        <div style="font-weight: 500;">{{ $kredensial->nama_asesi }}</div>
                    </div>
                    <div class="sign-box">
                        <div style="font-weight: 400; color: #64748b; font-size: 13px;">Surabaya, {{ \Carbon\Carbon::now()->format('d F Y') }}</div>
                        <div>Asesor</div>
                        <div style="font-weight: 500;">{{ auth()->user()->name }}</div>
                    </div>
                </div>
            </div>

            <div class="footer">
                <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary" style="background: #f1f5f9; border: 1px solid #cbd5e1; color: #475569;">Batal</a>
                <button type="submit" name="action" value="simpan" class="btn btn-secondary" style="background: #1e293b; color: white; border: none; flex: 1;">💾 Simpan Draft Form 5</button>
            </div>
        </form>
    </div>
</body>
</html>
