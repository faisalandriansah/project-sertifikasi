@extends('layouts.app')

@section('title', $title)

@section('content')

{{-- ── Header --}}
<div class="flex items-center gap-3 mb-6">
    <a href="{{ route('kategori.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-zinc-500 hover:text-zinc-900">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali
    </a>
    <span class="text-zinc-300">/</span>
    <h1 class="text-sm font-semibold text-zinc-900">{{ $title }}</h1>
</div>

{{-- ── Form --}}
<div class="bg-white rounded-2xl border border-zinc-200 overflow-hidden max-w-lg">

    @if ($kategori)
        <form method="POST" action="{{ route('kategori.update', $kategori) }}">
            @csrf @method('PUT')
    @else
        <form method="POST" action="{{ route('kategori.store') }}">
            @csrf
    @endif

        <div class="p-6 space-y-5">

            {{-- Nama kategori --}}
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-1.5">
                    Nama kategori <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="nama_kategori"
                       value="{{ old('nama_kategori', $kategori?->nama_kategori) }}"
                       placeholder="Contoh: Ayam, Seafood, Sayuran"
                       autofocus
                       class="w-full px-3.5 py-2.5 text-sm border rounded-lg outline-none
                              @error('nama_kategori') border-red-400 bg-red-50 @else border-zinc-200 @enderror
                              focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                @error('nama_kategori')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-1.5">
                    Deskripsi <span class="text-zinc-400 font-normal">(opsional)</span>
                </label>
                <textarea name="deskripsi"
                          rows="3"
                          placeholder="Produk berbahan dasar ayam beku..."
                          class="w-full px-3.5 py-2.5 text-sm border border-zinc-200 rounded-lg outline-none
                                 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 resize-none"
                >{{ old('deskripsi', $kategori?->deskripsi) }}</textarea>
            </div>

        </div>

        {{-- Tombol aksi --}}
        <div class="px-6 py-4 bg-zinc-50 border-t border-zinc-100 flex items-center justify-end gap-3">
            <a href="{{ route('kategori.index') }}"
               class="px-4 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-900">
                Batal
            </a>
            <button type="submit"
                    class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold
                           text-white bg-brand-600 hover:bg-brand-700 rounded-lg shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Simpan Kategori
            </button>
        </div>

    </form>
</div>

@endsection