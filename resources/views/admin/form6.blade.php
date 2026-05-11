<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 6 - Meninjau Proses Asesmen</title>
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
        
        .info-grid { display: grid; grid-template-columns: auto 1fr auto 1fr; gap: 10px 20px; margin-bottom: 20px; font-size: 14px; }
        .info-label { font-weight: 600; color: #64748b; }
        
        table { width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 1rem; border-radius: 12px; overflow: hidden; border: 1px solid var(--border-color); }
        th { background: #f8fafc; padding: 14px; text-align: left; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border-color); }
        td { padding: 12px 14px; border-bottom: 1px solid #f1f5f9; font-size: 13.5px; background: white; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fdfdfd; }
        
        input[type="text"], textarea, select { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 13.5px; transition: all 0.2s; outline: none; background: #fcfcfc; }
        input[type="text"]:focus, textarea:focus, select:focus { border-color: var(--secondary); background: white; box-shadow: 0 0 0 3px rgba(59,157,232,0.1); }
        
        .btn { padding: 0.7rem 1.4rem; border-radius: 10px; font-weight: 600; cursor: pointer; border: none; font-size: 13.5px; text-decoration: none; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; }
        .btn-primary { background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white; box-shadow: 0 4px 12px rgba(26,95,168,0.25); }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(26,95,168,0.35); }
        .btn-secondary { background: white; border: 1.5px solid #cbd5e1; color: #475569; }
        .btn-secondary:hover { background: #f8fafc; border-color: #94a3b8; }
        
        .footer { position: fixed; bottom: 0; left: 0; right: 0; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); padding: 1rem 2rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 1rem; z-index: 100; box-shadow: 0 -4px 20px rgba(0,0,0,0.02); }
        
        /* Custom */
        .radio-group { display: flex; justify-content: center; align-items: center; }
        .radio-group input { width: 18px; height: 18px; cursor: pointer; accent-color: var(--primary); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>FORM-06: Meninjau Proses Asesmen</h1>
                <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Kaji ulang dan persetujuan terhadap prosedur asesmen.</p>
            </div>
            <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        <form action="{{ route('admin.form6.store', $kredensial->id) }}" method="POST" style="padding-bottom: 80px;">
            @csrf
            <div class="card">
                <div class="info-grid">
                    <div class="info-label">Nama Asesi</div>
                    <div>: {{ $kredensial->nama_asesi }}</div>
                    <div class="info-label">Tanggal</div>
                    <div>: {{ \Carbon\Carbon::parse($kredensial->created_at)->format('d F Y') }}</div>
                    
                    <div class="info-label">Nama Asessor</div>
                    <div>: {{ auth()->user()->name }}</div>
                    <div class="info-label">Waktu</div>
                    <div>: {{ \Carbon\Carbon::parse($kredensial->created_at)->format('H:i') }} WIB</div>
                    
                    <div class="info-label">Kode Unit</div>
                    <div>: {{ $kredensial->data_lengkap['kode_unit'] ?? '-' }}</div>
                    <div class="info-label">Tempat</div>
                    <div>: RSUD dr. M. Soewandhie</div>
                    
                    <div class="info-label">Judul Unit</div>
                    <div>: {{ $kredensial->data_lengkap['judul_unit'] ?? '-' }}</div>
                    <div></div><div></div>
                </div>

                @php
                    $saved = $kredensial->data_form6 ?? [];
                    
                    $rows = [
                        ['id' => '1_1', 'langkah' => '1. Pembukaan', 'kegiatan' => 'Memberikan salam', 'catatan' => ''],
                        ['id' => '1_2', 'langkah' => '', 'kegiatan' => 'Menempatkan kandidat', 'catatan' => ''],
                        ['id' => '1_3', 'langkah' => '', 'kegiatan' => 'Menjelaskan ulang dan', 'catatan' => ''],
                        ['id' => '2_1', 'langkah' => '2. Mengkonfirmasikan Rencana asesmen', 'kegiatan' => 'Pendekatan asesmen', 'catatan' => ''],
                        ['id' => '2_2', 'langkah' => '', 'kegiatan' => 'Detail rencana asesmen di', 'catatan' => 'FORM-03'],
                        ['id' => '2_3', 'langkah' => '', 'kegiatan' => '- Menilai kesesuaian bukti-', 'catatan' => '', 'indent' => 1],
                        ['id' => '2_4', 'langkah' => '', 'kegiatan' => '- Metoda asesmen yang', 'catatan' => '', 'indent' => 1],
                        ['id' => '2_5', 'langkah' => '', 'kegiatan' => '- Menilai kesesuaian bukti-', 'catatan' => '', 'indent' => 1],
                        ['id' => '2_6', 'langkah' => '', 'kegiatan' => '- Menilai kesesuaian bukti-', 'catatan' => '', 'indent' => 1],
                        ['id' => '2_7', 'langkah' => '', 'kegiatan' => '- Perangkat Asesmen', 'catatan' => '', 'indent' => 1],
                        ['id' => '2_8', 'langkah' => '', 'kegiatan' => '- Sumber daya asesmen', 'catatan' => '', 'indent' => 1, 'nocheck' => true],
                        ['id' => '2_9', 'langkah' => '', 'kegiatan' => 'Sumber daya fisik', 'catatan' => '', 'indent' => 2],
                        ['id' => '2_10', 'langkah' => '', 'kegiatan' => 'personil yang', 'catatan' => '', 'indent' => 2],
                        ['id' => '2_11', 'langkah' => '', 'kegiatan' => 'Penyesuaian yang', 'catatan' => '', 'indent' => 2],
                        ['id' => '2_12', 'langkah' => '', 'kegiatan' => 'PemenuhanPrinsipas', 'catatan' => '', 'indent' => 2],
                        ['id' => '2_13', 'langkah' => '', 'kegiatan' => 'kebijakan dan prosedure', 'catatan' => ''],
                        ['id' => '2_14', 'langkah' => '', 'kegiatan' => 'Proses asesmen ulang dan', 'catatan' => ''],
                        ['id' => '2_15', 'langkah' => '', 'kegiatan' => 'Mengorganisasikan sumber', 'catatan' => ''],
                        ['id' => '2_16', 'langkah' => '', 'kegiatan' => 'Menandatangani', 'catatan' => 'FORM - 04'],
                        ['id' => '3_1', 'langkah' => '3. Mengumpulkan bukti berkualitas', 'kegiatan' => 'Menginformasikan personil', 'catatan' => 'FORM-03 A'],
                        ['id' => '3_2', 'langkah' => '', 'kegiatan' => 'Menggunakan metoda yang', 'catatan' => 'FORM-03 B'],
                        ['id' => '3_3', 'langkah' => '', 'kegiatan' => 'Penerapan prinsip asesmen', 'catatan' => 'FORM-03 C'],
                        ['id' => '3_4', 'langkah' => '', 'kegiatan' => 'Penerapan aturan', 'catatan' => 'FORM-03 D'],
                        ['id' => '3_5', 'langkah' => '', 'kegiatan' => 'Pengumpulan bukti pada', 'catatan' => ''],
                        ['id' => '4_1', 'langkah' => '4. Keputusan asesmen', 'kegiatan' => 'Membuat keputusan sesuai', 'catatan' => 'FORM 07'],
                        ['id' => '4_2', 'langkah' => '', 'kegiatan' => 'Membuat keputusan sesuai', 'catatan' => 'FORM 08'],
                        ['id' => '4_3', 'langkah' => '', 'kegiatan' => 'Memberikan feedback yang', 'catatan' => ''],
                        ['id' => '4_4', 'langkah' => '', 'kegiatan' => 'Menandatangani keputusan', 'catatan' => ''],
                        ['id' => '5_1', 'langkah' => '5. Mencatat dan melaporkan keputusan asesmen', 'kegiatan' => 'Mencatat hasil asesmen', 'catatan' => ''],
                        ['id' => '5_2', 'langkah' => '', 'kegiatan' => 'Membuat rekomendasi', 'catatan' => ''],
                        ['id' => '5_3', 'langkah' => '', 'kegiatan' => 'Menginformasikan kepada', 'catatan' => ''],
                        ['id' => '6_1', 'langkah' => '6. Meninjau Proses', 'kegiatan' => 'Meninjau proses asesmen', 'catatan' => 'FORM - 09'],
                        ['id' => '7_1', 'langkah' => '7. Penutupan', 'kegiatan' => 'Menutup pertemuan', 'catatan' => ''],
                        ['id' => '7_2', 'langkah' => '', 'kegiatan' => 'Memberikan salam', 'catatan' => ''],
                    ];
                @endphp

                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 25%;">Langkah</th>
                            <th rowspan="2" style="width: 35%;">Kegiatan</th>
                            <th colspan="2">Pencapaian</th>
                            <th rowspan="2" style="width: 20%;">Catatan</th>
                        </tr>
                        <tr>
                            <th style="width: 10%;">Ya</th>
                            <th style="width: 10%;">Tidak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $r)
                        @php
                            $margin = isset($r['indent']) ? ($r['indent'] * 20) . 'px' : '0';
                            $prefix = isset($r['indent']) && $r['indent'] == 2 ? '■ ' : '';
                            $val = $saved[$r['id']]['val'] ?? '';
                            $cat = $saved[$r['id']]['catatan'] ?? $r['catatan'];
                        @endphp
                        <tr>
                            <td>{{ $r['langkah'] }}</td>
                            <td style="padding-left: calc(12px + {{ $margin }});">
                                {{ $prefix }}{{ $r['kegiatan'] }}
                            </td>
                            @if(isset($r['nocheck']) && $r['nocheck'])
                                <td colspan="2" class="bg-light-green"></td>
                            @else
                                <td class="bg-light-green">
                                    <div class="radio-group">
                                        <input type="radio" name="form6[{{ $r['id'] }}][val]" value="ya" {{ $val == 'ya' ? 'checked' : '' }}>
                                    </div>
                                </td>
                                <td class="bg-light-green">
                                    <div class="radio-group">
                                        <input type="radio" name="form6[{{ $r['id'] }}][val]" value="tidak" {{ $val == 'tidak' ? 'checked' : '' }}>
                                    </div>
                                </td>
                            @endif
                            <td>
                                @if(isset($r['nocheck']) && $r['nocheck'])
                                    <!-- Empty -->
                                @else
                                    <input type="text" name="form6[{{ $r['id'] }}][catatan]" value="{{ $cat }}" placeholder="{{ $r['catatan'] }}">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="footer">
                <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary" style="background: #f1f5f9; border: 1px solid #cbd5e1; color: #475569;">Batal</a>
                <button type="submit" name="action" value="simpan" class="btn btn-secondary" style="background: #1e293b; color: white; border: none; flex: 1;">💾 Simpan Draft Form 6</button>
            </div>
        </form>
    </div>
</body>
</html>
