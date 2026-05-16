<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-ASKOMKRE</title>
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
    </style>
</head>
<body>
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="brand">
            <div class="brand-logo">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            </div>
            <span class="brand-name">E-ASKOMKRE</span>
        </a>

        <nav style="flex: 1; display: flex; flex-direction: column;">
            <div class="nav-group">
                <span class="nav-label">Main Menu</span>
                <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    <span>Dashboard</span>
                </a>
            </div>

            <div class="nav-group">
                <span class="nav-label">Manajemen</span>
                <a href="{{ route('admin.kredensial.index') }}" class="nav-item {{ request()->routeIs('admin.kredensial.index') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    <span>Data Pengajuan</span>
                </a>

                <a href="{{ route('admin.kredensial.approved') }}" class="nav-item {{ request()->routeIs('admin.kredensial.approved') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <span>Selesai Dinilai</span>
                </a>

                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path></svg>
                    <span>Manajemen User</span>
                </a>

                <a href="{{ route('admin.settings.certificate') }}" class="nav-item {{ request()->routeIs('admin.settings.certificate') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                    <span>Template Sertifikat</span>
                </a>
                @endif
            </div>

            <div class="sidebar-footer">
                <div class="user-card">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">{{ auth()->user()->role === 'user' ? 'ASESI' : strtoupper(auth()->user()->role) }}</div>
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
        @yield('content')
    </main>
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
    </script>
    @stack('scripts')
</body>
</html>
