@extends('admin.dashboard_layout')

@section('content')
    <div class="header" style="margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <h1 style="font-size: 1.875rem; font-weight: 700; letter-spacing: -0.025em;">Data Selesai Dinilai</h1>
            <p style="color: #64748b; font-size: 14px; margin-top: 4px;">Daftar peserta yang proses penilaiannya telah selesai dan disetujui.</p>
        </div>
        <a href="{{ route('admin.export-rekap') }}" style="background: #10b981; color: white; text-decoration: none; padding: 12px 20px; border-radius: 8px; font-weight: 700; font-size: 13px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Export Rekapitulasi Excel
        </a>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; color: #059669; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #10b981; font-weight: 600; font-size: 14px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="background: white; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); overflow: hidden; border: 1px solid #e2e8f0;">
        <div style="padding: 1.5rem; border-bottom: 1px solid #e2e8f0; background: #FAFAFA;">
            <h2 style="font-size: 1.125rem; font-weight: 700;">Daftar Peserta Selesai</h2>
        </div>
        <div style="overflow-x: auto;">
            <table id="tableApproved" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Peserta / Jabatan</th>
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Waktu Submit</th>
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Selesai Dinilai</th>
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Informasi</th>
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Sertifikat</th>
                        <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kredensials as $k)
                    <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                        <td style="padding: 16px 20px; text-align: left;">
                            <div style="font-weight: 700; color: #1e293b; font-size: 14px;">{{ $k->nama_asesi }}</div>
                            <div style="font-size: 11px; font-weight: 600; color: #4F46E5; margin-top: 2px; text-transform: uppercase;">{{ $k->data_lengkap['jenis_profesi'] ?? '-' }}</div>
                            <div style="font-size: 12px; color: #64748b; margin-top: 2px;">{{ $k->jabatan }}</div>
                        </td>
                        <td style="padding: 16px 20px; text-align: center;">
                            <div style="font-weight: 600; color: #475569; font-size: 13px;">{{ $k->created_at->timezone('Asia/Jakarta')->format('d/m/Y') }}</div>
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">{{ $k->created_at->timezone('Asia/Jakarta')->format('H:i') }} WIB</div>
                        </td>
                        <td style="padding: 16px 20px; text-align: center;">
                            <div style="font-weight: 600; color: #10b981; font-size: 13px;">{{ $k->updated_at->timezone('Asia/Jakarta')->format('d/m/Y') }}</div>
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">{{ $k->updated_at->timezone('Asia/Jakarta')->format('H:i') }} WIB</div>
                        </td>
                        <td style="padding: 16px 20px; text-align: center;">
                            <div style="font-size: 12px; color: #475569;">
                                @if(isset($k->data_asesor['rekomendasi']) && $k->data_asesor['rekomendasi'] == 'lanjut')
                                    <span style="color: #059669; font-weight: 700;">✔ Lanjut</span>
                                @elseif(isset($k->data_asesor['rekomendasi']) && $k->data_asesor['rekomendasi'] == 'tidak_lanjut')
                                    <span style="color: #dc2626; font-weight: 700;">✖ Tidak Lanjut</span>
                                @else
                                    -
                                @endif
                            </div>
                        </td>
                        <td style="padding: 16px 20px; text-align: center;">
                            <a href="{{ route('kredensial.sertifikat', $k->id) }}" style="display: inline-flex; align-items: center; gap: 6px; padding: 0.5rem 0.8rem; background: #fff7ed; color: #c2410c; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 11px; border: 1px solid #fdba74;" title="Generate Sertifikat">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                Cetak
                            </a>
                        </td>
                        <td style="padding: 16px 20px; text-align: center;">
                            <div style="display: flex; gap: 6px; justify-content: center;">
                                <a href="{{ route('admin.download', $k->id) }}" style="display: inline-flex; align-items: center; padding: 0.5rem 0.8rem; background: #1e293b; color: white; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 11px; transition: 0.2s;" title="Unduh Excel">Unduh</a>
                                <form action="{{ route('admin.kredensial.cancel', $k->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" onclick="return confirm('Yakin ingin membatalkan penilaian ini? Status akan kembali menjadi Under Review.')" style="display: inline-flex; align-items: center; padding: 0.5rem 0.8rem; background: #fef2f2; color: #ef4444; border: 1px solid #fecaca; border-radius: 8px; font-weight: 700; font-size: 11px; transition: 0.2s; cursor: pointer;" title="Batal Selesai" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">Batal</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div style="padding: 5rem 2rem; text-align: center; color: #94a3b8;">
                                <div style="font-size: 4rem; margin-bottom: 1.5rem;">🎉</div>
                                <h3 style="color: #475569;">Belum Ada Data Selesai</h3>
                                <p>Peserta yang dinilai dan diklik "Selesai Dinilai" akan muncul di sini.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Inisialisasi mandiri untuk menghindari bentrok
        if ($.fn.DataTable.isDataTable('#tableApproved')) {
            $('#tableApproved').DataTable().destroy();
        }
        
        $('#tableApproved').DataTable({
            language: {
                search: "Pencarian:",
                lengthMenu: "Tampilkan _MENU_ baris",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "Selanjutnya",
                    previous: "Sebelumnya"
                }
            }
        });
    });
</script>
@endpush
