<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>{{ $title ?? 'Page Title' }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Add BoxIcons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Livewire Styles -->
    @livewireStyles
    @stack('styles')
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");
    
        :root {
            --header-height: 3rem;
            --nav-width: 68px;
            --first-color: #4723D9;
            --first-color-light: #AFA5D9;
            --white-color: #F7F6FB;
            --body-font: 'Nunito', sans-serif;
            --normal-font-size: 1rem;
            --z-fixed: 100
        }
    
        *,
        ::before,
        ::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
    
        body {
            position: relative;
            margin: var(--header-height) 0 0 0;
            padding-left: calc(var(--nav-width) + 188px); /* Default expanded padding */
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            transition: .5s;
            background-color: var(--white-color);
        }
    
        a {
            text-decoration: none;
            color: inherit;
        }
    
        .header {
            width: 100%;
            height: var(--header-height);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1rem;
            background-color: var(--white-color);
            z-index: var(--z-fixed);
            transition: .5s;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
    
        .header_toggle {
            color: var(--first-color);
            font-size: 1.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
        }
    
        .header_toggle i {
            transition: .3s;
        }
    
        .header_img {
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid var(--first-color);
        }
    
        .header_img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    
        .l-navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--nav-width); /* Default collapsed width */
            height: 100vh;
            background-color: var(--first-color);
            padding: .5rem 1rem 0 0;
            transition: .5s;
            z-index: var(--z-fixed);
        }
    
        .l-navbar.show {
            width: calc(var(--nav-width) + 156px);
        }
    
        .nav {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            padding-bottom: 2rem;
        }
    
        .nav_logo,
        .nav_link {
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: 1rem;
            padding: .5rem 0 .5rem 1.5rem;
            position: relative;
        }
    
        .nav_logo {
            margin-bottom: 2rem;
            color: var(--white-color);
        }
    
        .nav_logo-icon {
            font-size: 1.25rem;
            color: var(--white-color);
        }
    
        .nav_logo-name {
            color: var(--white-color);
            font-weight: 700;
            opacity: 0;
            display: none;
            transition: .3s;
        }
    
        .nav_link {
            color: var(--first-color-light);
            margin-bottom: 1.5rem;
            transition: .3s;
        }
    
        .nav_link:hover {
            color: var(--white-color);
        }
    
        .nav_icon {
            font-size: 1.25rem;
        }
    
        .nav_name {
            opacity: 0;
            display: none;
            transition: .3s;
        }
    
        .show .nav_logo-name,
        .show .nav_name {
            opacity: 1;
            display: block;
        }
    
        .body-pd {
            padding-left: calc(var(--nav-width) + 1rem);
        }
    
        .active {
            color: var(--white-color);
        }
    
        .active::before {
            content: '';
            position: absolute;
            left: 0;
            width: 2px;
            height: 32px;
            background-color: var(--white-color);
        }
    
        .height-100 {
            height: 100vh;
            padding: 2rem;
        }
    
        @media screen and (min-width: 768px) {
            body {
                margin: calc(var(--header-height) + 1rem) 0 0 0;
                padding-left: var(--nav-width);
                transition: .5s;
            }
    
            body.body-pd {
                padding-left: calc(var(--nav-width) + 156px);
            }
    
            .header {
                height: calc(var(--header-height) + 1rem);
                padding: 0 2rem 0 calc(var(--nav-width) + 1rem);
                transition: .5s;
            }
    
            .header.body-pd {
                padding-left: calc(var(--nav-width) + 188px);
            }
    
            .l-navbar {
                left: 0;
                padding: 1rem 1rem 0 0;
            }
    
            .show {
                width: calc(var(--nav-width) + 156px);
            }
        }
    
        @media screen and (max-width: 767.98px) {
            body {
                padding-left: 1rem;
            }
            
            .l-navbar {
                left: -100%;
            }
            
            .l-navbar.show {
                left: 0;
                width: calc(var(--nav-width) + 156px);
            }
        }
    </style>
</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <div class="header_img">
            <img src="https://i.imgur.com/hczKIze.jpg" alt="">
        </div>
    </header>
    <div class="l-navbar show" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <i class='bx bx-layer nav_logo-icon'></i>
                    <span class="nav_logo-name">BBBootstrap</span>
                </a>
                <div class="nav_list">
                    <a href="#" class="nav_link active">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Dashboard</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Users</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-message-square-detail nav_icon'></i>
                        <span class="nav_name">Messages</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-bookmark nav_icon'></i>
                        <span class="nav_name">Bookmark</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-folder nav_icon'></i>
                        <span class="nav_name">Files</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-bar-chart-alt-2 nav_icon'></i>
                        <span class="nav_name">Stats</span>
                    </a>
                </div>
            </div>
            <a href="#" class="nav_link">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span>
            </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light">
        <h4>{{ $slot }}</h4>
    </div>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha384-vtXRMe3mGCbOeY7l30aIg8H9p3GdeSe4IFlP6G8JMa7o7lXvnz3GFKzPxzJdPfGK" crossorigin="anonymous">
    </script>

    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>


    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                      nav = document.getElementById(navId),
                      bodypd = document.getElementById(bodyId),
                      headerpd = document.getElementById(headerId);

                if (!toggle || !nav || !bodypd || !headerpd) {
                    console.error('One or more elements not found');
                    return;
                }

                let isExpanded = window.innerWidth >= 768;

                function updateNavState() {
                    if (window.innerWidth >= 768) {
                        // Desktop view
                        nav.classList.add('show');
                        if (isExpanded) {
                            bodypd.classList.add('body-pd');
                            headerpd.classList.add('body-pd');
                        } else {
                            bodypd.classList.remove('body-pd');
                            headerpd.classList.remove('body-pd');
                        }
                    } else {
                        // Mobile view
                        nav.classList.remove('show');
                        bodypd.classList.remove('body-pd');
                        headerpd.classList.remove('body-pd');
                    }
                }

                // Initial state
                updateNavState();

                // Toggle button click handler
                toggle.addEventListener('click', () => {
                    if (window.innerWidth >= 768) {
                        // Desktop view - toggle expanded state
                        isExpanded = !isExpanded;
                        nav.classList.toggle('show');
                        toggle.querySelector('i').classList.toggle('bx-x');
                        bodypd.classList.toggle('body-pd');
                        headerpd.classList.toggle('body-pd');
                    } else {
                        // Mobile view - toggle visibility
                        nav.classList.toggle('show');
                        toggle.querySelector('i').classList.toggle('bx-x');
                    }
                });

                // Handle window resize
                window.addEventListener('resize', updateNavState);
            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');

            // Active link
            const linkColor = document.querySelectorAll('.nav_link');
            
            function colorLink() {
                linkColor.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            }
            
            linkColor.forEach(l => l.addEventListener('click', colorLink));
        });
    </script>
    <!-- Livewire Scripts -->
    @livewireScripts
</body>

</html>
