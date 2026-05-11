@extends('admin.dashboard_layout')

@section('content')
    <div class="header" style="margin-bottom: 2.5rem;">
        <h1 style="font-size: 1.875rem; font-weight: 700; letter-spacing: -0.025em;">Data Pengajuan</h1>
        <p style="color: #64748b; font-size: 14px;">Daftar lengkap seluruh asesi yang telah mengisi formulir kredensial.</p>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; color: #059669; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #10b981; font-weight: 600; font-size: 14px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); overflow: hidden; border: 1px solid #e2e8f0;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #e2e8f0; background: #FAFAFA;">
            <h2 style="font-size: 1.125rem; font-weight: 700;">Daftar Seluruh Pengajuan</h2>
        </div>
        <div style="overflow-x: auto;">
            <table class="datatable" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 180px;">Asesi</th>
                        <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 150px;">Status</th>
                        <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 140px;">Berkas</th>
                        <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 140px;">Update Terakhir</th>
                        <th style="padding: 16px 20px 16px 60px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Review Formulir</th>
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 160px;">Aksi Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kredensials as $k)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                        <td style="padding: 16px 20px; text-align: left;">
                            <div style="font-weight: 700; color: #1e293b; font-size: 14px;">{{ $k->nama_asesi }}</div>
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">{{ $k->created_at->format('d/m/Y H:i') }}</div>
                        </td>
                        <td style="padding: 16px 20px; text-align: left;">
                            <form action="{{ route('admin.update-status', $k->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                <select name="status" onchange="this.form.submit()" style="padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; border: 1px solid #e2e8f0; background: {{ $k->status_label['bg'] }}; color: {{ $k->status_label['color'] }}; cursor: pointer; appearance: none; display: inline-block;">
                                    <option value="Submitted" {{ $k->status == 'Submitted' ? 'selected' : '' }}>Menunggu Review</option>
                                    <option value="Under Review" {{ $k->status == 'Under Review' ? 'selected' : '' }}>Sedang Dicek</option>
                                    <option value="Needs Revision" {{ $k->status == 'Needs Revision' ? 'selected' : '' }}>Perlu Revisi</option>
                                    <option value="Approved" {{ $k->status == 'Approved' ? 'selected' : '' }}>Selesai / Disetujui</option>
                                </select>
                            </form>
                        </td>
                        <td style="padding: 16px 20px; text-align: left;">
                            <button onclick="openPreview({{ $k->id }}, '{{ addslashes($k->nama_asesi) }}')" style="background: #fff; border: 1.5px solid #e2e8f0; padding: 8px 14px; border-radius: 10px; font-size: 11px; font-weight: 700; color: #475569; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s;" onmouseover="this.style.borderColor='#4F46E5'; this.style.color='#4F46E5'" onmouseout="this.style.borderColor='#e2e8f0'; this.style.color='#475569'">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                Lihat Berkas
                            </button>
                        </td>
                        <td style="padding: 16px 20px; text-align: left;">
                            <div style="font-weight: 600; color: #475569; font-size: 13px;">{{ $k->updated_at->timezone('Asia/Jakarta')->format('d/m/Y') }}</div>
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">
                                {{ $k->updated_at->timezone('Asia/Jakarta')->format('H:i') }} WIB
                                <span style="display: block; color: #6366f1; font-weight: 700; margin-top: 4px; font-size: 10px; text-transform: uppercase;">{{ $k->data_lengkap['last_form_updated'] ?? 'Pendaftaran' }}</span>
                            </div>
                        </td>
                        <td style="padding: 16px 20px 16px 60px; text-align: left;">
                            <div style="display: flex; gap: 6px; flex-wrap: wrap; justify-content: flex-start; max-width: 320px;">
                                <a href="{{ route('admin.ases', $k->id) }}" style="padding: 5px 10px; background: #ecfdf5; color: #059669; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 11px; border: 1px solid #10b981;">F1</a>
                                <a href="{{ route('admin.form3a', $k->id) }}" style="padding: 5px 10px; background: #f0fdfa; color: #0d9488; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 11px; border: 1px solid #14b8a6;">F3A</a>
                                <a href="{{ route('admin.form3b', $k->id) }}" style="padding: 5px 10px; background: #f0f9ff; color: #0284c7; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 11px; border: 1px solid #0ea5e9;">F3B</a>
                                <a href="{{ route('admin.form3d', $k->id) }}" style="padding: 5px 10px; background: #eef2ff; color: #4f46e5; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 11px; border: 1px solid #6366f1;">F3D</a>
                                <a href="{{ route('admin.form5', $k->id) }}" style="padding: 5px 10px; background: #eff6ff; color: #2563eb; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 11px; border: 1px solid #3b82f6;">F5</a>
                                <a href="{{ route('admin.form6', $k->id) }}" style="padding: 5px 10px; background: #f5f3ff; color: #7c3aed; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 11px; border: 1px solid #8b5cf6;">F6</a>
                                <a href="{{ route('admin.form7', $k->id) }}" style="padding: 5px 10px; background: #fffbeb; color: #d97706; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 11px; border: 1px solid #f59e0b;">F7</a>
                                <a href="{{ route('admin.form9', $k->id) }}" style="padding: 5px 10px; background: #fdf2f8; color: #be185d; text-decoration: none; border-radius: 6px; font-weight: 700; font-size: 11px; border: 1px solid #ec4899;">F9</a>
                            </div>
                        </td>
                        <td style="padding: 16px 20px; text-align: center;">
                            <div style="display: flex; flex-direction: column; gap: 8px; align-items: center;">
                                <a href="{{ route('admin.download', $k->id) }}" style="width: 100%; padding: 8px 12px; background: #1e293b; color: white; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 11px; text-align: center; transition: 0.2s;" onmouseover="this.style.background='#0f172a'" onmouseout="this.style.background='#1e293b'">📁 Unduh Rekap</a>
                                
                                @if($k->status !== 'Approved')
                                <form action="{{ route('admin.update-status', $k->id) }}" method="POST" style="width: 100%;">
                                    @csrf
                                    <input type="hidden" name="status" value="Approved">
                                    <button type="submit" style="width: 100%; padding: 8px 12px; background: #10b981; color: white; border: none; border-radius: 8px; font-weight: 800; font-size: 11px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.2);" onmouseover="this.style.background='#059669'; this.style.transform='scale(1.02)'" onmouseout="this.style.background='#10b981'; this.style.transform='scale(1)'" onclick="return confirm('Selesaikan penilaian untuk {{ $k->nama_asesi }}?')">
                                        ✔️ Selesaikan
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div style="padding: 5rem 2rem; text-align: center; color: #94a3b8;">
                                <div style="font-size: 4rem; margin-bottom: 1.5rem;">📂</div>
                                <h3 style="color: #475569;">Belum Ada Pengajuan</h3>
                                <p>Seluruh data asesi yang masuk akan muncul di sini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

