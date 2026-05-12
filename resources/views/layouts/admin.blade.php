<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f0f0f0; font-family: sans-serif; margin: 0; }
        
        /* SIDEBAR FIX: Tambahkan Flexbox */
        .sidebar { 
            width: 220px; 
            height: 100vh; 
            position: fixed; 
            background: #2058f3; 
            border-right: 1px solid #ccc;
            display: flex; /* WAJIB ADA */
            flex-direction: column; /* WAJIB ADA */
            z-index: 1000;
        }
        
        .sidebar-item { 
            padding: 12px 20px; 
            display: flex; 
            align-items: center; 
            text-decoration: none; 
            color: #ffffff; 
            font-weight: 500; 
            transition: 0.3s;
        }

        .sidebar-item:hover, 
        .sidebar-item.active { 
            background: #d3d3d3; 
            color: #000000; 
            font-weight: bold;
        }

        /* LOGOUT CONTAINER: Didorong ke bawah */
        .logout-container {
            margin-top: auto; /* Mendorong elemen ini ke paling bawah sidebar */
            margin-bottom: 50px; /* Jarak agar tidak menumpuk dengan footer */
        }

        .text-danger { color: #ff4d4d !important; }

        .sidebar-item i { margin-right: 10px; }

        .sidebar-footer { 
            position: absolute; 
            bottom: 0; 
            width: 100%; 
            background: #d3d3d3; 
            padding: 10px 20px; 
            font-weight: bold; 
            color: #000; 
        }

        /* MAIN CONTENT FIX: Geser agar tidak tertutup sidebar */
        .main-wrapper { 
            margin-left: 220px; /* Samakan dengan lebar sidebar */
        }

        .top-nav { 
            background: #2058f3; 
            padding: 10px 30px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            font-weight: bold; 
            color: #fff; 
            height: 50px;
        }

        .content-container { 
            margin: 20px; 
            background: #fff; 
            min-height: 85vh; 
            border-left: 12px solid #d3d3d3; 
            padding: 20px; /* Beri padding agar isi konten tidak nempel ke pinggir */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="menu-top">
            <a href="{{ route('divisi.dashboard') }}" class="sidebar-item {{ request()->is('divisi/dashboard*') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a href="{{ route('divisi.karyawan') }}" class="sidebar-item {{ request()->is('divisi/karyawan*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i> Data Karyawan
            </a>
            <a href="{{ route('divisi.kehadiran') }}" class="sidebar-item {{ request()->routeIs('divisi.kehadiran*') ? 'active' : '' }}">
                <i class="bi bi-calendar-check"></i> Data Kehadiran
            </a>
            <a href="{{ route('divisi.perizinan') }}" class="sidebar-item {{ request()->routeIs('divisi.perizinan*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-text"></i> Verifikasi Perizinan
            </a>
        </div>

        <div class="logout-container">
            <a href="#" class="sidebar-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>

        <div class="sidebar-footer">MA &nbsp; Muflih Anwar</div>
    </div>

    <div class="main-wrapper">
        <div class="top-nav">
            <span>Presensia</span>
            <span>Hallo, Muflih Anwar</span>
        </div>
        <div class="content-container">
            @yield('content')
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>