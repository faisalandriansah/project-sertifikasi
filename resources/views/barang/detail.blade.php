@extends('layouts.app')

@section('title', 'Detail Barang')

@section('content')

{{-- ── Header  --}}
<div class="flex items-center justify-between mb-6">
    <div class="flex items-center gap-3">
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center gap-1.5 text-sm text-zinc-500 hover:text-zinc-900">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
        <span class="text-zinc-300">/</span>
        <h1 class="text-sm font-semibold text-zinc-900">Detail Barang</h1>
    </div>

    <div class="flex items-center gap-2">
        <a href="{{ route('barang.edit', $barang) }}"
           class="px-3.5 py-2 text-sm font-semibold text-brand-700 bg-brand-50
                  hover:bg-brand-100 rounded-lg">
            Edit Barang
        </a>
        <button type="button"
                onclick="konfirmasiHapus('{{ route('barang.destroy', $barang) }}', '{{ $barang->nama_barang }}')"
                class="px-3.5 py-2 text-sm font-semibold text-red-600 bg-red-50
                       hover:bg-red-100 rounded-lg">
            Hapus
        </button>
    </div>
</div>

{{-- ── Konten Detail --}}
<div class="bg-white rounded-2xl border border-zinc-200 overflow-hidden">

    {{-- Header barang: foto + nama + kategori --}}
    <div class="p-6 border-b border-zinc-100 flex items-center gap-5">

        {{-- Foto --}}
        @if ($barang->gambar)
            <img src="{{ asset('storage/' . $barang->gambar) }}"
                 alt="{{ $barang->nama_barang }}"
                 class="w-20 h-20 rounded-xl object-cover border border-zinc-200">
        @else
            <div class="w-20 h-20 rounded-xl bg-zinc-100 border border-zinc-200
                        flex items-center justify-center">
                <svg class="w-8 h-8 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        @endif

        <div>
            <h2 class="text-xl font-bold text-zinc-900 mb-1">{{ $barang->nama_barang }}</h2>
            @if ($barang->kategori)
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs
                             font-medium bg-brand-50 text-brand-700">
                    {{ $barang->kategori->nama_kategori }}
                </span>
            @endif
        </div>
    </div>

    {{-- Grid info --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-px bg-zinc-100">

        {{-- Jumlah stok --}}
        <div class="bg-white p-5">
            <p class="text-xs text-zinc-400 font-medium uppercase tracking-wide mb-1">Jumlah stok</p>
            <p class="text-lg font-semibold text-zinc-900">
                {{ $barang->jumlah_stok }} {{ $barang->satuan }}
                @if ($barang->isStokHabis())
                    <span class="ml-2 text-xs font-semibold px-2 py-0.5 bg-red-100 text-red-600 rounded-full">
                        Habis
                    </span>
                @elseif ($barang->isStokMenipis())
                    <span class="ml-2 text-xs font-semibold px-2 py-0.5 bg-amber-100 text-amber-600 rounded-full">
                        Menipis
                    </span>
                @endif
            </p>
        </div>

        {{-- Stok minimum --}}
        <div class="bg-white p-5">
            <p class="text-xs text-zinc-400 font-medium uppercase tracking-wide mb-1">Stok minimum</p>
            <p class="text-lg font-semibold text-zinc-900">{{ $barang->stok_minimum }} {{ $barang->satuan }}</p>
        </div>

        {{-- Harga jual --}}
        <div class="bg-white p-5">
            <p class="text-xs text-zinc-400 font-medium uppercase tracking-wide mb-1">Harga jual</p>
            <p class="text-lg font-semibold text-zinc-900">{{ $barang->harga_jual_format }}</p>
        </div>

        {{-- Harga beli --}}
        <div class="bg-white p-5">
            <p class="text-xs text-zinc-400 font-medium uppercase tracking-wide mb-1">Harga beli</p>
            <p class="text-lg font-semibold text-zinc-900">{{ $barang->harga_beli_format }}</p>
        </div>

        {{-- Berat / ukuran --}}
        <div class="bg-white p-5">
            <p class="text-xs text-zinc-400 font-medium uppercase tracking-wide mb-1">Berat / ukuran</p>
            <p class="text-lg font-semibold text-zinc-900">{{ $barang->berat_ukuran ?: '—' }}</p>
        </div>

        {{-- Lokasi simpan --}}
        <div class="bg-white p-5">
            <p class="text-xs text-zinc-400 font-medium uppercase tracking-wide mb-1">Lokasi simpan</p>
            <p class="text-lg font-semibold text-zinc-900">{{ $barang->lokasi_simpan ?: '—' }}</p>
        </div>

        {{-- Deskripsi (full width) --}}
        @if ($barang->deskripsi)
            <div class="bg-white p-5 sm:col-span-2">
                <p class="text-xs text-zinc-400 font-medium uppercase tracking-wide mb-1">Deskripsi</p>
                <p class="text-sm text-zinc-700 leading-relaxed">{{ $barang->deskripsi }}</p>
            </div>
        @endif

    </div>

    {{-- Footer tanggal --}}
    <div class="px-5 py-3 bg-zinc-50 border-t border-zinc-100">
        <p class="text-xs text-zinc-400">
            Ditambahkan {{ $barang->created_at->translatedFormat('d F Y') }}
            &middot;
            Diperbarui {{ $barang->updated_at->translatedFormat('d F Y') }}
        </p>
    </div>

</div>

@endsection