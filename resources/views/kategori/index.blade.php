@extends('layouts.app')

@section('title', 'Kategori')

@section('content')

{{-- ── Header ───────────────────────────────────────────────────────────────── --}}
<div class="flex items-center justify-between mb-6">
    <h1 class="text-lg font-bold text-zinc-900">Daftar Kategori</h1>
    <a href="{{ route('kategori.create') }}"
       class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-brand-600 hover:bg-brand-700
              text-white text-sm font-semibold rounded-lg shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Kategori
    </a>
</div>

{{-- ── Search ───────────────────────────────────────────────────────────────── --}}
<div class="bg-white rounded-xl border border-zinc-200 p-3 mb-4">
    <form method="GET" action="{{ route('kategori.index') }}">
        <div class="relative">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-zinc-400"
                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" name="cari"
                   value="{{ $keyword }}"
                   placeholder="Cari kategori..."
                   onchange="this.form.submit()"
                   class="w-full pl-9 pr-4 py-2 text-sm bg-zinc-50 border border-zinc-200
                          rounded-lg outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
        </div>
    </form>
</div>

{{-- ── Tabel Kategori ───────────────────────────────────────────────────────── --}}
<div class="bg-white rounded-xl border border-zinc-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="border-b border-zinc-100 bg-zinc-50/80">
                <th class="text-left px-4 py-3 font-semibold text-zinc-500 text-xs uppercase tracking-wide">
                    Nama Kategori
                </th>
                <th class="text-left px-4 py-3 font-semibold text-zinc-500 text-xs uppercase tracking-wide">
                    Jumlah Barang
                </th>
                <th class="text-left px-4 py-3 font-semibold text-zinc-500 text-xs uppercase tracking-wide">
                    Dibuat
                </th>
                <th class="text-right px-4 py-3 font-semibold text-zinc-500 text-xs uppercase tracking-wide">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-100">
            @forelse ($kategoris as $kat)
                <tr class="hover:bg-zinc-50/50">
                    <td class="px-4 py-3 font-medium text-zinc-900">{{ $kat->nama_kategori }}</td>
                    <td class="px-4 py-3 text-zinc-500">{{ $kat->barangs_count }} barang</td>
                    <td class="px-4 py-3 text-zinc-500">{{ $kat->created_at->translatedFormat('d M Y') }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end gap-1.5">
                            <a href="{{ route('kategori.edit', $kat) }}"
                               class="px-2.5 py-1 text-xs font-medium text-brand-700 bg-brand-50
                                      hover:bg-brand-100 rounded-md">
                                Edit
                            </a>
                            <button type="button"
                                    onclick="konfirmasiHapus(
                                        '{{ route('kategori.destroy', $kat) }}',
                                        '{{ $kat->nama_kategori }}',
                                        'kategori'
                                    )"
                                    class="px-2.5 py-1 text-xs font-medium text-red-600 bg-red-50
                                           hover:bg-red-100 rounded-md">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-16 text-center">
                        <svg class="w-10 h-10 text-zinc-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        <p class="text-sm text-zinc-400">Belum ada kategori</p>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="px-4 py-3 border-t border-zinc-100 bg-zinc-50/50">
        <p class="text-xs text-zinc-400">{{ $kategoris->count() }} kategori terdaftar</p>
    </div>
</div>

@endsection