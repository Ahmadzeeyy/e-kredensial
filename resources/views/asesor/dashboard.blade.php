@extends('admin.dashboard_layout')

@section('content')
    <div class="header" style="margin-bottom: 2.5rem;">
        <h1 style="font-size: 1.875rem; font-weight: 700; letter-spacing: -0.025em;">Dashboard Asesor</h1>
        <p style="color: #64748b; font-size: 14px;">Selamat datang kembali, berikut adalah daftar pengajuan yang perlu Anda tinjau.</p>
    </div>

    <div class="card" style="background: white; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; padding: 20px;">
        <h2 style="font-size: 1rem; font-weight: 700; margin-bottom: 1.5rem;">Antrian Pengajuan Kredensial</h2>
        
        @if($kredensials->isEmpty())
            <div style="text-align: center; padding: 40px; color: #94a3b8;">
                <p>Tidak ada pengajuan baru yang perlu ditinjau saat ini.</p>
            </div>
        @else
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="text-align: left; background: #f8fafc;">
                        <th style="padding: 12px 20px; font-size: 11px; text-transform: uppercase; color: #64748b;">Tanggal</th>
                        <th style="padding: 12px 20px; font-size: 11px; text-transform: uppercase; color: #64748b;">Nama Asesi</th>
                        <th style="padding: 12px 20px; font-size: 11px; text-transform: uppercase; color: #64748b;">Unit Kerja</th>
                        <th style="padding: 12px 20px; font-size: 11px; text-transform: uppercase; color: #64748b;">Status</th>
                        <th style="padding: 12px 20px; font-size: 11px; text-transform: uppercase; color: #64748b; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kredensials as $k)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 16px 20px; font-size: 13px;">{{ $k->created_at->format('d/m/Y') }}</td>
                        <td style="padding: 16px 20px;">
                            <div style="font-size: 14px; font-weight: 600; color: #1e293b;">{{ $k->nama_asesi }}</div>
                            <div style="font-size: 12px; color: #64748b;">{{ $k->jabatan }}</div>
                        </td>
                        <td style="padding: 16px 20px; font-size: 13px; color: #475569;">
                            {{ $k->data_lengkap['prof_unit_kerja'] ?? '-' }}
                        </td>
                        <td style="padding: 16px 20px;">
                            @php $lbl = $k->status_label; @endphp
                            <span style="background: {{ $lbl['bg'] }}; color: {{ $lbl['color'] }}; padding: 4px 12px; border-radius: 99px; font-size: 11px; font-weight: 700;">
                                {{ $lbl['text'] }}
                            </span>
                        </td>
                        <td style="padding: 16px 20px; text-align: center;">
                            <a href="{{ route('admin.ases', $k->id) }}" style="background: #4F46E5; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 12px; font-weight: 700;">Nilai Sekarang</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
