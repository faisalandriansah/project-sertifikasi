@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- ── Card Statistik --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6">

        {{-- Total Barang --}}
        <div class="bg-white rounded-xl border border-zinc-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-zinc-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-zinc-400 uppercase tracking-wide">Total Barang</p>
                    <p class="text-3xl font-bold text-zinc-900">{{ $statistik['total_barang'] }}</p>
                </div>
            </div>
        </div>

        {{-- Total Kategori --}}
        <div class="bg-white rounded-xl border border-zinc-200 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-zinc-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-zinc-400 uppercase tracking-wide">Total Kategori</p>
                    <p class="text-3xl font-bold text-zinc-900">{{ $statistik['total_kategori'] }}</p>
                </div>
            </div>
        </div>

        {{-- Stok Menipis --}}
        <div class="bg-amber-50 rounded-xl border border-amber-100 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-amber-500 uppercase tracking-wide">Stok Menipis</p>
                    <p class="text-3xl font-bold text-amber-600">{{ $statistik['stok_menipis'] }}</p>
                </div>
            </div>
        </div>

        {{-- Stok Habis --}}
        <div class="bg-red-50 rounded-xl border border-red-100 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs font-medium text-red-400 uppercase tracking-wide">Stok Habis</p>
                    <p class="text-3xl font-bold text-red-600">{{ $statistik['stok_habis'] }}</p>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Filter & Search --}}
    <div class="bg-white rounded-xl border border-zinc-200 p-3 mb-4">
        <form method="GET" action="{{ route('dashboard') }}" class="flex flex-col sm:flex-row gap-2">

            {{-- Search --}}
            <div class="relative flex-1">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="cari" value="{{ $keyword }}" placeholder="Cari nama barang..."
                    class="w-full pl-9 pr-4 py-2 text-sm bg-zinc-50 border border-zinc-200
                          rounded-lg outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
            </div>

            {{-- Filter Kategori --}}
            <select name="kategori_id" onchange="this.form.submit()"
                class="px-3 py-2 text-sm bg-zinc-50 border border-zinc-200 rounded-lg
                       outline-none focus:ring-2 focus:ring-brand-500 cursor-pointer sm:w-48">
                <option value="">Semua kategori</option>
                @foreach ($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ $kategoriId == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>

            {{-- Tombol Cari --}}
            <button type="submit"
                class="px-4 py-2 text-sm font-semibold bg-brand-600 hover:bg-brand-700
                       text-white rounded-lg shrink-0">
                Cari
            </button>

        </form>
    </div>

    {{-- ── Tabel Barang --}}
    <div class="bg-white rounded-xl border border-zinc-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-zinc-100 bg-zinc-50/80">
                        <th class="text-left px-4 py-3 font-semibold text-zinc-500 text-xs uppercase tracking-wide">
                            Nama Barang
                        </th>
                        <th class="text-left px-4 py-3 font-semibold text-zinc-500 text-xs uppercase tracking-wide">
                            Kategori
                        </th>
                        <th class="text-left px-4 py-3 font-semibold text-zinc-500 text-xs uppercase tracking-wide">
                            Stok
                        </th>
                        <th class="text-left px-4 py-3 font-semibold text-zinc-500 text-xs uppercase tracking-wide">
                            Satuan
                        </th>
                        <th class="text-left px-4 py-3 font-semibold text-zinc-500 text-xs uppercase tracking-wide">
                            Harga Jual
                        </th>
                        <th class="text-center px-4 py-3 font-semibold text-zinc-500 text-xs uppercase tracking-wide">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-100">
                    @forelse ($barangs as $barang)
                        <tr class="hover:bg-zinc-50/50 group">

                            {{-- Nama --}}
                            <td class="px-4 py-3 font-medium text-zinc-900">
                                {{ $barang->nama_barang }}
                            </td>

                            {{-- Kategori --}}
                            <td class="px-4 py-3">
                                @if ($barang->kategori)
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-md text-xs
                                             font-medium bg-zinc-100 text-zinc-600">
                                        {{ $barang->kategori->nama_kategori }}
                                    </span>
                                @else
                                    <span class="text-zinc-300">—</span>
                                @endif
                            </td>

                            {{-- Stok dengan badge warna --}}
                            <td class="px-4 py-3">
                                @if ($barang->jumlah_stok === 0)
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-xs
                                             font-semibold bg-red-100 text-red-700">
                                        {{ $barang->jumlah_stok }}
                                    </span>
                                @elseif ($barang->jumlah_stok < 20)
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-xs
                                             font-semibold bg-amber-100 text-amber-700">
                                        {{ $barang->jumlah_stok }}
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-xs
                                             font-semibold bg-emerald-100 text-emerald-700">
                                        {{ $barang->jumlah_stok }}
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3 text-zinc-600">{{ $barang->satuan }}</td>
                            <td class="px-4 py-3 text-zinc-700 font-medium">{{ $barang->harga_jual_format }}</td>

                            {{-- Aksi --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-1.5">
                                    <!-- Diubah dari justify-end menjadi justify-center -->
                                    <a href="{{ route('barang.show', $barang) }}"
                                        class="px-2.5 py-1 text-xs font-medium text-zinc-600 bg-zinc-100 hover:bg-zinc-200 rounded-md">
                                        Detail
                                    </a>
                                    <a href="{{ route('barang.edit', $barang) }}"
                                        class="px-2.5 py-1 text-xs font-medium text-brand-700 bg-brand-50 hover:bg-brand-100 rounded-md">
                                        Edit
                                    </a>
                                    <button type="button"
                                        onclick="konfirmasiHapus('{{ route('barang.destroy', $barang) }}', '{{ $barang->nama_barang }}')"
                                        class="px-2.5 py-1 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-md">
                                        Hapus
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-16 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <svg class="w-10 h-10 text-zinc-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4" />
                                    </svg>
                                    <p class="text-sm text-zinc-400">Tidak ada barang ditemukan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer pagination --}}
        <div class="px-4 py-3 border-t border-zinc-100 flex items-center justify-between bg-zinc-50/50">
            <p class="text-xs text-zinc-400">
                Menampilkan {{ $barangs->firstItem() ?? 0 }}–{{ $barangs->lastItem() ?? 0 }}
                dari {{ $barangs->total() }} barang
            </p>
            {{ $barangs->links('pagination::tailwind') }}
        </div>
    </div>

@endsection
