<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form 3B - Instrumen Penilaian Secara Lisan</title>
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
        
        .info-grid { display: grid; grid-template-columns: auto 1fr auto 1fr; gap: 12px 24px; margin-bottom: 2rem; font-size: 13.5px; background: white; padding: 1.5rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.5); box-shadow: 0 4px 24px rgba(13,43,85,0.05); }
        .info-label { font-weight: 600; color: var(--text-muted); }
        
        .question-card { background: white; border-radius: 12px; margin-bottom: 1.5rem; overflow: hidden; border: 1px solid var(--border-color); box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
        .q-header { display: flex; background: #65a30d; color: white; }
        .q-number { width: 50px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.2rem; border-right: 1px solid rgba(255,255,255,0.2); }
        .q-title { flex-grow: 1; padding: 1rem; }
        .q-title input { width: 100%; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: white; font-weight: 700; padding: 8px 12px; border-radius: 6px; outline: none; font-size: 14px; text-transform: uppercase; }
        .q-title input::placeholder { color: rgba(255,255,255,0.6); }
        .q-title input:focus { background: rgba(255,255,255,0.2); border-color: white; }
        
        .q-decision { width: 180px; border-left: 1px solid rgba(255,255,255,0.2); display: flex; flex-direction: column; }
        .q-decision-title { font-size: 11px; font-weight: 700; text-align: center; padding: 6px; border-bottom: 1px solid rgba(255,255,255,0.2); letter-spacing: 0.05em; background: rgba(0,0,0,0.1); }
        .q-decision-body { display: flex; flex: 1; }
        .q-decision-opt { flex: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 6px; font-size: 12px; font-weight: 700; padding: 10px 0; cursor: pointer; transition: 0.2s; }
        .q-decision-opt:first-child { border-right: 1px solid rgba(255,255,255,0.2); }
        .q-decision-opt:hover { background: rgba(255,255,255,0.1); }
        .q-decision-opt input { width: 16px; height: 16px; cursor: pointer; accent-color: white; }
        
        .q-body { padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem; }
        .input-row { display: flex; align-items: flex-start; gap: 10px; }
        .input-row label { width: 120px; font-size: 12px; font-weight: 700; color: #475569; letter-spacing: 0.05em; margin-top: 10px; }
        .input-row span { margin-top: 10px; color: #cbd5e1; font-weight: 700; }
        .input-row input, .input-row textarea { flex-grow: 1; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 13.5px; transition: all 0.2s; outline: none; background: #f8fafc; color: #1e293b; }
        .input-row input:focus, .input-row textarea:focus { border-color: var(--secondary); background: white; box-shadow: 0 0 0 3px rgba(59,157,232,0.1); }
        
        .btn { padding: 0.7rem 1.4rem; border-radius: 10px; font-weight: 600; cursor: pointer; border: none; font-size: 13.5px; text-decoration: none; transition: all 0.2s; display: inline-flex; align-items: center; justify-content: center; }
        .btn-primary { background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%); color: white; box-shadow: 0 4px 12px rgba(26,95,168,0.25); }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(26,95,168,0.35); }
        .btn-secondary { background: white; border: 1.5px solid #cbd5e1; color: #475569; }
        .btn-secondary:hover { background: #f8fafc; border-color: #94a3b8; }
        .btn-add { background: #f1f5f9; color: #475569; width: 100%; border: 2px dashed #cbd5e1; padding: 1rem; border-radius: 12px; margin-bottom: 2rem; }
        .btn-add:hover { background: #e2e8f0; border-color: #94a3b8; color: #1e293b; }
        
        .footer { position: fixed; bottom: 0; left: 0; right: 0; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); padding: 1rem 2rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 1rem; z-index: 100; box-shadow: 0 -4px 20px rgba(0,0,0,0.02); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>FORM-03 B: Instrumen Penilaian Secara Lisan</h1>
                <p style="font-size: 13px; color: #64748b; margin-top: 4px;">Formulir untuk mendokumentasikan hasil penilaian tanya jawab/lisan.</p>
            </div>
            <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        <div class="info-grid">
            <div class="info-label">Nama</div>
            <div>: {{ $kredensial->nama_asesi }}</div>
            <div class="info-label">Tanggal/Waktu</div>
            <div>: {{ \Carbon\Carbon::now()->format('d F Y H:i') }} WIB</div>
            
            <div class="info-label">Nama Asessor</div>
            <div>: {{ auth()->user()->name }}</div>
            <div class="info-label">Tempat</div>
            <div>: RSUD dr. M. Soewandhie Surabaya</div>
        </div>

        <form action="{{ route('admin.form3b.store', $kredensial->id) }}" method="POST" style="padding-bottom: 80px;">
            @csrf
            
            <div id="questionsContainer">
                @php
                    $saved = $kredensial->data_form3b ?? [];
                    if (empty($saved)) {
                        $saved = [
                            ['title' => 'BANTUAN HIDUP DASAR', 'nilai' => '', 'keterangan' => '', 'asessor' => auth()->user()->name, 'res' => ''],
                            ['title' => 'PEMASANGAN AKSES INTRAVENA', 'nilai' => '', 'keterangan' => '', 'asessor' => auth()->user()->name, 'res' => ''],
                            ['title' => 'NASOGASTRIC TUBE', 'nilai' => '', 'keterangan' => '', 'asessor' => auth()->user()->name, 'res' => ''],
                            ['title' => 'PEMASANGAN KATETER', 'nilai' => '', 'keterangan' => '', 'asessor' => auth()->user()->name, 'res' => ''],
                        ];
                    }
                @endphp

                @foreach($saved as $index => $row)
                <div class="question-card">
                    <div class="q-header">
                        <div class="q-number">{{ $index + 1 }}</div>
                        <div class="q-title">
                            <input type="text" name="form3b[{{ $index }}][title]" value="{{ $row['title'] ?? '' }}" placeholder="Topik Penilaian Lisan...">
                        </div>
                        <div class="q-decision">
                            <div class="q-decision-title">KEPUTUSAN</div>
                            <div class="q-decision-body">
                                <label class="q-decision-opt">
                                    K <input type="radio" name="form3b[{{ $index }}][res]" value="K" {{ ($row['res'] ?? '') == 'K' ? 'checked' : '' }}>
                                </label>
                                <label class="q-decision-opt">
                                    BK <input type="radio" name="form3b[{{ $index }}][res]" value="BK" {{ ($row['res'] ?? '') == 'BK' ? 'checked' : '' }}>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="q-body">
                        <div class="input-row">
                            <label>NILAI</label><span>:</span>
                            <textarea name="form3b[{{ $index }}][nilai]" rows="2" placeholder="Masukkan poin-poin nilai lisan...">{{ $row['nilai'] ?? '' }}</textarea>
                        </div>
                        <div class="input-row">
                            <label>KETERANGAN</label><span>:</span>
                            <textarea name="form3b[{{ $index }}][keterangan]" rows="2" placeholder="Catatan tambahan...">{{ $row['keterangan'] ?? '' }}</textarea>
                        </div>
                        <div class="input-row">
                            <label>ASESSOR</label><span>:</span>
                            <input type="text" name="form3b[{{ $index }}][asessor]" value="{{ $row['asessor'] ?? auth()->user()->name }}" readonly style="background: transparent; border-color: transparent; padding-left: 0; font-weight: 700;">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <button type="button" class="btn btn-add" onclick="addRow()">+ Tambah Topik Pertanyaan Lisan</button>

            <div class="footer">
                <a href="{{ route('admin.kredensial.index') }}" class="btn btn-secondary" style="background: #f1f5f9; border: 1px solid #cbd5e1; color: #475569;">Batal</a>
                <button type="submit" name="action" value="simpan" class="btn btn-secondary" style="background: #1e293b; color: white; border: none; flex: 1;">💾 Simpan Draft Form 3B</button>
            </div>
        </form>
    </div>

    <script>
        let rowIdx = {{ count($saved) }};
        const asessorName = "{{ auth()->user()->name }}";
        
        function addRow() {
            const container = document.getElementById('questionsContainer');
            const div = document.createElement('div');
            div.className = 'question-card';
            div.innerHTML = `
                <div class="q-header">
                    <div class="q-number">${rowIdx + 1}</div>
                    <div class="q-title">
                        <input type="text" name="form3b[${rowIdx}][title]" value="" placeholder="Topik Penilaian Lisan...">
                    </div>
                    <div class="q-decision">
                        <div class="q-decision-title">KEPUTUSAN</div>
                        <div class="q-decision-body">
                            <label class="q-decision-opt">
                                K <input type="radio" name="form3b[${rowIdx}][res]" value="K">
                            </label>
                            <label class="q-decision-opt">
                                BK <input type="radio" name="form3b[${rowIdx}][res]" value="BK">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="q-body">
                    <div class="input-row">
                        <label>NILAI</label><span>:</span>
                        <textarea name="form3b[${rowIdx}][nilai]" rows="2" placeholder="Masukkan poin-poin nilai lisan..."></textarea>
                    </div>
                    <div class="input-row">
                        <label>KETERANGAN</label><span>:</span>
                        <textarea name="form3b[${rowIdx}][keterangan]" rows="2" placeholder="Catatan tambahan..."></textarea>
                    </div>
                    <div class="input-row">
                        <label>ASESSOR</label><span>:</span>
                        <input type="text" name="form3b[${rowIdx}][asessor]" value="${asessorName}" readonly style="background: transparent; border-color: transparent; padding-left: 0; font-weight: 700;">
                    </div>
                </div>
            `;
            container.appendChild(div);
            rowIdx++;
        }
    </script>
</body>
</html>
