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

    <!-- CHARTS ROW 1 -->
    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 1.5rem; margin-bottom: 2rem;">
        <!-- Status Chart -->
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

    <!-- CHARTS ROW 2 -->
    <!-- ROW 2: 3-COL CHARTS (Compact) -->
    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
        <!-- Distribusi Pendidikan -->
        <div class="card" style="padding: 1.25rem; background: white; border-radius: 16px; border: 1px solid #e2e8f0;">
            <h2 style="font-size: 0.875rem; font-weight: 700; margin-bottom: 1rem; color: #475569;">Distribusi Pendidikan</h2>
            <div style="height: 220px;">
                <canvas id="pendidikanChart"></canvas>
            </div>
        </div>
        <!-- Perbandingan Profesi -->
        <div class="card" style="padding: 1.25rem; background: white; border-radius: 16px; border: 1px solid #e2e8f0;">
            <h2 style="font-size: 0.875rem; font-weight: 700; margin-bottom: 1rem; color: #475569;">Perbandingan Profesi</h2>
            <div style="height: 220px;">
                <canvas id="profesiChart"></canvas>
            </div>
        </div>
        <!-- Status Perkawinan -->
        <div class="card" style="padding: 1.25rem; background: white; border-radius: 16px; border: 1px solid #e2e8f0;">
            <h2 style="font-size: 0.875rem; font-weight: 700; margin-bottom: 1rem; color: #475569;">Status Perkawinan</h2>
            <div style="height: 220px;">
                <canvas id="nikahChart"></canvas>
            </div>
        </div>
    </div>

    <!-- ROW 3: Unit Kerja & STR Alert -->
    <div style="display: grid; grid-template-columns: 2fr 1.2fr; gap: 1.5rem; margin-bottom: 2rem;">
        <div class="card" style="padding: 1.5rem; background: white; border-radius: 16px; border: 1px solid #e2e8f0;">
            <h2 style="font-size: 0.875rem; font-weight: 700; margin-bottom: 1rem; color: #475569;">Distribusi Unit Kerja / Sub Spesialisasi</h2>
            <div style="height: 250px;">
                <canvas id="unitChart"></canvas>
            </div>
        </div>

        <!-- STR WARNINGS -->
        <div class="card" style="background: white; border-radius: 16px; border: 1px solid #e2e8f0; border-left: 5px solid #ef4444; position: relative; overflow: hidden;">
            <div style="padding: 1.5rem;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 1rem;">
                    <div style="background: #fef2f2; color: #ef4444; width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 18px;">⚠️</div>
                    <h2 style="font-size: 1rem; font-weight: 700; color: #991b1b;">Peringatan STR</h2>
                </div>
                
                <div style="max-height: 200px; overflow-y: auto;">
                    @php
                        $expired = \App\Models\Kredensial::whereNotNull('str_expiry')
                            ->where('str_expiry', '<', now()->addMonths(3))
                            ->where('str_expiry', '>', '1900-01-01') // Ignore seumur hidup placeholder
                            ->get();
                    @endphp

                    @if($expired->isEmpty())
                        <p style="color: #64748b; font-size: 13px;">Semua STR asesi masih berlaku aman.</p>
                    @else
                        @foreach($expired as $ex)
                        <div style="background: #fff5f5; border-radius: 10px; padding: 10px; margin-bottom: 8px; border: 1px solid #fee2e2;">
                            <div style="font-size: 13px; font-weight: 700; color: #b91c1c;">{{ $ex->nama_asesi }}</div>
                            <div style="font-size: 11px; color: #ef4444; margin-top: 2px;">
                                Expired: <strong>{{ \Carbon\Carbon::parse($ex->str_expiry)->format('d/m/Y') }}</strong>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div style="margin-bottom: 3rem;">
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Status Chart (Doughnut)
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        new Chart(ctxStatus, {
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
                plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } } },
                cutout: '75%'
            }
        });

        // Profesi Chart (Bar)
        const ctxProfesi = document.getElementById('profesiChart').getContext('2d');
        new Chart(ctxProfesi, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($stats['profesi_chart'])) !!},
                datasets: [{
                    label: 'Jumlah Personel',
                    data: {!! json_encode(array_values($stats['profesi_chart'])) !!},
                    backgroundColor: ['#6366f1', '#ec4899'],
                    borderRadius: 8,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { 
                        beginAtZero: true, 
                        grid: { display: false },
                        ticks: { stepSize: 1, precision: 0 }
                    }, 
                    x: { grid: { display: false } } 
                }
            }
        });

        // Unit Chart (Horizontal Bar)
        const ctxUnit = document.getElementById('unitChart').getContext('2d');
        new Chart(ctxUnit, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($stats['unit_chart'])) !!},
                datasets: [{
                    label: 'Jumlah Asesi',
                    data: {!! json_encode(array_values($stats['unit_chart'])) !!},
                    backgroundColor: '#10b981',
                    borderRadius: 6
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    x: { 
                        beginAtZero: true, 
                        grid: { display: false },
                        ticks: { stepSize: 1, precision: 0 }
                    }, 
                    y: { grid: { display: false } } 
                }
            }
        });

        // Pendidikan Chart (Doughnut)
        const ctxPendidikan = document.getElementById('pendidikanChart').getContext('2d');
        new Chart(ctxPendidikan, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($stats['pendidikan_chart'])) !!},
                datasets: [{
                    data: {!! json_encode(array_values($stats['pendidikan_chart'])) !!},
                    backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, padding: 15 } } },
                cutout: '70%'
            }
        });

        // Nikah Chart (Bar)
        const ctxNikah = document.getElementById('nikahChart').getContext('2d');
        new Chart(ctxNikah, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($stats['nikah_chart'])) !!},
                datasets: [{
                    label: 'Jumlah',
                    data: {!! json_encode(array_values($stats['nikah_chart'])) !!},
                    backgroundColor: '#8b5cf6',
                    borderRadius: 8,
                    barThickness: 50
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { 
                        beginAtZero: true, 
                        grid: { display: false },
                        ticks: { stepSize: 1, precision: 0 }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    </script>
@endsection

