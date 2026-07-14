<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Dashboard' }} - KlinikKu</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui'] },
                    colors: {
                        brand: {
                            50: '#effcf9', 100: '#c7f5eb', 200: '#94ead9',
                            400: '#2dd4bf', 500: '#0f9d8f', 600: '#0b7a70',
                            700: '#0a5e57', 800: '#0c443f', 900: '#0b3b3c',
                        },
                    },
                    boxShadow: {
                        card: '0 1px 2px rgba(15, 23, 42, 0.04), 0 8px 24px -12px rgba(15, 23, 42, 0.08)',
                    },
                },
            },
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; }
    </style>
    @stack('head')
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
    <div class="min-h-screen flex">

        {{-- Sidebar (desktop) --}}
        <aside class="hidden lg:flex lg:flex-col lg:w-72 bg-brand-900 text-teal-50 shrink-0 sticky top-0 h-screen">
            <div class="h-20 flex items-center gap-3 px-7 border-b border-white/10">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-brand-400 to-brand-500 flex items-center justify-center text-brand-900 font-extrabold text-lg shadow-card">K</div>
                <div>
                    <p class="font-extrabold text-white leading-tight tracking-tight">KlinikKu</p>
                    <p class="text-[11px] text-brand-200/80 leading-tight">Sistem Pendaftaran Pasien</p>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 text-[13.5px] overflow-y-auto">
                <p class="px-3 pb-2 text-[10.5px] font-bold uppercase tracking-widest text-brand-300/70">Menu Utama</p>
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="dashboard">Dashboard</x-nav-link>
                <x-nav-link href="{{ route('pasien.index') }}" :active="request()->routeIs('pasien.*')" icon="users">Data Pasien</x-nav-link>
                <x-nav-link href="{{ route('dokter.index') }}" :active="request()->routeIs('dokter.*')" icon="heart-pulse">Data Dokter</x-nav-link>
                <x-nav-link href="{{ route('jadwal.index') }}" :active="request()->routeIs('jadwal.*')" icon="calendar">Jadwal Periksa</x-nav-link>
                <x-nav-link href="{{ route('antrian.index') }}" :active="request()->routeIs('antrian.*')" icon="ticket">Antrian</x-nav-link>
                <x-nav-link href="{{ route('rekam-medis.index') }}" :active="request()->routeIs('rekam-medis.*')" icon="clipboard">Rekam Medis</x-nav-link>

                <p class="px-3 pt-6 pb-2 text-[10.5px] font-bold uppercase tracking-widest text-brand-300/70">Akun</p>
                <x-nav-link href="{{ route('profile.edit') }}" :active="request()->routeIs('profile.edit')" icon="cog">Profil Saya</x-nav-link>
            </nav>

            <div class="p-5 border-t border-white/10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-full bg-brand-400/20 text-brand-200 flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-brand-300 capitalize">{{ auth()->user()->getRoleNames()->first() ?? '-' }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex items-center justify-center gap-2 text-xs font-semibold text-brand-100/90 hover:text-white bg-white/5 hover:bg-white/10 rounded-lg py-2 transition">
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- Mobile top bar --}}
        <div x-data="{ mobileOpen: false }" class="lg:hidden w-full">
            <div class="fixed top-0 inset-x-0 z-30 bg-brand-900 text-white flex items-center justify-between px-4 h-16 shadow-card">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-brand-400 to-brand-500 flex items-center justify-center text-brand-900 font-extrabold">K</div>
                    <span class="font-extrabold tracking-tight">KlinikKu</span>
                </div>
                <button @click="mobileOpen = !mobileOpen" class="p-2">
                    <x-icon name="menu" class="w-6 h-6" />
                </button>
            </div>
            <div x-show="mobileOpen" x-cloak @click.away="mobileOpen = false"
                 class="fixed top-16 inset-x-0 z-20 bg-brand-900 text-teal-50 p-4 space-y-1 text-sm shadow-xl">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="dashboard">Dashboard</x-nav-link>
                <x-nav-link href="{{ route('pasien.index') }}" :active="request()->routeIs('pasien.*')" icon="users">Data Pasien</x-nav-link>
                <x-nav-link href="{{ route('dokter.index') }}" :active="request()->routeIs('dokter.*')" icon="heart-pulse">Data Dokter</x-nav-link>
                <x-nav-link href="{{ route('jadwal.index') }}" :active="request()->routeIs('jadwal.*')" icon="calendar">Jadwal Periksa</x-nav-link>
                <x-nav-link href="{{ route('antrian.index') }}" :active="request()->routeIs('antrian.*')" icon="ticket">Antrian</x-nav-link>
                <x-nav-link href="{{ route('rekam-medis.index') }}" :active="request()->routeIs('rekam-medis.*')" icon="clipboard">Rekam Medis</x-nav-link>
                <form method="POST" action="{{ route('logout') }}" class="pt-2">
                    @csrf
                    <button class="w-full text-center text-sm font-semibold text-white bg-white/10 rounded-lg py-2">Keluar</button>
                </form>
            </div>
            <div class="h-16"></div>
        </div>

        {{-- Main content --}}
        <div class="flex-1 flex flex-col min-w-0">
            <header class="hidden lg:flex h-20 bg-white/80 backdrop-blur border-b border-slate-200 items-center justify-between px-8 sticky top-0 z-10">
                <div>
                    <h1 class="text-xl font-extrabold text-slate-900 tracking-tight">{{ $title ?? 'Dashboard' }}</h1>
                    @isset($subtitle)
                        <p class="text-sm text-slate-500">{{ $subtitle }}</p>
                    @endisset
                </div>
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-brand-600 font-medium capitalize">{{ auth()->user()->getRoleNames()->first() ?? '-' }}</p>
                    </div>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="w-10 h-10 rounded-full bg-brand-100 text-brand-700 flex items-center justify-center font-bold">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </button>
                        <div x-show="open" x-cloak
                            class="absolute right-0 mt-2 w-44 bg-white border border-slate-200 rounded-xl shadow-card py-2 z-20">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-slate-50">Profil Saya</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Keluar</button>
                            </form>
                        </div>
                    </div>
                </div>  
            </header>

            <main class="flex-1 p-4 lg:p-8 max-w-[1400px] w-full mx-auto">
                @if (session('success'))
                    <div class="mb-6 rounded-xl bg-brand-50 border border-brand-200 text-brand-800 px-4 py-3 text-sm font-medium flex items-center gap-2">
                        <x-icon name="check-circle" class="w-5 h-5 shrink-0" /> {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 rounded-xl bg-red-50 border border-red-200 text-red-800 px-4 py-3 text-sm font-medium flex items-center gap-2">
                        <x-icon name="exclamation" class="w-5 h-5 shrink-0" /> {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
