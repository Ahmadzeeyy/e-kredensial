<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 09 - Meninjau Proses Asesmen</title>
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
        
        .explanation { background: #fffbeb; border-left: 4px solid #f59e0b; padding: 15px; margin-bottom: 20px; font-size: 13.5px; color: #92400e; border-radius: 0 8px 8px 0; }
        .explanation strong { font-weight: 700; display: block; margin-bottom: 8px; }
        .explanation ol { margin-left: 20px; margin-top: 5px; }
        .explanation li { margin-bottom: 4px; }

        table { width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 1rem; border-radius: 12px; overflow: hidden; border: 1px solid var(--border-color); margin-bottom: 2rem; }
        th { background: #f8fafc; padding: 14px; text-align: center; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border-color); }
        td { padding: 12px 14px; border-bottom: 1px solid #f1f5f9; font-size: 13.5px; background: white; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fdfdfd; }
        .row-header { font-weight: 700; background: #f8fafc; color: var(--primary); text-align: left; }
        
        .checkbox-cell { text-align: center; }
        .checkbox-cell input { width: 18px; height: 18px; accent-color: var(--primary); cursor: pointer; }
        
        input[type="text"], textarea, select { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 13.5px; transition: all 0.2s; outline: none; background: #fcfcfc; }
        input[type="text"]:focus, textarea:focus, select:focus { border-color: var(--secondary); background: white; box-shadow: 0 0 0 3px rgba(59,157,232,0.1); }
        
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
                <!-- Title based on user image -->
                <h1>FORM-08 : Umpan Balik dan Catatan Asesmen Kompetensi</h1>
                <p style="font-size: 13px; color: #64748b; margin-top: 4px;">(Pada standar BNSP sering disebut FR.AK.06 / Meninjau Proses Asesmen)</p>
            </div>
            <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        <form action="{{ route('admin.form9.store', $kredensial->id) }}" method="POST" style="padding-bottom: 80px;">
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
                    <div style="grid-column: span 3;">: {{ $kredensial->data_lengkap['judul_unit'] ?? 'Memberikan Asuhan Keperawatan' }}</div>
                </div>

                <div class="explanation">
                    <strong>Penjelasan:</strong>
                    <ol>
                        <li>Kaji ulang sebaiknya dilakukan oleh Asesor yang melakukan supervisi terhadap pelaksanaan asesmen.</li>
                        <li>Bila dilakukan oleh asesor pelaksana asesmen, maka dilakukan setelah selesai seluruh proses asesmen.</li>
                    </ol>
                </div>

                @php
                    $saved = $kredensial->data_form9 ?? [];
                    
                    $aspects = [
                        'perencanaan' => 'Perencanaan asesmen',
                        'pra_asesmen' => 'Pra asesmen',
                        'pelaksanaan' => 'Pelaksanaan asesmen',
                        'keputusan' => 'Keputusan asesmen',
                        'umpan_balik' => 'Umpan balik asesmen',
                        'pencatatan' => 'Pencatatan asesmen'
                    ];
                    
                    $principles = ['valid' => 'Valid', 'reliable' => 'Reliable', 'flexible' => 'Flexible', 'fair' => 'Fair'];
                @endphp

                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 40%; text-align: left;">Aspek yang dikaji Ulang</th>
                            <th colspan="4">Pemenuhan terhadap Prinsip-prinsip</th>
                        </tr>
                        <tr>
                            @foreach($principles as $pkey => $plabel)
                                <th style="width: 15%; font-style: italic;">{{ $plabel }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="5" class="row-header">Prosedur Asesmen:</td>
                        </tr>
                        @foreach($aspects as $key => $label)
                        <tr>
                            <td>- {{ $label }}</td>
                            @foreach($principles as $pkey => $plabel)
                                @php
                                    $isChecked = isset($saved['aspek'][$key][$pkey]) && $saved['aspek'][$key][$pkey] == '1';
                                @endphp
                                <td class="checkbox-cell">
                                    <input type="checkbox" name="form9[aspek][{{ $key }}][{{ $pkey }}]" value="1" {{ $isChecked ? 'checked' : '' }}>
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="margin-top: 2rem;">
                    <label style="font-weight: 700; display: block; margin-bottom: 10px; color: #1e293b;">Rekomendasi perbaikan :</label>
                    <textarea name="form9[rekomendasi]" rows="4" placeholder="Tuliskan rekomendasi perbaikan untuk proses asesmen berikutnya...">{{ $saved['rekomendasi'] ?? '' }}</textarea>
                </div>
            </div>

            <div class="footer">
                <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary" style="background: #f1f5f9; border: 1px solid #cbd5e1; color: #475569;">Batal</a>
                <button type="submit" name="action" value="simpan" class="btn btn-secondary" style="background: #1e293b; color: white; border: none; flex: 1;">💾 Simpan Draft Form 9</button>
            </div>
        </form>
    </div>
</body>
</html>
