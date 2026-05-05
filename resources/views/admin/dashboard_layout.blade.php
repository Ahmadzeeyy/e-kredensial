<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kredensial RSUD</title>
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
        .nav-item svg { margin-right: 12px; }

        .main-content { flex: 1; margin-left: 280px; padding: 2.5rem 3rem; }
    </style>
</head>
<body>
    <aside class="sidebar">
        <div class="brand">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
            <span>Admin Portal</span>
        </div>
        <nav style="flex: 1; display: flex; flex-direction: column;">
            <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.kredensial.index') }}" class="nav-item {{ request()->routeIs('admin.kredensial.*') ? 'active' : '' }}">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                <span>Data Pengajuan</span>
            </a>

            @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                <span>Manajemen User</span>
            </a>
            @endif

            <!-- Spacer -->
            <div style="flex: 1;"></div>

            <!-- User Profile & Logout -->
            <div style="padding-top: 1rem; border-top: 1px solid #f1f5f9; margin-top: 1rem;">
                <div style="padding: 10px 1rem; margin-bottom: 10px;">
                    <div style="font-size: 13px; font-weight: 700; color: #1e293b;">{{ auth()->user()->name }}</div>
                    <div style="font-size: 11px; color: #64748b; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px;">{{ auth()->user()->role }}</div>
                </div>
                
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-item" style="width: 100%; border: none; background: none; color: #DC2626; cursor: pointer; margin-bottom: 0;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 12px;"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>
</body>
</html>
