<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Asesor - Kredensial RSUD</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-light: #EEF2FF;
            --success: #10B981;
            --bg-color: #F8FAFC;
            --card-bg: #FFFFFF;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-main); padding: 2rem; min-height: 100vh; }
        .container { max-width: 1100px; margin: 0 auto; }
        
        .header-section { margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: flex-end; }
        h1 { font-size: 1.75rem; font-weight: 800; color: #0F172A; letter-spacing: -0.025em; }
        
        /* Modern Accordion */
        .acc-item { background: white; border-radius: 12px; border: 1px solid var(--border-color); margin-bottom: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .acc-item:hover { border-color: #CBD5E1; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .acc-item.active { border-color: var(--primary); box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.1); }

        .acc-header { 
            padding: 18px 24px; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            cursor: pointer; 
            background: white;
            user-select: none;
        }
        .acc-item.active .acc-header { background: var(--primary-light); }
        
        .acc-title { display: flex; align-items: center; gap: 15px; }
        .acc-no { width: 28px; height: 28px; background: #F1F5F9; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700; color: #475569; }
        .acc-item.active .acc-no { background: var(--primary); color: white; }
        .acc-label { font-weight: 700; font-size: 0.9375rem; color: #334155; }
        .acc-item.active .acc-label { color: var(--primary); }
        
        .acc-icon { font-size: 12px; transition: transform 0.3s; color: #94A3B8; }
        .acc-item.active .acc-icon { transform: rotate(180deg); color: var(--primary); }

        .acc-content { display: none; padding: 0; border-top: 1px solid var(--border-color); }
        .acc-item.active .acc-content { display: block; }
        
        /* Table Inside Content */
        .acc-table { width: 100%; border-collapse: collapse; }
        .acc-table th { background: #F8FAFC; padding: 12px 24px; text-align: left; font-size: 11px; font-weight: 700; color: #64748B; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border-color); }
        .acc-table td { padding: 12px 24px; border-bottom: 1px solid #F1F5F9; font-size: 13px; vertical-align: middle; }
        .acc-table tr:last-child td { border-bottom: none; }
        
        .sub-label-row { background: #F9FAFB; font-weight: 600; color: #64748B; font-size: 12px; }
        
        select { width: 100%; padding: 8px 12px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 12px; background: white; cursor: pointer; }
        select:focus { outline: none; border-color: var(--primary); ring: 2px solid var(--primary-light); }
        
        input[type="checkbox"] { width: 20px; height: 20px; cursor: pointer; accent-color: var(--primary); border-radius: 4px; }
        
        .footer { position: fixed; bottom: 0; left: 0; right: 0; background: white; padding: 1.25rem 2.5rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 1rem; z-index: 1000; box-shadow: 0 -4px 6px -1px rgba(0,0,0,0.05); }
        .btn { padding: 0.75rem 1.75rem; border-radius: 10px; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s; text-decoration: none; font-size: 0.875rem; }
        .btn-primary { background: var(--primary); color: white; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2); }
        .btn-primary:hover { background: #4338CA; transform: translateY(-1px); }
        .btn-secondary { background: white; border: 1px solid var(--border-color); color: var(--text-main); }
        .btn-secondary:hover { background: #F1F5F9; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-section">
            <div>
                <h1>Penilaian Kompetensi</h1>
                <p style="color: var(--text-muted); font-size: 0.9375rem; margin-top: 0.5rem;">Evaluasi Unit Kompetensi Perawat (FORM-01)</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Kembali ke Dashboard</a>
        </div>

        <form action="{{ route('admin.ases.store', $kredensial->id) }}" method="POST" style="padding-bottom: 120px;">
            @csrf
            
            @php
                $list = \App\Helpers\CompetencyHelper::getList();
                $saved = $kredensial->data_asesor['kompetensi'] ?? [];
                $savedBukti = $kredensial->data_asesor['bukti_text'] ?? [];
                $asesiComp = $kredensial->data_lengkap['data_kompetensi'] ?? [];
                $catIndex = 0;
            @endphp

            @foreach($list as $catName => $items)
                @php $catIndex++; @endphp
                <div class="acc-item" id="item_{{ $catIndex }}">
                    <div class="acc-header" onclick="toggleAccordion({{ $catIndex }})">
                        <div class="acc-title">
                            <div class="acc-no">{{ $catIndex }}</div>
                            <div class="acc-label">{{ $catName }}</div>
                        </div>
                        <div class="acc-icon">▼</div>
                    </div>
                    <div class="acc-content">
                        <table class="acc-table">
                            <thead>
                                <tr>
                                    <th>Kompetensi</th>
                                    <th style="width: 250px;">Keterangan Asesi</th>
                                    <th style="width: 180px;">Bukti Relevan</th>
                                    <th style="width: 80px; text-align: center;">V</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $key => $val)
                                    @if(is_array($val))
                                        <tr class="sub-label-row">
                                            <td colspan="4" style="padding-left: 24px;">{{ $val['label'] }}</td>
                                        </tr>
                                        @foreach($val['items'] as $subKey => $subVal)
                                            <tr>
                                                <td style="padding-left: 40px; color: #475569;">{{ $subVal }}</td>
                                                <td>
                                                    <div style="font-size: 11px; color: #64748b; font-style: italic; background: #f8fafc; padding: 6px 10px; border-radius: 6px; border: 1px dashed #e2e8f0; min-height: 30px;">
                                                        {{ $asesiComp[$subKey] ?? '-' }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <select name="ases[bukti_text][{{ $subKey }}]">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="SERKOM" {{ ($savedBukti[$subKey] ?? '') == 'SERKOM' ? 'selected' : '' }}>SERKOM</option>
                                                        <option value="JOBDES" {{ ($savedBukti[$subKey] ?? '') == 'JOBDES' ? 'selected' : '' }}>JOBDES</option>
                                                        <option value="SKET" {{ ($savedBukti[$subKey] ?? '') == 'SKET' ? 'selected' : '' }}>SKET</option>
                                                        <option value="LAIN-LAIN" {{ ($savedBukti[$subKey] ?? '') == 'LAIN-LAIN' ? 'selected' : '' }}>LAIN-LAIN</option>
                                                    </select>
                                                </td>
                                                <td style="text-align: center;">
                                                    <input type="checkbox" name="ases[kompetensi][{{ $subKey }}]" value="1" {{ isset($saved[$subKey]) ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td style="padding-left: 24px; color: #475569;">{{ $val }}</td>
                                            <td>
                                                <div style="font-size: 11px; color: #64748b; font-style: italic; background: #f8fafc; padding: 6px 10px; border-radius: 6px; border: 1px dashed #e2e8f0; min-height: 30px;">
                                                    {{ $asesiComp[$key] ?? '-' }}
                                                </div>
                                            </td>
                                            <td>
                                                <select name="ases[bukti_text][{{ $key }}]">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="SERKOM" {{ ($savedBukti[$key] ?? '') == 'SERKOM' ? 'selected' : '' }}>SERKOM</option>
                                                    <option value="JOBDES" {{ ($savedBukti[$key] ?? '') == 'JOBDES' ? 'selected' : '' }}>JOBDES</option>
                                                    <option value="SKET" {{ ($savedBukti[$key] ?? '') == 'SKET' ? 'selected' : '' }}>SKET</option>
                                                    <option value="LAIN-LAIN" {{ ($savedBukti[$key] ?? '') == 'LAIN-LAIN' ? 'selected' : '' }}>LAIN-LAIN</option>
                                                </select>
                                            </td>
                                            <td style="text-align: center;">
                                                <input type="checkbox" name="ases[kompetensi][{{ $key }}]" value="1" {{ isset($saved[$key]) ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

            @php $catIndex++; @endphp
            <div class="acc-item" id="item_{{ $catIndex }}">
                <div class="acc-header" onclick="toggleAccordion({{ $catIndex }})">
                    <div class="acc-title">
                        <div class="acc-no">{{ $catIndex }}</div>
                        <div class="acc-label">REKOMENDASI DAN CATATAN</div>
                    </div>
                    <div class="acc-icon">▼</div>
                </div>
                <div class="acc-content" style="padding: 24px;">
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: 700; margin-bottom: 12px; color: #334155;">Rekomendasi:</label>
                        <div style="display: flex; flex-direction: column; gap: 10px;">
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                <input type="radio" name="ases[rekomendasi]" value="lanjut" {{ ($kredensial->data_asesor['rekomendasi'] ?? '') == 'lanjut' ? 'checked' : '' }}>
                                <span style="font-size: 14px;">Asesmen dapat dilanjutkan</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                <input type="radio" name="ases[rekomendasi]" value="tidak_lanjut" {{ ($kredensial->data_asesor['rekomendasi'] ?? '') == 'tidak_lanjut' ? 'checked' : '' }}>
                                <span style="font-size: 14px;">Asesmen tidak dapat dilanjutkan</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label style="display: block; font-weight: 700; margin-bottom: 12px; color: #334155;">Catatan:</label>
                        <textarea name="ases[catatan]" rows="4" style="width: 100%; padding: 12px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 14px; background: #F9FAFB;" placeholder="Masukkan catatan tambahan jika ada...">{{ $kredensial->data_asesor['catatan'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <div class="footer">
                <button type="submit" class="btn btn-primary">Simpan Seluruh Penilaian</button>
            </div>
        </form>
    </div>

    <script>
        function toggleAccordion(index) {
            const item = document.getElementById('item_' + index);
            const isActive = item.classList.contains('active');
            
            // Optional: Close others
            // document.querySelectorAll('.acc-item').forEach(el => el.classList.remove('active'));
            
            if (isActive) {
                item.classList.remove('active');
            } else {
                item.classList.add('active');
            }
        }
    </script>

            <div class="legend">
                <h4>Kode dan tipe-tipe bukti:</h4>
                <p><b>SERKOM</b> = Sertifikat atau kualifikasi (contoh: pelatihan, keahlian)<br>
                <b>JOBDES</b> = Uraian tugas di tempat kerja<br>
                <b>SKET</b> = Surat Keterangan dari atasan<br>
                <b>LAIN-LAIN</b> = Bukti-bukti lainnya yang relevan</p>
            </div>

            <div class="floating-footer">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Penilaian Asesor</button>
            </div>
        </form>
    </div>
</body>
</html>
