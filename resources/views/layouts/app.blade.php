<!DOCTYPE html>
<html lang="id" class="h-full bg-zinc-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Frozeria — @yield('title', 'Dashboard')</title>

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts: DM Sans --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['DM Sans', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        /* Transisi halus untuk semua elemen interaktif */
        * {
            transition-property: color, background-color, border-color, opacity, box-shadow;
            transition-duration: 150ms;
        }

        /* Scrollbar tipis */
        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #d1d5db;
            border-radius: 99px;
        }
    </style>

    @stack('styles')
</head>

<body class="h-full text-zinc-800 antialiased">
    <div class="min-h-screen flex flex-col">

        {{-- ── Navbar --}}
        <header class="bg-white border-b border-zinc-200 sticky top-0 z-30">
            <div class="max-w-7xl mx-auto px-4 sm:px-6">
                <div class="flex items-center justify-between h-14">

                    {{-- Brand --}}
                    <div class="flex items-center gap-6">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <span class="font-bold text-zinc-900 tracking-tight">Frozeria Stok</span>
                        </a>

                        {{-- Nav links --}}
                        <nav class="hidden sm:flex items-center gap-1">
                            <a href="{{ route('dashboard') }}"
                                class="px-3 py-1.5 rounded-md text-sm font-medium
                                  {{ request()->routeIs('dashboard') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('kategori.index') }}"
                                class="px-3 py-1.5 rounded-md text-sm font-medium
                                  {{ request()->routeIs('kategori.*') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50' }}">
                                Kategori
                            </a>
                            <a href="{{ route('bantuan') }}"
                                class="px-3 py-1.5 rounded-md text-sm font-medium
                                  {{ request()->routeIs('bantuan') ? 'bg-zinc-100 text-zinc-900' : 'text-zinc-500 hover:text-zinc-900 hover:bg-zinc-50' }}">
                                Bantuan
                            </a>
                        </nav>
                    </div>

                    {{-- Tombol Tambah Barang --}}
                    @if (!request()->routeIs('barang.create'))
                        <a href="{{ route('barang.create') }}"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-brand-600 hover:bg-brand-700
                              text-white text-sm font-semibold rounded-lg shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Barang
                        </a>
                    @endif

                </div>
            </div>
        </header>

        {{-- ── Flash Notification  --}}
        @if (session('success'))
            <div id="flash-msg"
                class="fixed top-4 right-4 z-50 flex items-center gap-3 px-4 py-3
                    bg-white border border-zinc-200 rounded-xl shadow-lg max-w-sm">
                <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-zinc-800">{{ session('success') }}</p>
                <button onclick="document.getElementById('flash-msg').remove()"
                    class="ml-auto text-zinc-400 hover:text-zinc-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div id="flash-msg"
                class="fixed top-4 right-4 z-50 flex items-center gap-3 px-4 py-3
                    bg-white border border-zinc-200 rounded-xl shadow-lg max-w-sm">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-zinc-800">{{ session('error') }}</p>
                <button onclick="document.getElementById('flash-msg').remove()"
                    class="ml-auto text-zinc-400 hover:text-zinc-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- ── Konten Utama --}}
        <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 py-6">
            @yield('content')
        </main>

    </div>

    {{-- ── Modal Konfirmasi Hapus  --}}
    <div id="modal-hapus" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4"
        onclick="if(event.target===this) tutupModal()">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>

        {{-- Dialog --}}
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-sm p-6">
            <div class="flex gap-4">
                {{-- Ikon peringatan --}}
                <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                    </svg>
                </div>

                <div>
                    <h3 id="modal-judul" class="font-semibold text-zinc-900 mb-1">Hapus barang?</h3>
                    <p id="modal-pesan" class="text-sm text-zinc-500 leading-relaxed">
                        Data akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
            </div>

            <div class="flex gap-2 mt-6 justify-end">
                <button onclick="tutupModal()"
                    class="px-4 py-2 text-sm font-medium text-zinc-700 bg-zinc-100
                           hover:bg-zinc-200 rounded-lg">
                    Batal
                </button>
                <form id="form-hapus" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 text-sm font-semibold text-white bg-red-500
                               hover:bg-red-600 rounded-lg shadow-sm">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // ── Auto-dismiss flash setelah 4 detik 
        setTimeout(() => {
            const flash = document.getElementById('flash-msg');
            if (flash) flash.remove();
        }, 4000);

        // ── Modal Hapus 
        function konfirmasiHapus(action, nama, jenis = 'barang') {
            document.getElementById('form-hapus').action = action;
            document.getElementById('modal-judul').textContent = `Hapus ${jenis}?`;
            document.getElementById('modal-pesan').innerHTML =
                `Data <strong class="text-zinc-800">${nama}</strong> akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan.`;
            document.getElementById('modal-hapus').classList.remove('hidden');
        }

        function tutupModal() {
            document.getElementById('modal-hapus').classList.add('hidden');
        }
    </script>

    @stack('scripts')
</body>

</html>
