<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BSPS Desa Terjun Gajah')</title>

    <!-- Google Fonts: Plus Jakarta Sans (Modern & Geometric) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        :root {
            /* Light Theme Palette */
            --primary: #3b82f6;
            --primary-soft: #eff6ff;
            --text-main: #1e293b;
            --text-light: #64748b;
            --bg-body: #f8fafc;
            --bg-sidebar: #ffffff;
            --border: #e2e8f0;

            /* Spacing */
            --sidebar-width: 260px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            font-size: 14px;
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR (Light Mode) --- */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--bg-sidebar);
            border-right: 1px solid var(--border);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 24px;
            display: flex;
            flex-direction: column;
            z-index: 50;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
            padding: 0 8px;
        }

        .brand-icon {
            width: 36px;
            height: 36px;
            background: var(--primary);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }

        .brand-text {
            font-weight: 700;
            font-size: 16px;
            color: var(--text-main);
            line-height: 1.2;
        }

        .brand-sub {
            font-weight: 500;
            font-size: 12px;
            color: var(--text-light);
        }

        .menu-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-light);
            font-weight: 700;
            margin: 20px 12px 10px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: 10px;
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 4px;
        }

        .nav-link:hover {
            color: var(--primary);
            background: var(--primary-soft);
        }

        .nav-link.active {
            background: var(--primary-soft);
            color: var(--primary);
            font-weight: 600;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 16px;
        }

        .user-profile {
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: #f1f5f9;
            border-radius: 12px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: var(--primary);
            font-size: 14px;
            border: 1px solid var(--border);
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 32px;
            width: calc(100% - var(--sidebar-width));
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .page-title h1 {
            font-size: 20px;
            font-weight: 700;
            color: #0f172a;
        }

        .page-title p {
            color: var(--text-light);
            font-size: 14px;
        }

        /* --- CARDS & TABLES --- */
        .card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-body {
            padding: 24px;
        }

        /* --- BUTTONS --- */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            border: 1px solid transparent;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-light {
            background: white;
            border-color: var(--border);
            color: var(--text-main);
        }

        .btn-light:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .btn-danger {
            background: #fee2e2;
            color: #dc2626;
            border-color: transparent;
        }

        .btn-danger:hover {
            background: #fecaca;
        }

        .btn-flat {
            background: transparent;
            color: var(--text-light);
            padding: 8px;
        }

        .btn-flat:hover {
            color: var(--primary);
            background: var(--primary-soft);
            border-radius: 6px;
        }

        /* --- TABLE --- */
        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        th {
            text-align: left;
            padding: 12px 16px;
            background: #f8fafc;
            color: var(--text-light);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            color: var(--text-main);
            vertical-align: middle;
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: #fcfcfc;
        }

        /* Badge Pills */
        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-year {
            background: #e0f2fe;
            color: #0284c7;
        }

        .badge-admin {
            background: #f3e8ff;
            color: #7e22ce;
        }

        .badge-operator {
            background: #dcfce7;
            color: #166534;
        }

        /* --- RESPONSIVE UTILITIES --- */
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
        }

        .mobile-toggle {
            display: none;
            font-size: 20px;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-main);
            margin-right: 16px;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 40;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .mobile-toggle {
                display: block;
            }

            .overlay.active {
                display: block;
            }

            .grid-2,
            .grid-3 {
                grid-template-columns: 1fr !important;
            }

            .header {
                margin-bottom: 24px;
            }

            .page-title h1 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="overlay" onclick="toggleSidebar()"></div>

    <aside class="sidebar" id="sidebar">
        <div class="brand">
            <div class="brand-icon"><i class="fas fa-home"></i></div>
            <div>
                <div class="brand-text">Data BSPS</div>
                <div class="brand-sub">Terjun Gajah</div>
            </div>
        </div>

        <nav style="flex: 1;">
            <div class="menu-label">Main Menu</div>
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i> Dashboard
            </a>
            <a href="{{ route('bsps.index') }}" class="nav-link {{ request()->routeIs('bsps.*') ? 'active' : '' }}">
                <i class="fas fa-database"></i> Data Penerima
            </a>

            <div class="menu-label">Export</div>
            <a href="{{ route('export.excel') }}" class="nav-link">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
            <a href="{{ route('export.pdf') }}" class="nav-link">
                <i class="fas fa-file-pdf"></i> Export PDF
            </a>

            @if(auth()->user()->isAdmin())
                <div class="menu-label">System</div>
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fas fa-users-cog"></i> Users Management
                </a>
            @endif
        </nav>

        <div class="user-profile">
            <div class="avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
            <div style="flex: 1;">
                <div style="font-weight: 600; font-size: 13px;">{{ auth()->user()->name }}</div>
                <div style="font-size: 11px; color: var(--text-light); text-transform: capitalize;">
                    {{ auth()->user()->role }}
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn-flat" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </aside>

    <main class="main-content">
        <div style="display: flex; align-items: center; margin-bottom: 20px;" class="d-md-none">
            <button class="mobile-toggle" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        @if(session('success'))
            <div
                style="margin-bottom: 24px; padding: 12px 16px; background: #ecfdf5; border-radius: 10px; color: #065f46; border: 1px solid #d1fae5; display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.querySelector('.overlay').classList.toggle('active');
        }
    </script>
</body>

</html>