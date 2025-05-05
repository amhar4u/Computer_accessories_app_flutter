<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Box Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 70px;
            --sidebar-gradient: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            --sidebar-header-bg: rgba(0, 0, 0, 0.1);
            --sidebar-item-hover: rgba(255, 255, 255, 0.1);
            --sidebar-active-bg: rgba(255, 255, 255, 0.2);
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            transition: all var(--transition-speed) ease;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .sidebar-container {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--sidebar-gradient);
            transition: all var(--transition-speed) ease;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-container.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        /* Sidebar Header */
        .sidebar-header {
            height: 60px;
            background: var(--sidebar-header-bg);
            display: flex;
            align-items: center;
            padding: 0 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            position: relative; /* Ensure positioning context for mobile-close-btn */
        }

        .sidebar-header .toggle-btn {
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .sidebar-header .logo {
            color: white;
            font-weight: 600;
            margin-left: 0.5rem;
            white-space: nowrap;
            transition: opacity var(--transition-speed) ease;
        }

        .sidebar-header .mobile-close-btn {
            display: none;
            font-size: 1.5rem;
            color: white;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1010; /* Ensure it's above other sidebar elements */
        }

        .sidebar-container.collapsed .logo {
            opacity: 0;
            width: 0;
            margin: 0;
        }

        /* Sidebar Menu */
        .sidebar-menu {
            height: calc(100vh - 60px);
            overflow-y: auto;
            /* padding: 0.5rem 0; */
            /* padding: 1rem 0; */
        }

        .nav-link {
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.8);
            padding: 0.75rem 1.5rem;
            transition: all var(--transition-speed) ease;
        }

        .nav-link:hover, .nav-link:focus {
            color: white;
            background: var(--sidebar-item-hover);
        }

        .nav-link.active {
            background: var(--sidebar-active-bg);
            color: white;
        }

        .nav-icon {
            font-size: 1.2rem;
            margin-right: 1rem;
            min-width: 24px;
            text-align: center;
        }

        .nav-text {
            white-space: nowrap;
            transition: opacity var(--transition-speed) ease;
        }

        .sidebar-container.collapsed .nav-text {
            opacity: 0;
            width: 0;
        }

        /* Submenu Styles */
        .submenu {
            list-style: none;
            padding-left: 0;
            background: rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-height: 0;
            transition: max-height var(--transition-speed) ease;
        }

        .submenu.show {
            max-height: 500px;
        }

        .submenu .nav-link {
            padding-left: 3.5rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .sidebar-container.collapsed .submenu {
            display: none;
        }

        /* Main Content */
        .main-container {
            margin-left: var(--sidebar-width);
            transition: all var(--transition-speed) ease;
        }

        .sidebar-container.collapsed ~ .main-container {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Page Header */
        .page-header {
            height: 60px;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 999;
            display: flex;
            align-items: center;
            padding: 0 1rem;
        }

        .header-toggle {
            display: none;
            font-size: 1.5rem;
            color: #333;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
            margin-right: 1rem;
        }

        .page-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
        }

        /* Floating Close Button */
        .floating-close-btn {
            display: none;
            position: fixed;
            bottom: 20px;
            left: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ff3366;
            color: white;
            border: none;
            font-size: 2rem;
            z-index: 1100;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            align-items: center;
            justify-content: center;
        }

        /* Responsive Behavior */
        @media (max-width: 992px) {
            .sidebar-container {
                transform: translateX(-100%);
            }

            .sidebar-container.show {
                transform: translateX(0);
            }

            .sidebar-container.collapsed {
                width: var(--sidebar-width);
                transform: translateX(-100%);
            }

            .sidebar-container.collapsed.show {
                transform: translateX(0);
            }

            .main-container {
                margin-left: 0 !important;
            }

            .header-toggle {
                display: block;
            }

            .sidebar-header {
                position: relative;
                justify-content: space-between; /* Better spacing */
            }

            .mobile-close-btn {
                display: block !important; /* Force display */
                position: absolute;
                right: 1rem;
                top: 50%;
                transform: translateY(-50%);
                font-size: 2rem; /* Larger size */
                color: #fff;
                background: rgba(255, 255, 255, 0.2); /* More visible background */
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex !important;
                align-items: center;
                justify-content: center;
                z-index: 1050; /* Higher z-index to ensure it's above everything */
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Add shadow for emphasis */
            }

            .mobile-close-btn:hover {
                background-color: rgba(255, 255, 255, 0.3);
            }

            /* Hide desktop toggle in mobile */
            .sidebar-header .toggle-btn {
                display: none;
            }

            .mobile-close-btn {
                display: block;
                font-size: 1.8rem; /* Make it slightly larger */
                color: white;
                background-color: rgba(255, 255, 255, 0.1); /* Add slight background */
                border-radius: 50%;
                width: 40px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .mobile-close-btn:hover {
                background-color: rgba(255, 255, 255, 0.2);
            }

            .sidebar-container.show .floating-close-btn {
                display: flex;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar Container -->
    <div class="sidebar-container" id="sidebar">
        <!-- Header Inside Sidebar -->
        <div class="sidebar-header">
            <button class="toggle-btn" id="toggle-btn">
                <i class='bx bx-menu'></i>
            </button>
            <div class="logo">Laptop Zone</div>
            <button class="mobile-close-btn" id="mobile-close-btn">
                <i class='bx bx-menu'></i>
            </button>
        </div>
        
        <!-- Floating Close Button for Mobile -->
        <button class="floating-close-btn" id="floating-close-btn">
            <i class='bx bx-menu'></i>
        </button>
        
        <!-- Sidebar Menu with Bootstrap Nav -->
        <div class="sidebar-menu">
            <ul class="nav flex-column">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class='bx bx-grid-alt nav-icon'></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                
                <!-- User Management with Submenu -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#userSubmenu" role="button">
                        <i class='bx bx-user nav-icon'></i>
                        <span class="nav-text">User Management</span>
                        <i class='bx bx-chevron-down ms-auto'></i>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.users*') ? 'show' : '' }} submenu" id="userSubmenu">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">All Users</a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <!-- Products with Submenu -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#productSubmenu" role="button">
                        <i class='bx bx-package nav-icon'></i>
                        <span class="nav-text">Products</span>
                        <i class='bx bx-chevron-down ms-auto'></i>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.products*') ? 'show' : '' }} submenu" id="productSubmenu">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.products') }}" class="nav-link {{ request()->routeIs('admin.products') ? 'active' : '' }}">All Products</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('admin.categories') }}" class="nav-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}">Categories</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.inventory') }}" class="nav-link {{ request()->routeIs('admin.inventory') ? 'active' : '' }}">Inventory</a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
                
                
                <!-- Logout -->
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class='bx bx-log-out nav-icon'></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Main Content Area -->
    <div class="main-container">
        <!-- Page Header -->
        <header class="page-header">
            <button class="header-toggle" id="header-toggle">
                <i class='bx bx-menu'></i>
            </button>
            <h1 class="page-title">Admin Panel</h1>
            <!-- Header Icons (Right Side) -->
            <div class="ms-auto d-flex align-items-center me-3">
                <!-- Notifications Dropdown -->
                <div class="dropdown me-3">
                    <button class="btn btn-link notification-toggle p-0 position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-bell fs-3 '></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                            <span class="visually-hidden">unread notifications</span>
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="notificationDropdown">
                        <li><h6 class="dropdown-header">Notifications</h6></li>
                        <li><a class="dropdown-item" href="#">
                            <div class="notification-item">
                                <div class="notification-icon"><i class='bx bx-package text-primary'></i></div>
                                <div class="notification-content">
                                    <p class="mb-0">New product added</p>
                                    <small class="text-muted">2 mins ago</small>
                                </div>
                            </div>
                        </a></li>
                        <li><a class="dropdown-item" href="#">
                            <div class="notification-item">
                                <div class="notification-icon"><i class='bx bx-user text-success'></i></div>
                                <div class="notification-content">
                                    <p class="mb-0">New user registered</p>
                                    <small class="text-muted">40 mins ago</small>
                                </div>
                            </div>
                        </a></li>
                        <li><a class="dropdown-item" href="#">
                            <div class="notification-item">
                                <div class="notification-icon"><i class='bx bx-message text-info'></i></div>
                                <div class="notification-content">
                                    <p class="mb-0">New message received</p>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                            </div>
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
                    </ul>
                </div>
                
                <!-- Profile Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-link  profile-toggle p-0 position-relative" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="profile-avatar">
                            <img src="{{ asset('assets/user.png') }}" height="40" width="40" alt="Profile" class="rounded-circle">
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><h6 class="dropdown-header">Admin User</h6></li>
                        <li><a class="dropdown-item" href="#"><i class='bx bx-user-circle me-2'></i> My Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class='bx bx-cog me-2'></i> Account Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="{{route('logout')}}"><i class='bx bx-log-out me-2'></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>
        
        <!-- Page Content -->
        <main class="page-content p-3">
           {{ $slot }}  
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggle-btn');
            const headerToggle = document.getElementById('header-toggle');
            const mobileCloseBtn = document.getElementById('mobile-close-btn');
            const floatingCloseBtn = document.getElementById('floating-close-btn');
            const sidebar = document.getElementById('sidebar');
            
            // Desktop toggle functionality
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                // Toggle icon
                const icon = toggleBtn.querySelector('i');
                if (icon.classList.contains('bx-menu')) {
                    icon.classList.replace('bx-menu', 'bx-menu');
                } else {
                    icon.classList.replace('bx-menu', 'bx-menu');
                }
            });
            
            // Mobile toggle functionality to open sidebar
            headerToggle.addEventListener('click', function() {
                sidebar.classList.add('show');
                const headerIcon = headerToggle.querySelector('i');
                headerIcon.classList.replace('bx-menu', 'bx-menu');
            });
            
            // Function to close sidebar
            function closeSidebar() {
                sidebar.classList.remove('show');
                const headerIcon = headerToggle.querySelector('i');
                headerIcon.classList.replace('bx-menu', 'bx-menu');
            }
            
            // Add click listeners to close buttons
            if (mobileCloseBtn) {
                mobileCloseBtn.addEventListener('click', closeSidebar);
            }
            
            if (floatingCloseBtn) {
                floatingCloseBtn.addEventListener('click', closeSidebar);
            }
            
            // Close sidebar when clicking on a link (mobile)
            const navLinks = document.querySelectorAll('.nav-link:not([data-bs-toggle="collapse"])');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth <= 992) {
                        sidebar.classList.remove('show');
                        const headerIcon = headerToggle.querySelector('i');
                        headerIcon.classList.replace('bx-menu', 'bx-menu');
                    }
                });
            });
            
            // Handle submenu active states
            const submenuLinks = document.querySelectorAll('.submenu .nav-link');
            submenuLinks.forEach(link => {
                link.addEventListener('click', function() {
                    submenuLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>
</body>
</html>