<!-- PREVIEW MODAL -->
<div id="modalPreview" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(8px); align-items: center; justify-content: center; z-index: 2000; padding: 2rem;">
    <div style="background: white; border-radius: 24px; width: 100%; max-width: 1200px; height: 90vh; display: flex; flex-direction: column; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">
        <!-- Modal Header -->
        <div style="padding: 1.5rem 2rem; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; background: #f8fafc;">
            <div>
                <h2 id="previewName" style="font-size: 1.25rem; font-weight: 800; color: #1e293b;">Pratinjau Berkas</h2>
                <p style="font-size: 12px; color: #64748b;">Klik pada daftar dokumen di samping untuk melihat isi file.</p>
            </div>
            <button onclick="closePreview()" style="background: #ef4444; color: white; border: none; width: 36px; height: 36px; border-radius: 10px; cursor: pointer; font-size: 20px; font-weight: 700;">&times;</button>
        </div>
        
        <!-- Modal Body -->
        <div style="flex: 1; display: flex; overflow: hidden;">
            <!-- File List Sidebar -->
            <div id="fileListSidebar" style="width: 300px; border-right: 1px solid #e2e8f0; padding: 1.5rem; background: #fff; overflow-y: auto;">
                <div style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 1rem; letter-spacing: 0.05em;">Dokumen Tersedia</div>
                <div id="fileButtons" style="display: flex; flex-direction: column; gap: 8px;">
                    <!-- Buttons injected by JS -->
                </div>
            </div>
            
            <!-- Viewer -->
            <div style="flex: 1; background: #525659; position: relative;">
                <div id="previewPlaceholder" style="position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; text-align: center; padding: 2rem;">
                    <div style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;">📄</div>
                    <h3 style="font-weight: 700;">Pilih Dokumen</h3>
                    <p style="opacity: 0.6; font-size: 14px;">Silakan pilih dokumen di sebelah kiri untuk menampilkan pratinjau.</p>
                </div>
                <iframe id="previewIframe" style="width: 100%; height: 100%; border: none; display: none;"></iframe>
            </div>
        </div>
    </div>
