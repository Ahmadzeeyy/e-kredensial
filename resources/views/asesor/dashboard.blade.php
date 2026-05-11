<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Asesor - Kredensial RSUD</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-hover: #4338CA;
            --bg-color: #F3F4F6;
            --card-bg: #FFFFFF;
            --text-main: #111827;
            --text-muted: #6B7280;
            --border-color: #E5E7EB;
            --success: #10B981;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-color); color: var(--text-main); min-height: 100vh; display: flex; }

        .sidebar { width: 280px; background: var(--card-bg); border-right: 1px solid var(--border-color); padding: 2rem 1.5rem; position: fixed; height: 100vh; box-shadow: 4px 0 24px rgba(0,0,0,0.02); display: flex; flex-direction: column; }
        .brand { font-size: 1.5rem; font-weight: 700; color: var(--primary); margin-bottom: 2.5rem; display: flex; align-items: center; gap: 10px; }
        .nav-item { display: flex; align-items: center; padding: 0.875rem 1rem; color: #475569; border-radius: 12px; font-weight: 600; text-decoration: none; transition: all 0.3s ease; margin-bottom: 0.5rem; }
        .nav-item:hover { background: #f8fafc; color: var(--primary); }
        .nav-item.active { background: rgba(79, 70, 229, 0.1); color: var(--primary); }
        .main-content { flex: 1; margin-left: 280px; padding: 2.5rem 3rem; }

        .card { background: white; border-radius: 16px; border: 1px solid #e2e8f0; overflow: hidden; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        thead tr { text-align: left; background: #f8fafc; }
        th { padding: 12px 20px; font-size: 11px; text-transform: uppercase; color: #64748b; font-weight: 700; letter-spacing: 0.05em; }
        td { padding: 16px 20px; font-size: 13px; border-bottom: 1px solid #f1f5f9; }
        .btn-action { background: #4F46E5; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 12px; font-weight: 700; display: inline-block; }
        .btn-action:hover { background: #4338CA; }
        .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
        .empty-state .icon { font-size: 48px; display: block; margin-bottom: 16px; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="brand">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            <span>Asesor Portal</span>
        </div>
        <nav style="flex: 1; display: flex; flex-direction: column;">
            <a href="{{ route('asesor.dashboard') }}" class="nav-item active">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 12px;"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                <span>Dashboard</span>
            </a>

            <div style="flex: 1;"></div>

            <div style="padding-top: 1rem; border-top: 1px solid #f1f5f9; margin-top: 1rem;">
                <div style="padding: 10px 1rem; margin-bottom: 10px;">
                    <div style="font-size: 13px; font-weight: 700; color: #1e293b;">{{ auth()->user()->name }}</div>
                    <div style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">Asesor</div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-item" style="width: 100%; border: none; background: none; color: #DC2626; cursor: pointer; margin-bottom: 0;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right: 12px;"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="main-content">
        <div style="margin-bottom: 2.5rem;">
            <h1 style="font-size: 1.875rem; font-weight: 700; letter-spacing: -0.025em;">Dashboard Asesor</h1>
            <p style="color: #64748b; font-size: 14px; margin-top: 4px;">Selamat datang kembali, berikut adalah daftar pengajuan yang perlu Anda tinjau.</p>
        </div>

        <div class="card">
            <h2 style="font-size: 1rem; font-weight: 700; margin-bottom: 1.5rem;">Antrian Pengajuan Kredensial</h2>
            
            @if($kredensials->isEmpty())
                <div class="empty-state">
                    <span class="icon">📋</span>
                    <p>Tidak ada pengajuan baru yang perlu ditinjau saat ini.</p>
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Asesi</th>
                            <th>Unit Kerja</th>
                            <th>Status</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kredensials as $k)
                        <tr>
                            <td>{{ $k->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div style="font-size: 14px; font-weight: 600; color: #1e293b;">{{ $k->nama_asesi }}</div>
                                <div style="font-size: 12px; color: #64748b;">{{ $k->jabatan }}</div>
                            </td>
                            <td style="color: #475569;">
                                {{ $k->data_lengkap['prof_unit_kerja'] ?? '-' }}
                            </td>
                            <td>
                                @php $lbl = $k->status_label; @endphp
                                <span style="background: {{ $lbl['bg'] }}; color: {{ $lbl['color'] }}; padding: 4px 12px; border-radius: 99px; font-size: 11px; font-weight: 700;">
                                    {{ $lbl['text'] }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('admin.ases', $k->id) }}" class="btn-action">Nilai Sekarang</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </main>
</body>
</html>
