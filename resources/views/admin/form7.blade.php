<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 7 - Pengumpulan Bukti & Pengambilan Keputusan</title>
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
        th { background: #f8fafc; padding: 14px; text-align: center; font-size: 12px; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border-color); }
        th.col-k { color: #10B981; }
        th.col-bk { color: #EF4444; }
        th.col-pl { color: #F59E0B; }
        td { padding: 12px 14px; border-bottom: 1px solid #f1f5f9; font-size: 13.5px; background: white; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fdfdfd; }
        
        .section-title { font-weight: 700; background: #f8fafc; color: var(--primary); text-align: left; }
        .sub-title { font-weight: 600; background: #fcfcfc; color: #334155; padding-left: 14px !important; }
        
        /* Typography Neatness */
        td { padding: 12px 14px; border-bottom: 1px solid #f1f5f9; font-size: 13.5px; background: white; vertical-align: top; line-height: 1.5; }
        
        .list-container { display: flex; gap: 8px; color: #334155; }
        .list-num { flex-shrink: 0; min-width: 18px; font-weight: 500; text-align: right; color: var(--text-muted); }
        .list-text { flex-grow: 1; }
        
        .sub-list-container { display: flex; gap: 8px; color: #475569; padding-left: 14px; }
        
        .radio-group { display: flex; justify-content: center; align-items: flex-start; padding-top: 2px; }
        .radio-group input { cursor: pointer; width: 18px; height: 18px; }
        .radio-k { accent-color: #10B981 !important; }
        .radio-bk { accent-color: #EF4444 !important; }
        .radio-pl { accent-color: #F59E0B !important; }
        
        input[type="text"], textarea, select { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 13.5px; transition: all 0.2s; outline: none; background: #fcfcfc; }
        input[type="text"]:focus, textarea:focus, select:focus { border-color: var(--secondary); background: white; box-shadow: 0 0 0 3px rgba(59,157,232,0.1); }
        
        .btn { padding: 0.7rem 1.4rem; border-radius: 10px; font-weight: 600; cursor: pointer; border: none; font-size: 13.5px; text-decoration: none; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; }
        .btn-primary { background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white; box-shadow: 0 4px 12px rgba(26,95,168,0.25); }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(26,95,168,0.35); }
        .btn-secondary { background: white; border: 1.5px solid #cbd5e1; color: #475569; }
        .btn-secondary:hover { background: #f8fafc; border-color: #94a3b8; }
        
        .footer { position: fixed; bottom: 0; left: 0; right: 0; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); padding: 1rem 2rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 1rem; z-index: 100; box-shadow: 0 -4px 20px rgba(0,0,0,0.02); }
        
        .recommendation-box { background: #f8fafc; border: 1px solid #f1f5f9; padding: 2rem; border-radius: 16px; margin-top: 2rem; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>FORM-07: Pengumpulan Bukti & Keputusan</h1>
                <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Penilaian akhir kompetensi dan rekomendasi asesi.</p>
            </div>
            <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        <form action="{{ route('admin.form7.store', $kredensial->id) }}" method="POST" style="padding-bottom: 80px;">
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
                    
                    <div class="info-label">Unit</div>
                    <div style="grid-column: span 3;">: {{ $kredensial->data_lengkap['judul_unit'] ?? 'Memberikan Asuhan Keperawatan' }}</div>
                </div>

                @php
                    $saved = $kredensial->data_form7 ?? [];
                    $list = $competencyList;
                    
                    // Separate Table 1 and Table 2 (KOMPETENSI TAMBAHAN)
                    $table2 = $list['KOMPETENSI TAMBAHAN (TABEL BAWAH)'] ?? [];
                    unset($list['KOMPETENSI TAMBAHAN (TABEL BAWAH)']);
                    $mainList = $list;
                    
                    $mainNo = 1;
                @endphp

                <!-- TABLE 1 -->
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 5%;">NO</th>
                            <th rowspan="2" style="width: 65%; text-align: left;">KOMPETENSI KEPERAWATAN UMUM</th>
                            <th colspan="3" style="width: 30%;">KEPUTUSAN</th>
                        </tr>
                        <tr>
                            <th style="width: 10%; color: var(--k-color);">K</th>
                            <th style="width: 10%; color: var(--bk-color);">BK</th>
                            <th style="width: 10%; color: var(--pl-color);">PL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mainList as $catKey => $catItems)
                            <tr>
                                <td class="section-title" style="text-align: center; vertical-align: middle;">{{ $mainNo++ }}</td>
                                <td colspan="4" class="section-title" style="vertical-align: middle;">{{ preg_replace('/^([A-Z]\.?|\d+\.?)\s*/', '', $catKey) }}</td>
                            </tr>
                            
                            @foreach($catItems as $key => $val)
                                @if(is_array($val) && isset($val['items']))
                                    <!-- Sub Category -->
                                    <tr>
                                        <td></td>
                                        <td colspan="4" class="sub-title" style="vertical-align: middle;">{{ preg_replace('/^([A-Z]\.?|\d+\.?)\s*/', '', $val['label']) }}</td>
                                    </tr>
                                    @foreach($val['items'] as $subKey => $subVal)
                                        @php
                                            $res = $saved[$subKey] ?? '';
                                            preg_match('/^(\d+\)|[A-Za-z]\.?|\d+\.?)\s*(.*)$/', trim($subVal), $m);
                                            $num = $m[1] ?? '';
                                            $txt = $m[2] ?? $subVal;
                                        @endphp
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div class="sub-list-container">
                                                    @if($num)<div class="list-num">{{ $num }}</div>@endif
                                                    <div class="list-text">{{ $txt }}</div>
                                                </div>
                                            </td>
                                            <td><div class="radio-group"><input type="radio" class="radio-k" name="form7[{{ $subKey }}]" value="K" {{ $res == 'K' ? 'checked' : '' }}></div></td>
                                            <td><div class="radio-group"><input type="radio" class="radio-bk" name="form7[{{ $subKey }}]" value="BK" {{ $res == 'BK' ? 'checked' : '' }}></div></td>
                                            <td><div class="radio-group"><input type="radio" class="radio-pl" name="form7[{{ $subKey }}]" value="PL" {{ $res == 'PL' ? 'checked' : '' }}></div></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <!-- Direct Item -->
                                    @php
                                        $res = $saved[$key] ?? '';
                                        preg_match('/^(\d+\)|[A-Za-z]\.?|\d+\.?)\s*(.*)$/', trim($val), $m);
                                        $num = $m[1] ?? '';
                                        $txt = $m[2] ?? $val;
                                    @endphp
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="list-container">
                                                @if($num)<div class="list-num">{{ $num }}</div>@endif
                                                <div class="list-text">{{ $txt }}</div>
                                            </div>
                                        </td>
                                        <td><div class="radio-group"><input type="radio" class="radio-k" name="form7[{{ $key }}]" value="K" {{ $res == 'K' ? 'checked' : '' }}></div></td>
                                        <td><div class="radio-group"><input type="radio" class="radio-bk" name="form7[{{ $key }}]" value="BK" {{ $res == 'BK' ? 'checked' : '' }}></div></td>
                                        <td><div class="radio-group"><input type="radio" class="radio-pl" name="form7[{{ $key }}]" value="PL" {{ $res == 'PL' ? 'checked' : '' }}></div></td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

                <!-- TABLE 2 -->
                <table>
                    <thead>
                        <tr>
                            <th rowspan="2" style="width: 5%;">NO</th>
                            <th rowspan="2" style="width: 65%; text-align: left;">KOMPETENSI TAMBAHAN (KEKHUSUSAN)</th>
                            <th colspan="3" style="width: 30%;">PENILAIAN</th>
                        </tr>
                        <tr>
                            <th style="width: 10%; color: var(--k-color);">K</th>
                            <th style="width: 10%; color: var(--bk-color);">BK</th>
                            <th style="width: 10%; color: var(--pl-color);">PL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $t2No = 1; @endphp
                        @foreach($table2 as $key => $val)
                            @php
                                $res = $saved[$key] ?? '';
                                $cleanVal = preg_replace('/^\d+\s/', '', $val); // Remove outer table index if any
                                preg_match('/^(\d+\)|[A-Za-z]\.?|\d+\.?)\s*(.*)$/', trim($cleanVal), $m);
                                $num = $m[1] ?? '';
                                $txt = $m[2] ?? $cleanVal;
                            @endphp
                            <tr>
                                <td style="text-align: center;">{{ $t2No++ }}</td>
                                <td>
                                    <div class="list-container">
                                        @if($num)<div class="list-num">{{ $num }}</div>@endif
                                        <div class="list-text">{{ $txt }}</div>
                                    </div>
                                </td>
                                <td><div class="radio-group"><input type="radio" class="radio-k" name="form7[{{ $key }}]" value="K" {{ $res == 'K' ? 'checked' : '' }}></div></td>
                                <td><div class="radio-group"><input type="radio" class="radio-bk" name="form7[{{ $key }}]" value="BK" {{ $res == 'BK' ? 'checked' : '' }}></div></td>
                                <td><div class="radio-group"><input type="radio" class="radio-pl" name="form7[{{ $key }}]" value="PL" {{ $res == 'PL' ? 'checked' : '' }}></div></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div style="font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 2rem;">
                    * Keputusan: K= Kompeten ; BK = Belum Kompeten ; PL= Penilaian Lanjutan
                </div>

                <!-- RECOMMENDATION -->
                <div class="recommendation-box">
                    <h3 style="font-size: 14px; font-weight: 700; margin-bottom: 15px;">Berdasarkan hasil asesmen tersebut, peserta:</h3>
                    
                    @php $rekomendasi = $saved['rekomendasi'] ?? ''; @endphp
                    <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px;">
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="radio" name="form7[rekomendasi]" value="direkomendasikan" {{ $rekomendasi == 'direkomendasikan' ? 'checked' : '' }} style="margin-top: 3px;">
                            <span style="font-size: 14px; font-weight: 600;">Direkomendasikan untuk mendapatkan pengakuan terhadap unit kompetensi yang diujikan</span>
                        </label>
                        <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                            <input type="radio" name="form7[rekomendasi]" value="tidak_direkomendasikan" {{ $rekomendasi == 'tidak_direkomendasikan' ? 'checked' : '' }} style="margin-top: 3px;">
                            <span style="font-size: 14px; font-weight: 600;">Tidak direkomendasikan untuk mendapatkan pengakuan terhadap unit kompetensi yang diujikan</span>
                        </label>
                    </div>

                    <h3 style="font-size: 14px; font-weight: 700; margin-bottom: 10px;">Umpan balik / masukan terhadap bukti:</h3>
                    <textarea name="form7[umpan_balik]" rows="4" style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px;" placeholder="Tuliskan umpan balik atau penjelasan untuk keputusan yang dibuat...">{{ $saved['umpan_balik'] ?? '' }}</textarea>
                </div>
            </div>

            <div class="footer">
                <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Keputusan (Form 7)</button>
            </div>
        </form>
    </div>
</body>
</html>