</div>

<script>
function openPreview(id, name) {
    const modal = document.getElementById('modalPreview');
    const nameEl = document.getElementById('previewName');
    const buttonsContainer = document.getElementById('fileButtons');
    const iframe = document.getElementById('previewIframe');
    const placeholder = document.getElementById('previewPlaceholder');

    nameEl.innerText = 'Berkas: ' + name;
    buttonsContainer.innerHTML = '<div style="text-align:center; padding:2rem; color:#64748b; font-size:12px;">Memuat daftar berkas...</div>';
    iframe.style.display = 'none';
    placeholder.style.display = 'flex';
    modal.style.display = 'flex';

    // List of possible file types (same as in index.blade.php form)
    const fileTypes = {
        'pas_foto': 'Pas Foto',
        'ktp': 'KTP',
        'ijazah': 'Ijazah',
        'str': 'STR',
        'sip': 'SIP',
        'sertifikat_pelatihan': 'Sertifikat Pelatihan',
        'sk_penempatan': 'SK Penempatan'
    };

    let buttonsHtml = '';
    Object.keys(fileTypes).forEach(key => {
        buttonsHtml += `
            <button onclick="loadFile(${id}, '${key}')" class="file-btn" style="text-align: left; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 12px; background: white; cursor: pointer; transition: all 0.2s;">
                <div style="font-size: 13px; font-weight: 700; color: #1e293b;">${fileTypes[key]}</div>
                <div style="font-size: 10px; color: #94a3b8; margin-top: 2px;">Format PDF</div>
            </button>
        `;
    });
    buttonsContainer.innerHTML = buttonsHtml;
}

function loadFile(id, type) {
    const iframe = document.getElementById('previewIframe');
    const placeholder = document.getElementById('previewPlaceholder');
    
    // Highlight active button
    document.querySelectorAll('.file-btn').forEach(btn => {
        btn.style.borderColor = '#e2e8f0';
        btn.style.background = 'white';
    });
    event.currentTarget.style.borderColor = '#4F46E5';
    event.currentTarget.style.background = '#eef2ff';

    placeholder.innerHTML = '<div style="font-size:1.5rem; font-weight:700;">🔄 Memuat File...</div>';
    placeholder.style.display = 'flex';
    iframe.style.display = 'none';

    const url = `/admin/view-file/${id}/${type}`;
    iframe.src = url;
    iframe.onload = () => {
        placeholder.style.display = 'none';
        iframe.style.display = 'block';
    };
}

function closePreview() {
    document.getElementById('modalPreview').style.display = 'none';
    document.getElementById('previewIframe').src = '';
}
</script>
@endsection
