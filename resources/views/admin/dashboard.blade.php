@extends('admin.dashboard_layout')

@section('content')
    <div class="header" style="margin-bottom: 2.5rem;">
        <h1 style="font-size: 1.875rem; font-weight: 700; letter-spacing: -0.025em;">Ringkasan Sistem</h1>
        <p style="color: #64748b; font-size: 14px;">Selamat datang kembali, berikut adalah ringkasan data kredensial saat ini.</p>
    </div>

    <!-- STATS CARDS -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
        <div class="card" style="padding: 1.5rem; background: white; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            <div style="color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 8px;">Total Pengajuan</div>
            <div style="font-size: 2rem; font-weight: 800; color: #1e293b;">{{ $stats['total_kredensial'] }}</div>
            <div style="margin-top: 8px; font-size: 11px; color: #10B981; font-weight: 600;">+ Berhasil terdata</div>
        </div>
        <div class="card" style="padding: 1.5rem; background: white; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            <div style="color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 8px;">Asesor Aktif</div>
            <div style="font-size: 2rem; font-weight: 800; color: #4F46E5;">{{ $stats['total_asesor'] }}</div>
            <div style="margin-top: 8px; font-size: 11px; color: #64748b;">Tim penilai kompetensi</div>
        </div>
        <div class="card" style="padding: 1.5rem; background: white; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            <div style="color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 8px;">Total User</div>
            <div style="font-size: 2rem; font-weight: 800; color: #0f172a;">{{ $stats['total_users'] }}</div>
            <div style="margin-top: 8px; font-size: 11px; color: #64748b;">Akun terdaftar di sistem</div>
        </div>
        <div class="card" style="padding: 1.5rem; background: white; border-radius: 16px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
            <div style="color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 8px;">Admin</div>
            <div style="font-size: 2rem; font-weight: 800; color: #ef4444;">{{ $stats['total_admin'] }}</div>
            <div style="margin-top: 8px; font-size: 11px; color: #64748b;">Pengelola sistem</div>
        </div>
    </div>

    <!-- CHARTS & LOGS -->
    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 1.5rem; margin-bottom: 3rem;">
        <!-- Chart Card -->
        <div class="card" style="padding: 1.5rem; background: white; border-radius: 16px; border: 1px solid #e2e8f0;">
            <h2 style="font-size: 1rem; font-weight: 700; margin-bottom: 1.5rem;">Distribusi Status</h2>
            <div style="height: 300px; display: flex; align-items: center; justify-content: center;">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        <!-- Activity Log Card -->
        <div class="card" style="padding: 1.5rem; background: white; border-radius: 16px; border: 1px solid #e2e8f0;">
            <h2 style="font-size: 1rem; font-weight: 700; margin-bottom: 1.5rem;">Log Aktivitas Terbaru</h2>
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @forelse(\App\Models\ActivityLog::with('user')->latest()->take(6)->get() as $log)
                <div style="display: flex; gap: 12px; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9;">
                    <div style="width: 32px; height: 32px; background: #eef2ff; color: #4f46e5; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700;">
                        {{ substr($log->user->name ?? '?', 0, 1) }}
                    </div>
                    <div style="flex: 1;">
                        <div style="font-size: 13px; font-weight: 600; color: #1e293b;">{{ $log->activity }}</div>
                        <div style="font-size: 11px; color: #94a3b8;">{{ $log->user->name ?? 'System' }} • {{ $log->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @empty
                <p style="font-size: 13px; color: #94a3b8; text-align: center; padding: 2rem;">Belum ada aktivitas.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; margin-bottom: 3rem;">
        <!-- LATEST SUBMISSIONS -->
        <div class="card" style="background: white; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                <h2 style="font-size: 1rem; font-weight: 700;">Pengajuan Terbaru</h2>
                <a href="{{ route('admin.kredensial.index') }}" style="font-size: 12px; color: #4F46E5; font-weight: 700; text-decoration: none;">Lihat Semua</a>
            </div>
            <table style="width: 100%; border-collapse: collapse;">
                <tbody id="latestTable">
                    @foreach($stats['latest_kredensials'] as $k)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 1rem 1.5rem;">
                            <div style="font-size: 13px; font-weight: 600; color: #1e293b;">{{ $k->nama_asesi }}</div>
                            <div style="font-size: 11px; color: #64748b;">{{ $k->jabatan }}</div>
                        </td>
                        <td style="padding: 1rem 1.5rem; text-align: right;">
                            <a href="{{ route('admin.ases', $k->id) }}" style="font-size: 11px; font-weight: 700; color: #4F46E5; text-decoration: none;">DETAIL</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- STR WARNING -->
        <div class="card" style="padding: 1.5rem; background: #fff; border-radius: 16px; border: 1px solid #ef444433; border-left: 4px solid #ef4444;">
            <h2 style="font-size: 1rem; font-weight: 700; color: #b91c1c; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                Peringatan STR
            </h2>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                @php
                    $expired = \App\Models\Kredensial::whereNotNull('str_expiry')->where('str_expiry', '<', now()->addMonths(3))->get();
                @endphp
                @forelse($expired as $ex)
                <div style="background: #fef2f2; padding: 10px; border-radius: 10px;">
                    <div style="font-size: 12px; font-weight: 700; color: #991b1b;">{{ $ex->nama_asesi }}</div>
                    <div style="font-size: 10px; color: #dc2626;">STR Exp: {{ \Carbon\Carbon::parse($ex->str_expiry)->format('d/m/Y') }}</div>
                </div>
                @empty
                <p style="font-size: 12px; color: #64748b;">Semua STR asesi masih berlaku aman.</p>
                @endforelse
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('statusChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Proses', 'Revisi', 'Baru'],
                datasets: [{
                    data: [
                        {{ \App\Models\Kredensial::where('status', 'Approved')->count() }},
                        {{ \App\Models\Kredensial::where('status', 'Under Review')->count() }},
                        {{ \App\Models\Kredensial::where('status', 'Needs Revision')->count() }},
                        {{ \App\Models\Kredensial::where('status', 'Submitted')->count() }}
                    ],
                    backgroundColor: ['#10b981', '#f59e0b', '#ef4444', '#6366f1'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
                },
                cutout: '70%'
            }
        });
    </script>
@endsection

