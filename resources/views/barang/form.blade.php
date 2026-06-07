@extends('layouts.app')

@section('title', $title)

@section('content')

    {{-- ── Header  --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-sm text-zinc-500 hover:text-zinc-900">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
        <span class="text-zinc-300">/</span>
        <h1 class="text-sm font-semibold text-zinc-900">{{ $title }}</h1>
    </div>

    {{-- ── Form  --}}
    <div class="bg-white rounded-2xl border border-zinc-200 overflow-hidden">

        @if ($barang)
            <form method="POST" action="{{ route('barang.update', $barang) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
            @else
                <form method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data">
                    @csrf
        @endif

        {{-- ── Upload Foto  --}}
        <div class="p-6 border-b border-zinc-100">
            <p class="text-sm font-semibold text-zinc-700 mb-3">Foto Barang</p>

            <div id="upload-area" onclick="document.getElementById('input-foto').click()"
                class="border-2 border-dashed border-zinc-200 rounded-xl p-8
                        flex flex-col items-center justify-center gap-3 cursor-pointer
                        hover:border-brand-400 hover:bg-brand-50/30 transition-colors">

                {{-- Preview foto --}}
                <div id="preview-wrapper" class="{{ $barang && $barang->gambar ? '' : 'hidden' }} text-center">
                    @if ($barang && $barang->gambar)
                        <img id="preview-foto" src="{{ asset('storage/' . $barang->gambar) }}"
                            onerror="this.onerror=null; this.parentElement.classList.add('hidden'); document.getElementById('placeholder-upload').classList.remove('hidden');"
                            alt="Preview" class="h-36 rounded-lg object-cover mx-auto mb-2 shadow-sm">
                        <p class="text-xs text-zinc-400">Klik untuk ganti foto</p>
                    @endif
                </div>

                {{-- Placeholder --}}
                <div id="placeholder-upload" class="{{ $barang && $barang->gambar ? 'hidden' : '' }} text-center">
                    <svg class="w-10 h-10 text-zinc-300 mx-auto mb-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01
                                         M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-sm text-zinc-500">Klik untuk memilih foto</p>
                    <p class="text-xs text-zinc-400 mt-0.5">Format JPG, PNG — Maks. 2 MB</p>
                </div>

            </div>

            <input type="file" id="input-foto" name="gambar" accept=".jpg,.jpeg,.png" class="hidden">

            @error('gambar')
                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- ── Field Barang --}}
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-5">

            {{-- Input reusable helper via @include tidak tersedia, jadi inline --}}

            {{-- Nama barang --}}
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-zinc-700 mb-1.5">
                    Nama barang <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_barang" value="{{ old('nama_barang', $barang?->nama_barang) }}"
                    placeholder="Contoh: Ayam nugget crispy"
                    class="w-full px-3.5 py-2.5 text-sm border rounded-lg outline-none
                              @error('nama_barang') border-red-400 bg-red-50 @else border-zinc-200 @enderror
                              focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                @error('nama_barang')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-1.5">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select name="kategori_id"
                    class="w-full px-3.5 py-2.5 text-sm border border-zinc-200 rounded-lg outline-none
                               focus:ring-2 focus:ring-brand-500 focus:border-brand-500 bg-white">
                    <option value="">Pilih kategori</option>
                    @foreach ($kategoris as $kat)
                        <option value="{{ $kat->id }}"
                            {{ old('kategori_id', $barang?->kategori_id) == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Satuan --}}
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-1.5">
                    Satuan <span class="text-red-500">*</span>
                </label>
                <input type="text" name="satuan" value="{{ old('satuan', $barang?->satuan) }}"
                    placeholder="pcs, pack, box, kg..."
                    class="w-full px-3.5 py-2.5 text-sm border rounded-lg outline-none
                              @error('satuan') border-red-400 bg-red-50 @else border-zinc-200 @enderror
                              focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                @error('satuan')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jumlah stok --}}
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-1.5">
                    Jumlah stok <span class="text-red-500">*</span>
                </label>
                <input type="number" name="jumlah_stok" min="0"
                    value="{{ old('jumlah_stok', $barang?->jumlah_stok ?? 0) }}"
                    class="w-full px-3.5 py-2.5 text-sm border rounded-lg outline-none
                              @error('jumlah_stok') border-red-400 bg-red-50 @else border-zinc-200 @enderror
                              focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
                @error('jumlah_stok')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            {{-- Stok minimum --}}
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-1.5">Stok minimum</label>
                <input type="number" name="stok_minimum" min="0"
                    value="{{ old('stok_minimum', $barang?->stok_minimum ?? 0) }}"
                    class="w-full px-3.5 py-2.5 text-sm border border-zinc-200 rounded-lg outline-none
                              focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
            </div>

            {{-- Harga jual --}}
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-1.5">Harga jual (Rp)</label>
                <input type="number" name="harga_jual" min="0"
                    value="{{ old('harga_jual', $barang?->harga_jual) }}" placeholder="0"
                    class="w-full px-3.5 py-2.5 text-sm border border-zinc-200 rounded-lg outline-none
                              focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
            </div>

            {{-- Harga beli --}}
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-1.5">Harga beli (Rp)</label>
                <input type="number" name="harga_beli" min="0"
                    value="{{ old('harga_beli', $barang?->harga_beli) }}" placeholder="0"
                    class="w-full px-3.5 py-2.5 text-sm border border-zinc-200 rounded-lg outline-none
                              focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
            </div>

            {{-- Berat / ukuran --}}
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-1.5">Berat / ukuran</label>
                <input type="text" name="berat_ukuran" value="{{ old('berat_ukuran', $barang?->berat_ukuran) }}"
                    placeholder="Contoh: 500 gram"
                    class="w-full px-3.5 py-2.5 text-sm border border-zinc-200 rounded-lg outline-none
                              focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
            </div>

            {{-- Lokasi simpan --}}
            <div>
                <label class="block text-sm font-medium text-zinc-700 mb-1.5">Lokasi simpan</label>
                <input type="text" name="lokasi_simpan" value="{{ old('lokasi_simpan', $barang?->lokasi_simpan) }}"
                    placeholder="Contoh: Rak A-3"
                    class="w-full px-3.5 py-2.5 text-sm border border-zinc-200 rounded-lg outline-none
                              focus:ring-2 focus:ring-brand-500 focus:border-brand-500">
            </div>

            {{-- Deskripsi --}}
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-zinc-700 mb-1.5">Deskripsi</label>
                <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat tentang barang..."
                    class="w-full px-3.5 py-2.5 text-sm border border-zinc-200 rounded-lg outline-none
                                 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 resize-none">{{ old('deskripsi', $barang?->deskripsi) }}</textarea>
            </div>

        </div>

        {{-- ── Tombol Aksi --}}
        <div class="px-6 py-4 bg-zinc-50 border-t border-zinc-100 flex items-center justify-end gap-3">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-zinc-600 hover:text-zinc-900">
                Batal
            </a>
            <button type="submit"
                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold
                           text-white bg-brand-600 hover:bg-brand-700 rounded-lg shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                Simpan Barang
            </button>
        </div>

        </form>
    </div>

@endsection

@push('scripts')
    <script>
        document.getElementById('input-foto').addEventListener('change', function() {
            const file = this.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('preview-foto').src = e.target.result;
                document.getElementById('preview-wrapper').classList.remove('hidden');
                document.getElementById('placeholder-upload').classList.add('hidden');
            };
            reader.readAsDataURL(file);
        });
    </script>
@endpush
