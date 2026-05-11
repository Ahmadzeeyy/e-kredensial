<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Asesor - Kredensial RSUD</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        :root {
            --primary: #4F46E5;
            --primary-light: #EEF2FF;
            --primary-hover: #4338CA;
            --bg-color: #F8FAFC;
            --card-bg: #FFFFFF;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --border-color: #E2E8F0;
            --sidebar-width: 280px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }

        body { background-color: var(--bg-color); color: var(--text-main); min-height: 100vh; display: flex; }

        /* Modern Sidebar */
        .sidebar { 
            width: var(--sidebar-width); 
            background: #FFFFFF; 
            border-right: 1px solid var(--border-color); 
            padding: 2rem 1.25rem; 
            position: fixed; 
            height: 100vh; 
            display: flex; 
            flex-direction: column;
            z-index: 1000;
        }

        .brand { 
            padding: 0 0.75rem;
            margin-bottom: 3rem; 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            color: var(--primary);
            text-decoration: none;
        }
        .brand-logo {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), #818CF8);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
        .brand-name { font-size: 1.25rem; font-weight: 800; letter-spacing: -0.025em; color: #0F172A; }

        .nav-group { margin-bottom: 2rem; }
        .nav-label { 
            font-size: 11px; 
            font-weight: 700; 
            color: #94A3B8; 
            text-transform: uppercase; 
            letter-spacing: 0.1em; 
            padding: 0 1rem;
            margin-bottom: 0.75rem;
            display: block;
        }

        .nav-item { 
            display: flex; 
            align-items: center; 
            padding: 0.75rem 1rem; 
            color: #64748B; 
            border-radius: 12px; 
            font-weight: 600; 
            text-decoration: none; 
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); 
            margin-bottom: 0.25rem;
            font-size: 14px;
            position: relative;
        }
        
        .nav-item svg { width: 20px; height: 20px; margin-right: 12px; transition: transform 0.2s; }
        
        .nav-item:hover { 
            background: var(--primary-light); 
            color: var(--primary); 
        }
        .nav-item:hover svg { transform: translateX(2px); }

        .nav-item.active { 
            background: var(--primary); 
            color: white; 
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.2);
        }
        .nav-item.active svg { color: white; }

        .sidebar-footer {
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border-color);
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.75rem;
            border-radius: 16px;
            background: #F8FAFC;
            margin-bottom: 1rem;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            background: #E2E8F0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--primary);
            font-size: 14px;
        }
        .user-info { overflow: hidden; }
        .user-name { font-size: 13px; font-weight: 700; color: #1E293B; white-space: nowrap; text-overflow: ellipsis; }
        .user-role { font-size: 11px; font-weight: 600; color: #64748B; text-transform: uppercase; }

        .btn-logout {
            width: 100%;
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #EF4444;
            background: #FEF2F2;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-logout:hover { background: #FEE2E2; transform: translateY(-1px); }
        .btn-logout svg { margin-right: 12px; }

        .main-content { 
            flex: 1; 
            margin-left: var(--sidebar-width); 
            padding: 2.5rem 3rem; 
            min-height: 100vh;
        }

        /* DataTables custom */
        .dataTables_wrapper { font-size: 13px; color: #475569; width: 100%; }
        .dataTables_wrapper .dataTables_length { float: left; padding: 1.5rem 1.5rem 1rem 1.5rem; }
        .dataTables_wrapper .dataTables_filter { float: right; padding: 1.5rem 1.5rem 1rem 1.5rem; }
        .dataTables_wrapper .dataTables_filter input { border: 1px solid #cbd5e1; border-radius: 8px; padding: 6px 12px; outline: none; font-size: 13px; margin-left: 8px; transition: border-color 0.2s; }
        .dataTables_wrapper .dataTables_filter input:focus { border-color: var(--primary); }
        .dataTables_wrapper .dataTables_length select { border: 1px solid #cbd5e1; border-radius: 6px; padding: 6px; outline: none; margin: 0 4px; }
        table.dataTable { border-bottom: 1px solid #e2e8f0; border-top: 1px solid #e2e8f0; clear: both; margin: 0 !important; width: 100% !important; }
        table.dataTable thead th { border-bottom: 1px solid #e2e8f0 !important; }
        .dataTables_wrapper .dataTables_info { float: left; padding: 1rem 1.5rem 1.5rem 1.5rem; }
        .dataTables_wrapper .dataTables_paginate { float: right; padding: 1rem 1.5rem 1.5rem 1.5rem; }
        .dataTables_wrapper .dataTables_paginate .paginate_button { border-radius: 8px !important; padding: 6px 12px !important; margin: 0 2px !important; border: 1px solid transparent !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover { background: #f8fafc !important; color: var(--primary) !important; border: 1px solid #e2e8f0 !important; }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover { background: var(--primary) !important; color: white !important; border: 1px solid var(--primary) !important; font-weight: 600; }
        .dataTables_wrapper::after { content: ""; display: table; clear: both; }

        .btn-action { background: #4F46E5; color: white; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 12px; font-weight: 700; display: inline-block; }
        .btn-action:hover { background: #4338CA; }
        .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
        .empty-state .icon { font-size: 48px; display: block; margin-bottom: 16px; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <a href="{{ route('asesor.dashboard') }}" class="brand">
            <div class="brand-logo">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div>
            <span class="brand-name">Asesor Portal</span>
        </a>

        <nav style="flex: 1; display: flex; flex-direction: column;">
            <div class="nav-group">
                <span class="nav-label">Main Menu</span>
                <a href="{{ route('asesor.dashboard') }}" class="nav-item active">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    <span>Dashboard</span>
                </a>
            </div>

            <div class="sidebar-footer">
                <div class="user-card">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">Asesor</div>
                    </div>
                </div>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span>Keluar Sesi</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="main-content">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem;">
            <div>
                <h1 style="font-size: 1.875rem; font-weight: 700; letter-spacing: -0.025em;">Dashboard Asesor</h1>
                <p style="color: #64748b; font-size: 14px; margin-top: 4px;">Tinjau pengajuan dan riwayat penilaian Anda.</p>
            </div>
            <form method="GET" action="{{ route('asesor.dashboard') }}" style="display: flex; gap: 8px;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, jabatan..." style="padding: 10px 16px; border-radius: 8px; border: 1px solid #cbd5e1; width: 250px; font-size: 13px; outline: none;">
                <button type="submit" class="btn-action">Cari</button>
                @if(request()->has('search'))
                    <a href="{{ route('asesor.dashboard') }}" class="btn-action" style="background: #ef4444;">Reset</a>
                @endif
            </form>
        </div>

        <!-- TABS -->
        <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0;">
            <button onclick="switchTab('antrian')" id="tab-antrian" style="background: none; border: none; font-size: 14px; font-weight: 700; color: var(--primary); padding: 12px 16px; cursor: pointer; border-bottom: 2px solid var(--primary);">Antrian Masuk ({{ $kredensials->count() }})</button>
            <button onclick="switchTab('riwayat')" id="tab-riwayat" style="background: none; border: none; font-size: 14px; font-weight: 700; color: #64748b; padding: 12px 16px; cursor: pointer; border-bottom: 2px solid transparent;">Riwayat Selesai ({{ $history->count() }})</button>
        </div>

        <!-- ANTRIAN -->
        <div id="content-antrian" class="card" style="padding: 0;">
            @if($kredensials->isEmpty())
                <div class="empty-state">
                    <span class="icon">📋</span>
                    <p>Tidak ada pengajuan antrian yang sesuai.</p>
                </div>
            @else
                <div style="overflow-x: auto;">
                    <table class="datatable" style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                                <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 180px;">Asesi</th>
                                <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 150px;">Status</th>
                                <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 140px;">Berkas</th>
                                <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 140px;">Update Terakhir</th>
                                <th style="padding: 16px 20px 16px 60px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Review Formulir</th>
                                <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kredensials as $k)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                                <td style="padding: 16px 20px; text-align: left;">
                                    <div style="font-weight: 700; color: #1e293b; font-size: 14px;">{{ $k->nama_asesi }}</div>
                                    <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">{{ $k->created_at->timezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</div>
                                </td>
                                <td style="padding: 16px 20px; text-align: left;">
                                    @php $lbl = $k->status_label; @endphp
                                    <span style="background: {{ $lbl['bg'] }}; color: {{ $lbl['color'] }}; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; border: 1px solid #e2e8f0; display: inline-block;">
                                        {{ $lbl['text'] }}
                                    </span>
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
                                    <a href="{{ route('admin.ases', $k->id) }}" style="display: block; padding: 10px; background: #4F46E5; color: white; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 11px; transition: 0.2s;" onmouseover="this.style.background='#4338CA'" onmouseout="this.style.background='#4F46E5'">Nilai Sekarang</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- RIWAYAT -->
        <div id="content-riwayat" class="card" style="display: none; padding: 0;">
            @if($history->isEmpty())
                <div class="empty-state">
                    <span class="icon">✅</span>
                    <p>Belum ada riwayat penilaian yang selesai.</p>
                </div>
            @else
                <div style="overflow-x: auto;">
                    <table class="datatable" style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                                <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 180px;">Asesi</th>
                                <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 150px;">Status</th>
                                <th style="padding: 16px 20px; text-align: left; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 140px;">Update Terakhir</th>
                                <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Rekomendasi</th>
                                <th style="padding: 16px 20px; text-align: center; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 160px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($history as $h)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                                <td style="padding: 16px 20px; text-align: left;">
                                    <div style="font-weight: 700; color: #1e293b; font-size: 14px;">{{ $h->nama_asesi }}</div>
                                    <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">{{ $h->created_at->timezone('Asia/Jakarta')->format('d/m/Y H:i') }} WIB</div>
                                </td>
                                <td style="padding: 16px 20px; text-align: left;">
                                    <span style="background: #ecfdf5; color: #059669; padding: 6px 12px; border-radius: 8px; font-size: 11px; font-weight: 700; border: 1px solid #10b981; display: inline-block;">Selesai Dinilai</span>
                                </td>
                                <td style="padding: 16px 20px; text-align: left;">
                                    <div style="font-weight: 600; color: #475569; font-size: 13px;">{{ $h->updated_at->timezone('Asia/Jakarta')->format('d/m/Y') }}</div>
                                    <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">{{ $h->updated_at->timezone('Asia/Jakarta')->format('H:i') }} WIB</div>
                                </td>
                                <td style="padding: 16px 20px; text-align: center;">
                                    @if(isset($h->data_asesor['rekomendasi']) && $h->data_asesor['rekomendasi'] == 'lanjut')
                                        <span style="color: #059669; font-weight: 700; font-size: 12px;">✔ Asesmen Lanjut</span>
                                    @elseif(isset($h->data_asesor['rekomendasi']) && $h->data_asesor['rekomendasi'] == 'tidak_lanjut')
                                        <span style="color: #dc2626; font-weight: 700; font-size: 12px;">✖ Tidak Lanjut</span>
                                    @else
                                        <span style="color: #64748b; font-size: 12px;">-</span>
                                    @endif
                                </td>
                                <td style="padding: 16px 20px; text-align: center;">
                                    <a href="{{ route('admin.ases', $h->id) }}" style="display: block; padding: 8px 12px; background: #f1f5f9; color: #475569; text-decoration: none; border-radius: 8px; font-weight: 700; font-size: 11px; text-align: center; border: 1px solid #cbd5e1; transition: 0.2s;" onmouseover="this.style.background='#e2e8f0'">Lihat Hasil</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <script>
            function switchTab(tab) {
                document.getElementById('content-antrian').style.display = tab === 'antrian' ? 'block' : 'none';
                document.getElementById('content-riwayat').style.display = tab === 'riwayat' ? 'block' : 'none';
                
                document.getElementById('tab-antrian').style.color = tab === 'antrian' ? 'var(--primary)' : '#64748b';
                document.getElementById('tab-antrian').style.borderBottomColor = tab === 'antrian' ? 'var(--primary)' : 'transparent';
                
                document.getElementById('tab-riwayat').style.color = tab === 'riwayat' ? 'var(--primary)' : '#64748b';
                document.getElementById('tab-riwayat').style.borderBottomColor = tab === 'riwayat' ? 'var(--primary)' : 'transparent';
            }
        </script>

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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script>
        $(document).ready(function() {
            if ($('.datatable').length) {
                $('.datatable').DataTable({
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
            }
        });

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
    </main>
</body>
</html>
