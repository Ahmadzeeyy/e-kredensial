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
                        <div style="display: flex; flex-direction: column;">
                            @foreach($items as $key => $val)
                                @if(is_array($val))
                                    <div style="background: #f1f5f9; padding: 12px 20px; font-weight: 700; font-size: 12px; color: #475569; text-transform: uppercase;">
                                        {{ $val['label'] }}
                                    </div>
                                    @foreach($val['items'] as $subKey => $subVal)
                                        <div style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; background: white;">
                                            <div style="font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 12px; line-height: 1.5;">{{ $subVal }}</div>
                                            
                                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; align-items: start;">
                                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                                    <div style="font-size: 10px; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">KETERANGAN ASESI</div>
                                                    <div style="font-size: 12px; color: #334155; font-style: italic; background: #f8fafc; padding: 8px 12px; border-radius: 6px; border: 1px dashed #cbd5e1; min-height: 38px; display: flex; align-items: center;">
                                                        {{ $asesiComp[$subKey] ?? '-' }}
                                                    </div>
                                                </div>
                                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                                    <div style="font-size: 10px; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">BUKTI RELEVAN</div>
                                                    <select name="ases[bukti_text][{{ $subKey }}]" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 12px; background: white; height: 38px; outline: none;">
                                                        <option value="">-- Pilih Bukti --</option>
                                                        <option value="SERKOM" {{ ($savedBukti[$subKey] ?? '') == 'SERKOM' ? 'selected' : '' }}>SERKOM</option>
                                                        <option value="JOBDES" {{ ($savedBukti[$subKey] ?? '') == 'JOBDES' ? 'selected' : '' }}>JOBDES</option>
                                                        <option value="SKET" {{ ($savedBukti[$subKey] ?? '') == 'SKET' ? 'selected' : '' }}>SKET</option>
                                                        <option value="LAIN-LAIN" {{ ($savedBukti[$subKey] ?? '') == 'LAIN-LAIN' ? 'selected' : '' }}>LAIN-LAIN</option>
                                                    </select>
                                                </div>
                                                <div style="display: flex; flex-direction: column; gap: 6px;">
                                                    <div style="font-size: 10px; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">PENILAIAN</div>
                                                    <label style="display: flex; align-items: center; gap: 10px; background: #eef2ff; padding: 0 14px; border-radius: 6px; border: 1px solid #e0e7ff; height: 38px; cursor: pointer;">
                                                        <input type="checkbox" name="ases[kompetensi][{{ $subKey }}]" value="1" {{ isset($saved[$subKey]) ? 'checked' : '' }} style="width: 16px; height: 16px; cursor: pointer; accent-color: #4f46e5;">
                                                        <span style="font-size: 12px; font-weight: 700; color: #4338ca; user-select: none;">Kompeten (V)</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div style="padding: 16px 20px; border-bottom: 1px solid #e2e8f0; background: white;">
                                        <div style="font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 12px; line-height: 1.5;">{{ $val }}</div>
                                        
                                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; align-items: start;">
                                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                                <div style="font-size: 10px; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">KETERANGAN ASESI</div>
                                                <div style="font-size: 12px; color: #334155; font-style: italic; background: #f8fafc; padding: 8px 12px; border-radius: 6px; border: 1px dashed #cbd5e1; min-height: 38px; display: flex; align-items: center;">
                                                    {{ $asesiComp[$key] ?? '-' }}
                                                </div>
                                            </div>
                                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                                <div style="font-size: 10px; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">BUKTI RELEVAN</div>
                                                <select name="ases[bukti_text][{{ $key }}]" style="width: 100%; padding: 8px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 12px; background: white; height: 38px; outline: none;">
                                                    <option value="">-- Pilih Bukti --</option>
                                                    <option value="SERKOM" {{ ($savedBukti[$key] ?? '') == 'SERKOM' ? 'selected' : '' }}>SERKOM</option>
                                                    <option value="JOBDES" {{ ($savedBukti[$key] ?? '') == 'JOBDES' ? 'selected' : '' }}>JOBDES</option>
                                                    <option value="SKET" {{ ($savedBukti[$key] ?? '') == 'SKET' ? 'selected' : '' }}>SKET</option>
                                                    <option value="LAIN-LAIN" {{ ($savedBukti[$key] ?? '') == 'LAIN-LAIN' ? 'selected' : '' }}>LAIN-LAIN</option>
                                                </select>
                                            </div>
                                            <div style="display: flex; flex-direction: column; gap: 6px;">
                                                <div style="font-size: 10px; font-weight: 700; color: #64748b; letter-spacing: 0.05em;">PENILAIAN</div>
                                                <label style="display: flex; align-items: center; gap: 10px; background: #eef2ff; padding: 0 14px; border-radius: 6px; border: 1px solid #e0e7ff; height: 38px; cursor: pointer;">
                                                    <input type="checkbox" name="ases[kompetensi][{{ $key }}]" value="1" {{ isset($saved[$key]) ? 'checked' : '' }} style="width: 16px; height: 16px; cursor: pointer; accent-color: #4f46e5;">
                                                    <span style="font-size: 12px; font-weight: 700; color: #4338ca; user-select: none;">Kompeten (V)</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- ── DATA PENDUKUNG (PELATIHAN & IKI) ── -->
            @php $catIndex++; @endphp
            <div class="acc-item" id="item_{{ $catIndex }}">
                <div class="acc-header" onclick="toggleAccordion({{ $catIndex }})">
                    <div class="acc-title">
                        <div class="acc-no">{{ $catIndex }}</div>
                        <div class="acc-label">DATA PENDUKUNG (PELATIHAN & IKI)</div>
                    </div>
                    <div class="acc-icon">▼</div>
                </div>
                <div class="acc-content" style="padding: 24px;">
                    <div style="margin-bottom: 24px;">
                        <h4 style="margin-bottom: 12px; font-size: 14px; color: #1e293b;">Riwayat Pelatihan</h4>
                        <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                            <thead>
                                <tr style="background: #f1f5f9;">
                                    <th style="padding: 10px; border: 1px solid #e2e8f0; text-align: left;">Nama Pelatihan</th>
                                    <th style="padding: 10px; border: 1px solid #e2e8f0;">Tahun</th>
                                    <th style="padding: 10px; border: 1px solid #e2e8f0;">JPL</th>
                                    <th style="padding: 10px; border: 1px solid #e2e8f0;">SKP</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $pelatihan = $kredensial->data_lengkap['pelatihan'] ?? []; @endphp
                                @forelse($pelatihan as $p)
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #e2e8f0;">{{ $p['nama'] ?? '-' }}</td>
                                        <td style="padding: 10px; border: 1px solid #e2e8f0; text-align: center;">{{ $p['tahun'] ?? '-' }}</td>
                                        <td style="padding: 10px; border: 1px solid #e2e8f0; text-align: center;">{{ $p['jpl'] ?? '-' }}</td>
                                        <td style="padding: 10px; border: 1px solid #e2e8f0; text-align: center;">{{ $p['skp'] ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" style="padding: 10px; text-align: center; color: #94a3b8;">Tidak ada data pelatihan</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <h4 style="margin-bottom: 12px; font-size: 14px; color: #1e293b;">Indikator Kinerja Individu (IKI)</h4>
                        <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                            <thead>
                                <tr style="background: #f1f5f9;">
                                    <th style="padding: 10px; border: 1px solid #e2e8f0; text-align: left;">Tahun</th>
                                    <th style="padding: 10px; border: 1px solid #e2e8f0;">Bulan</th>
                                    <th style="padding: 10px; border: 1px solid #e2e8f0;">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $iki = $kredensial->data_lengkap['iki'] ?? []; @endphp
                                @forelse($iki as $i)
                                    <tr>
                                        <td style="padding: 10px; border: 1px solid #e2e8f0;">{{ $i['tahun'] ?? '-' }}</td>
                                        <td style="padding: 10px; border: 1px solid #e2e8f0; text-align: center;">{{ $i['bulan'] ?? '-' }}</td>
                                        <td style="padding: 10px; border: 1px solid #e2e8f0; text-align: center;">{{ $i['nilai'] ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" style="padding: 10px; text-align: center; color: #94a3b8;">Tidak ada data IKI</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

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
                    
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-weight: 700; margin-bottom: 12px; color: #334155;">Catatan untuk Asesi:</label>
                        <textarea name="ases[catatan]" rows="4" style="width: 100%; padding: 12px; border: 1px solid #D1D5DB; border-radius: 8px; font-size: 14px; background: #F9FAFB;" placeholder="Masukkan catatan tambahan yang akan dibaca oleh asesi...">{{ $kredensial->data_asesor['catatan'] ?? '' }}</textarea>
                    </div>

                    <div style="margin-bottom: 24px;">
                        <label style="display: flex; align-items: center; gap: 8px; font-weight: 700; margin-bottom: 4px; color: #991b1b;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
                            Catatan Privat Asesor
                        </label>
                        <p style="font-size: 11px; color: #dc2626; margin-bottom: 8px;">*Hanya bisa dibaca oleh Anda, tidak muncul di pihak asesi.</p>
                        <textarea name="ases[catatan_privat]" rows="3" style="width: 100%; padding: 12px; border: 1px dashed #f87171; border-radius: 8px; font-size: 14px; background: #fef2f2; outline: none;" placeholder="Tulis catatan pribadi/pengingat di sini...">{{ $kredensial->data_asesor['catatan_privat'] ?? '' }}</textarea>
                    </div>

                    <div>
                        <label style="display: block; font-weight: 700; margin-bottom: 12px; color: #334155;">Tanda Tangan Digital Asesor:</label>
                        <div style="border: 1px solid #cbd5e1; border-radius: 12px; overflow: hidden; width: 100%; max-width: 500px; background: white; touch-action: none;">
                            <!-- The image preview if signature already exists -->
                            <img id="sigPreview" src="{{ $kredensial->data_asesor['ttd_asesor'] ?? '' }}" style="display: {{ isset($kredensial->data_asesor['ttd_asesor']) ? 'block' : 'none' }}; width: 100%; max-height: 200px; object-fit: contain; pointer-events: none;">
                            
                            <!-- The canvas for new signature -->
                            <canvas id="sigCanvas" style="display: {{ isset($kredensial->data_asesor['ttd_asesor']) ? 'none' : 'block' }}; width: 100%; height: 200px; cursor: crosshair;"></canvas>
                        </div>
                        <div style="margin-top: 10px; display: flex; gap: 10px;">
                            <button type="button" onclick="clearSignature()" style="font-size: 12px; background: #f1f5f9; border: 1px solid #cbd5e1; color: #475569; padding: 6px 14px; border-radius: 6px; font-weight: 700; cursor: pointer;">Hapus & TTD Ulang</button>
                        </div>
                        <input type="hidden" name="ases[ttd_asesor]" id="ttd_asesor" value="{{ $kredensial->data_asesor['ttd_asesor'] ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="footer" style="display: flex; gap: 16px; justify-content: flex-end; padding: 20px 0; border-top: 1px solid #e2e8f0; margin-top: 20px;">
                <button type="submit" name="action" value="simpan" class="btn btn-secondary" style="background: #1e293b; color: white; border: none; padding: 12px 24px; font-weight: 700; border-radius: 8px; cursor: pointer; width: 100%;">💾 Simpan Draft Penilaian Asesor</button>
            </div>
        </form>
    </div>

    <script>
        function toggleAccordion(index) {
            const item = document.getElementById('item_' + index);
            item.classList.toggle('active');
        }

        // Signature Pad Logic
        const canvas = document.getElementById('sigCanvas');
        const ctx = canvas.getContext('2d');
        const sigInput = document.getElementById('ttd_asesor');
        const sigPreview = document.getElementById('sigPreview');
        
        let isDrawing = false;
        
        // Handle responsive canvas size
        function resizeCanvas() {
            const ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            ctx.scale(ratio, ratio);
            ctx.strokeStyle = '#0f172a';
            ctx.lineWidth = 3;
            ctx.lineCap = 'round';
            ctx.lineJoin = 'round';
        }
        
        window.addEventListener('resize', resizeCanvas);
        // Initial setup timeout to allow rendering
        setTimeout(resizeCanvas, 100);

        function getCoordinates(e) {
            if (e.touches && e.touches.length > 0) {
                const rect = canvas.getBoundingClientRect();
                return {
                    x: e.touches[0].clientX - rect.left,
                    y: e.touches[0].clientY - rect.top
                };
            }
            return { x: e.offsetX, y: e.offsetY };
        }

        function startDrawing(e) {
            isDrawing = true;
            const { x, y } = getCoordinates(e);
            ctx.beginPath();
            ctx.moveTo(x, y);
            e.preventDefault();
        }

        function draw(e) {
            if (!isDrawing) return;
            const { x, y } = getCoordinates(e);
            ctx.lineTo(x, y);
            ctx.stroke();
            saveSignature();
            e.preventDefault();
        }

        function stopDrawing() {
            if (isDrawing) {
                isDrawing = false;
                ctx.closePath();
                saveSignature();
            }
        }

        function saveSignature() {
            // Only save if it's currently visible (not showing preview)
            if (canvas.style.display !== 'none') {
                sigInput.value = canvas.toDataURL('image/png');
            }
        }

        window.clearSignature = function() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            sigInput.value = '';
            sigPreview.style.display = 'none';
            canvas.style.display = 'block';
            resizeCanvas();
        }

        // Mouse Events
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        // Touch Events
        canvas.addEventListener('touchstart', startDrawing, {passive: false});
        canvas.addEventListener('touchmove', draw, {passive: false});
        canvas.addEventListener('touchend', stopDrawing);
        canvas.addEventListener('touchcancel', stopDrawing);
    </script>
</body>
</html>
