<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin' }} — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f7f7f5] text-ink">
    <div class="flex min-h-screen">
        <aside data-sidebar
               class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full transform border-r border-black/10 bg-white p-6 transition-transform duration-300 md:translate-x-0">
            <a href="{{ route('home') }}" class="font-serif text-xl">{{ config('app.name') }}</a>
            <p class="mt-1 text-xs uppercase tracking-widest2 text-ink/40">Admin</p>

            <nav class="mt-10 space-y-6">
                <div>
                    <a href="{{ route('admin.dashboard') }}"
                       class="block rounded px-3 py-2 text-sm transition {{ request()->routeIs('admin.dashboard') ? 'bg-ink text-white' : 'text-ink/70 hover:bg-black/5' }}">
                        Dashboard
                    </a>
                </div>

                <div>
                    <p class="px-3 text-xs uppercase tracking-widest2 text-ink/30">Content</p>
                    <div class="mt-2 space-y-1">
                        @foreach ([
                            'admin.products' => 'Products',
                            'admin.refills' => 'Refill Collection',
                            'admin.fragrance-notes' => 'Fragrance'
                        ] as $routeGroup => $label)
                            <a href="{{ route($routeGroup . '.index') }}"
                               class="block rounded px-3 py-2 text-sm transition {{ request()->routeIs($routeGroup . '.*') ? 'bg-ink text-white' : 'text-ink/70 hover:bg-black/5' }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div>
                    <p class="px-3 text-xs uppercase tracking-widest2 text-ink/30">Messages</p>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('admin.messages.index') }}"
                           class="flex items-center justify-between rounded px-3 py-2 text-sm transition {{ request()->routeIs('admin.messages.*') ? 'bg-ink text-white' : 'text-ink/70 hover:bg-black/5' }}">
                            Contact Messages
                            @if (($unreadCount ?? 0) > 0)
                                <span class="ml-2 inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-gold px-1.5 text-[11px] font-semibold text-white">
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                    </div>
                </div>

                <div>
                    <p class="px-3 text-xs uppercase tracking-widest2 text-ink/30">General</p>
                    <div class="mt-2 space-y-1">
                        <a href="{{ route('admin.settings.edit') }}"
                           class="block rounded px-3 py-2 text-sm transition {{ request()->routeIs('admin.settings.*') ? 'bg-ink text-white' : 'text-ink/70 hover:bg-black/5' }}">
                            Settings
                        </a>
                    </div>
                </div>
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="mt-10">
                @csrf
                <button type="submit" class="w-full rounded border border-black/10 px-3 py-2 text-left text-sm text-ink/70 hover:bg-black/5">
                    Logout
                </button>
            </form>
        </aside>

        <div class="flex-1 md:ml-64">
            <header class="flex items-center justify-between border-b border-black/10 bg-white px-6 py-4 md:hidden">
                <button type="button" data-sidebar-toggle class="text-sm uppercase tracking-widest2">Menu</button>
                <span class="font-serif">{{ config('app.name') }}</span>
            </header>

            <main class="p-6 md:p-10">
                @if (session('status'))
                    <div class="mb-6 rounded border border-gold/40 bg-gold/10 px-4 py-3 text-sm text-ink">
                        {{ session('status') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 rounded border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700">
                        {{ session('error') }}
                    </div>
                @endif

                <h1 class="font-serif text-2xl">{{ $title ?? 'Dashboard' }}</h1>

                <div class="mt-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
