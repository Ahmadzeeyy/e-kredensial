@extends('admin.dashboard_layout')

@section('content')
<div class="container" style="padding: 2rem;">
    <div style="margin-bottom: 2rem;">
        <h1 style="font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem;">Manajemen Template Sertifikat</h1>
        <p style="font-size: 14px; color: #64748b;">Kustomisasi tampilan sertifikat dengan mengunggah desain background buatan Anda sendiri.</p>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; color: #059669; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #10b981; font-weight: 600;">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2rem; align-items: start;">
        <!-- Upload Form -->
        <div style="background: white; padding: 2rem; border-radius: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1.5rem;">Upload Background Baru</h3>
            <form action="{{ route('admin.settings.certificate.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="margin-bottom: 1.5rem; padding: 2rem; border: 2px dashed #cbd5e1; border-radius: 16px; text-align: center; background: #f8fafc;">
                    <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;">🖼️</div>
                    <label style="display: block; cursor: pointer;">
                        <span style="display: inline-block; padding: 10px 20px; background: #4F46E5; color: white; border-radius: 10px; font-weight: 700; font-size: 13px;">Pilih Gambar Background</span>
                        <input type="file" name="background" style="display: none;" accept="image/*" onchange="previewFile(this)">
                    </label>
                    <p style="margin-top: 10px; font-size: 11px; color: #64748b;">Rekomendasi: Ukuran A4 Landscape (297mm x 210mm) <br>Format: JPG/PNG, Maksimal 5MB</p>
                </div>

                <div id="new-preview-container" style="display: none; margin-bottom: 1.5rem;">
                    <p style="font-size: 12px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Pratinjau File Terpilih:</p>
                    <img id="new-preview" src="#" style="width: 100%; border-radius: 8px; border: 1px solid #e2e8f0;">
                </div>

                <button type="submit" style="width: 100%; padding: 14px; background: #4F46E5; color: white; border: none; border-radius: 12px; font-weight: 700; cursor: pointer; transition: 0.2s;">
                    Simpan & Terapkan
                </button>
            </form>
        </div>

        <!-- Current Background -->
        <div style="background: white; padding: 2rem; border-radius: 20px; border: 1px solid #e2e8f0;">
            <h3 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem;">Template Saat Ini</h3>
            @if($background)
                <div style="position: relative; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0;">
                    <img src="{{ asset($background) }}" style="width: 100%; display: block;">
                    <div style="position: absolute; bottom: 0; left: 0; right: 0; background: rgba(0,0,0,0.6); padding: 10px; color: white; font-size: 11px; text-align: center;">
                        Aktif Digunakan
                    </div>
                </div>
                <form action="{{ route('admin.settings.certificate.reset') }}" method="POST" style="margin-top: 1rem;">
                    @csrf
                    <button type="submit" style="width: 100%; padding: 10px; background: #fee2e2; color: #ef4444; border: 1px solid #fecaca; border-radius: 10px; font-weight: 700; font-size: 13px; cursor: pointer;" onclick="return confirm('Apakah Anda yakin ingin menghapus template kustom dan kembali ke desain standar?')">
                        🗑️ Hapus & Kembali ke Default
                    </button>
                </form>
            @else
                <div style="padding: 3rem; background: #f1f5f9; border-radius: 12px; text-align: center; color: #64748b;">
                    <p>Belum ada background kustom. <br>Menggunakan template standar sistem.</p>
                </div>
            @endif

            <div style="margin-top: 2rem; padding: 1rem; background: #fffbeb; border: 1px solid #fef3c7; border-radius: 12px;">
                <p style="font-size: 12px; color: #92400e; font-weight: 600;">💡 Tips:</p>
                <p style="font-size: 12px; color: #92400e;">Gunakan desain dengan area tengah yang bersih untuk penulisan nama asesi agar teks tetap terbaca jelas.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function previewFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('new-preview').src = e.target.result;
                document.getElementById('new-preview-container').style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
