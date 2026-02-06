<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Penilaian UKT') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:300,400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Mobile Sidebar Styles */
            @media (max-width: 768px) {
                .sidebar {
                    position: fixed;
                    left: 0;
                    top: 0;
                    z-index: 50;
                    transform: translateX(-100%);
                    transition: transform 0.3s ease-in-out;
                }
                .sidebar.open {
                    transform: translateX(0);
                }
                .sidebar-overlay {
                    display: none;
                    position: fixed;
                    inset: 0;
                    background: rgba(0, 0, 0, 0.5);
                    z-index: 40;
                }
                .sidebar-overlay.open {
                    display: block;
                }
                .mobile-header {
                    display: flex !important;
                }
                .content-padding {
                    padding: 1rem !important;
                }
            }
            @media (min-width: 769px) {
                .mobile-header {
                    display: none !important;
                }
            }
            
            @media print {
                /* Reset global layout constraints */
                html, body, .h-full, .overflow-hidden, .overflow-auto, .overflow-y-auto {
                    height: auto !important;
                    overflow: visible !important;
                    width: 100% !important;
                    position: static !important;
                }
                
                /* Hide sidebar and navigation elements */
                .sidebar, .menu-item, .no-print, .mobile-header {
                    display: none !important;
                }
                
                /* Reset flex containers to allowed normal flow */
                .flex-1 {
                    flex: none !important;
                    display: block !important;
                }
                
                /* Ensure print container is visible */
                .print\:block {
                    display: block !important;
                }
                
                /* Hide screen-only elements */
                .print\:hidden {
                    display: none !important;
                }

                /* Layout specific resets */
                body {
                    background: white !important;
                    color: black !important;
                }
                
                #app {
                    margin: 0 !important;
                    padding: 0 !important;
                }
                
                /* Force page break settings if needed */
                table {
                    page-break-inside: auto;
                }
                tr {
                    page-break-inside: avoid;
                    page-break-after: auto;
                }
            }
        </style>
    </head>
    <body class="h-full gradient-bg text-white overflow-hidden font-sans antialiased">
        <!-- Mobile Overlay -->
        <div id="sidebar-overlay" class="sidebar-overlay" onclick="toggleSidebar()"></div>
        
        <div class="h-full w-full flex flex-col md:flex-row">
            <!-- Mobile Header -->
            <div class="mobile-header hidden items-center justify-between p-4 border-b border-white/10 bg-[#1a1a2e]/80 backdrop-blur-md no-print">
                <button onclick="toggleSidebar()" class="p-2 rounded-lg hover:bg-white/10 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <span class="font-bold text-sm">Penilaian UKT</span>
                </div>
                <div class="w-10"></div>
            </div>

            <!-- Sidebar -->
            <div id="sidebar" class="sidebar w-64 h-full flex-shrink-0 flex flex-col no-print border-r border-white/10 bg-[#1a1a2e]">
                <div class="p-6 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center shadow-lg shadow-red-500/30">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-bold text-lg leading-tight">Penilaian UKT</h2>
                            <p class="text-xs text-gray-400">Pagar Nusa</p>
                        </div>
                        <!-- Close button for mobile -->
                        <button onclick="toggleSidebar()" class="ml-auto p-1 rounded-lg hover:bg-white/10 md:hidden">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                    <a href="{{ route('dashboard') }}" onclick="closeSidebarOnMobile()" class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:text-white {{ request()->routeIs('dashboard') ? 'active bg-[#e94560]/20 text-white border-l-[3px] border-[#e94560]' : 'hover:bg-white/5' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Global Stats
                    </a>

                    <!-- User Management (Admin Only) -->
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('users.index') }}" onclick="closeSidebarOnMobile()" class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:text-white {{ request()->routeIs('users.*') ? 'active bg-[#e94560]/20 text-white border-l-[3px] border-[#e94560]' : 'hover:bg-white/5' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Kelola Petugas
                    </a>
                    
                    <a href="{{ route('soal.index') }}" onclick="closeSidebarOnMobile()" class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:text-white {{ request()->routeIs('soal.*') ? 'active bg-[#e94560]/20 text-white border-l-[3px] border-[#e94560]' : 'hover:bg-white/5' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        Kelola Soal
                    </a>
                    @endif

                    <div class="pt-4 pb-2">
                        <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Penilaian</p>
                    </div>

                    <a href="{{ route('penilaian.index') }}" onclick="closeSidebarOnMobile()" class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:text-white {{ request()->routeIs('penilaian.index') ? 'active bg-[#e94560]/20 text-white border-l-[3px] border-[#e94560]' : 'hover:bg-white/5' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"></path>
                        </svg>
                        Rekap Penilaian
                    </a>
                    
                    <a href="{{ route('penilaian.create') }}" onclick="closeSidebarOnMobile()" class="menu-item flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:text-white {{ request()->routeIs('penilaian.create') ? 'active bg-[#e94560]/20 text-white border-l-[3px] border-[#e94560]' : 'hover:bg-white/5' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Input Penilaian
                    </a>
                </nav>

                <div class="p-4 border-t border-white/10">
                    <div class="flex items-center gap-3 mb-4 px-2">
                        <div class="w-8 h-8 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-300 font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-sm font-medium truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400 capitalize">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 py-2 rounded-lg bg-white/5 hover:bg-red-500/20 hover:text-red-300 text-sm transition-colors border border-white/5 hover:border-red-500/30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col h-full overflow-hidden relative">
                <!-- Content Area -->
                <div class="flex-1 overflow-auto p-4 md:p-8 content-padding relative">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <script>
            function toggleSidebar() {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.toggle('open');
                overlay.classList.toggle('open');
            }
            
            function closeSidebarOnMobile() {
                if (window.innerWidth <= 768) {
                    const sidebar = document.getElementById('sidebar');
                    const overlay = document.getElementById('sidebar-overlay');
                    sidebar.classList.remove('open');
                    overlay.classList.remove('open');
                }
            }
        </script>
    </body>
</html>
