<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', $title ?? 'Overview') — {{ config('app.name') }} Admin</title>
    <meta name="theme-color" content="#111111">

    {{-- Favicon & App Icons (langsung dari images/Perfume.png) --}}
    <link rel="icon" type="image/png" href="{{ asset('images/Perfume.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/Perfume.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/Perfume.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f7f5] text-ink antialiased">
    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside data-sidebar
               class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col justify-between border-r border-[#111111]/10 bg-white p-6 transition-transform duration-300 md:translate-x-0">
            <div>
                {{-- Brand Logo & Badge --}}
                <div class="flex items-center justify-between border-b border-[#111111]/10 pb-5">
                    <a href="{{ route('home') }}" class="inline-block transition hover:opacity-80">
                        <img src="{{ asset('images/Perfume.png') }}" alt="{{ config('app.name') }}" class="h-6 object-contain">
                    </a>
                    <span class="rounded bg-[#b79a5a]/15 px-2 py-0.5 text-[9px] font-semibold uppercase tracking-widest text-[#b79a5a]">
                        Console
                    </span>
                </div>

                {{-- Navigation Links --}}
                <nav class="mt-8 space-y-6">
                    <div>
                        <a href="{{ route('admin.dashboard') }}"
                           class="flex items-center gap-3 px-3 py-2.5 text-xs font-medium uppercase tracking-wider transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#111111] text-white' : 'text-[#111111]/70 hover:bg-[#f7f7f5] hover:text-[#111111]' }}">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </div>

                    <div>
                        <p class="px-3 text-[10px] uppercase tracking-widest text-[#111111]/40 font-medium">Catalog</p>
                        <div class="mt-2 space-y-1">
                            @foreach ([
                                'admin.products' => 'Signature Products',
                                'admin.refills' => 'Refill Collection',
                                'admin.fragrance-notes' => 'Fragrance Notes'
                            ] as $routeGroup => $label)
                                <a href="{{ route($routeGroup . '.index') }}"
                                   class="flex items-center justify-between px-3 py-2 text-xs font-medium tracking-wide transition {{ request()->routeIs($routeGroup . '.*') ? 'bg-[#111111] text-white' : 'text-[#111111]/70 hover:bg-[#f7f7f5] hover:text-[#111111]' }}">
                                    <span>{{ $label }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <p class="px-3 text-[10px] uppercase tracking-widest text-[#111111]/40 font-medium">Communications</p>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('admin.messages.index') }}"
                               class="flex items-center justify-between px-3 py-2 text-xs font-medium tracking-wide transition {{ request()->routeIs('admin.messages.*') ? 'bg-[#111111] text-white' : 'text-[#111111]/70 hover:bg-[#f7f7f5] hover:text-[#111111]' }}">
                                <span>Messages &amp; Orders</span>
                                @if (($unreadCount ?? 0) > 0)
                                    <span class="inline-flex h-4 min-w-4 items-center justify-center rounded-full bg-[#b79a5a] px-1.5 text-[9px] font-semibold text-white">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </a>
                        </div>
                    </div>

                    <div>
                        <p class="px-3 text-[10px] uppercase tracking-widest text-[#111111]/40 font-medium">System</p>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('admin.settings.edit') }}"
                               class="flex items-center justify-between px-3 py-2 text-xs font-medium tracking-wide transition {{ request()->routeIs('admin.settings.*') ? 'bg-[#111111] text-white' : 'text-[#111111]/70 hover:bg-[#f7f7f5] hover:text-[#111111]' }}">
                                <span>Settings &amp; Fonnte</span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>

            {{-- Sidebar Footer --}}
            <div class="border-t border-[#111111]/10 pt-5 space-y-3">
                <a href="{{ route('home') }}" target="_blank" rel="noopener"
                   class="flex items-center justify-between px-3 py-2 text-xs font-medium text-[#111111]/60 hover:text-[#111111] transition hover:bg-[#f7f7f5]">
                    <span>Lihat Web Utama</span>
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center justify-between border border-[#111111]/15 px-3 py-2 text-xs font-medium text-[#111111]/70 hover:border-red-600 hover:text-red-600 hover:bg-red-50 transition">
                        <span>Keluar (Logout)</span>
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content Area --}}
        <div class="flex-1 md:ml-64 flex flex-col min-h-screen">
            {{-- Mobile Header --}}
            <header class="flex items-center justify-between border-b border-[#111111]/10 bg-white px-6 py-4 md:hidden">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/Perfume.png') }}" alt="{{ config('app.name') }}" class="h-5 object-contain">
                </a>
                <button type="button" data-sidebar-toggle class="p-2 text-xs font-medium uppercase tracking-widest text-[#111111]">
                    Menu
                </button>
            </header>

            <main class="flex-1 p-6 sm:p-8 lg:p-10 max-w-7xl w-full">
                {{-- Flash Notifications --}}
                @if (session('status'))
                    <div class="mb-6 border border-[#b79a5a]/40 bg-[#b79a5a]/10 p-4 text-xs font-medium text-[#111111] flex items-center gap-3">
                        <svg class="h-4 w-4 text-[#b79a5a] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 6 9 17l-5-5"/>
                        </svg>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 border border-red-500/30 bg-red-500/10 p-4 text-xs font-medium text-red-800 flex items-center gap-3">
                        <svg class="h-4 w-4 text-red-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                {{-- Page Header --}}
                <div class="mb-8">
                    <p class="section-label">Administration</p>
                    <h1 class="mt-1 font-serif text-3xl sm:text-4xl text-[#111111] font-normal tracking-tight">
                        @yield('title', $title ?? 'Dashboard')
                    </h1>
                </div>

                <div>
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
