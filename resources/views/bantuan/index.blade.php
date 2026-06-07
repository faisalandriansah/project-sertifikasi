@extends('layouts.app')

@section('title', 'Bantuan')

@section('content')

    <div class="max-w-3xl space-y-5">

        {{-- ── Panduan Penggunaan  --}}
        <div class="bg-white rounded-2xl border border-zinc-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-zinc-100">
                <h1 class="font-bold text-zinc-900">Panduan Penggunaan Sistem</h1>
            </div>

            <div class="divide-y divide-zinc-100">

                {{-- Cara tambah barang --}}
                <div class="p-6">
                    <h2 class="text-sm font-semibold text-brand-600 mb-3">
                        Cara menambah barang baru
                    </h2>
                    <ol class="space-y-2">
                        <li class="flex gap-3 text-sm text-zinc-600">
                            <span
                                class="w-5 h-5 bg-brand-100 text-brand-700 rounded-full flex items-center
                                     justify-center shrink-0 text-xs font-bold mt-0.5">1</span>
                            Buka halaman <strong class="text-zinc-800">Dashboard</strong>, klik tombol
                            <strong class="text-zinc-800">+ Tambah Barang</strong> di kanan atas.
                        </li>
                        <li class="flex gap-3 text-sm text-zinc-600">
                            <span
                                class="w-5 h-5 bg-brand-100 text-brand-700 rounded-full flex items-center
                                     justify-center shrink-0 text-xs font-bold mt-0.5">2</span>
                            Unggah foto barang (opsional), lalu isi formulir: nama, kategori, satuan,
                            jumlah stok, harga, dan lainnya.
                        </li>
                        <li class="flex gap-3 text-sm text-zinc-600">
                            <span
                                class="w-5 h-5 bg-brand-100 text-brand-700 rounded-full flex items-center
                                     justify-center shrink-0 text-xs font-bold mt-0.5">3</span>
                            Klik <strong class="text-zinc-800">Simpan Barang</strong>. Barang akan
                            muncul di daftar dashboard.
                        </li>
                    </ol>
                </div>

                {{-- Cara update stok --}}
                <div class="p-6">
                    <h2 class="text-sm font-semibold text-brand-600 mb-3">
                        Cara update stok barang masuk
                    </h2>
                    <ol class="space-y-2">
                        <li class="flex gap-3 text-sm text-zinc-600">
                            <span
                                class="w-5 h-5 bg-brand-100 text-brand-700 rounded-full flex items-center
                                     justify-center shrink-0 text-xs font-bold mt-0.5">1</span>
                            Temukan barang di dashboard menggunakan kolom pencarian atau filter kategori.
                        </li>
                        <li class="flex gap-3 text-sm text-zinc-600">
                            <span
                                class="w-5 h-5 bg-brand-100 text-brand-700 rounded-full flex items-center
                                     justify-center shrink-0 text-xs font-bold mt-0.5">2</span>
                            Klik tombol <strong class="text-zinc-800">Edit</strong> pada baris barang tersebut.
                        </li>
                        <li class="flex gap-3 text-sm text-zinc-600">
                            <span
                                class="w-5 h-5 bg-brand-100 text-brand-700 rounded-full flex items-center
                                     justify-center shrink-0 text-xs font-bold mt-0.5">3</span>
                            Ubah nilai <strong class="text-zinc-800">Jumlah stok</strong> sesuai kondisi
                            saat ini, lalu klik <strong class="text-zinc-800">Simpan Barang</strong>.
                        </li>
                    </ol>
                </div>

                {{-- Cara kelola kategori --}}
                <div class="p-6">
                    <h2 class="text-sm font-semibold text-brand-600 mb-3">
                        Cara mengelola kategori
                    </h2>
                    <ol class="space-y-2">
                        <li class="flex gap-3 text-sm text-zinc-600">
                            <span
                                class="w-5 h-5 bg-brand-100 text-brand-700 rounded-full flex items-center
                                     justify-center shrink-0 text-xs font-bold mt-0.5">1</span>
                            Buka halaman <strong class="text-zinc-800">Kategori</strong> dari navigasi atas.
                        </li>
                        <li class="flex gap-3 text-sm text-zinc-600">
                            <span
                                class="w-5 h-5 bg-brand-100 text-brand-700 rounded-full flex items-center
                                     justify-center shrink-0 text-xs font-bold mt-0.5">2</span>
                            Tambah, edit, atau hapus kategori sesuai kebutuhan toko.
                        </li>
                        <li class="flex gap-3 text-sm text-zinc-600">
                            <span
                                class="w-5 h-5 bg-brand-100 text-brand-700 rounded-full flex items-center
                                     justify-center shrink-0 text-xs font-bold mt-0.5">3</span>
                            Menghapus kategori <strong class="text-zinc-800">tidak</strong> akan
                            menghapus barang — barang hanya menjadi tidak berkategori.
                        </li>
                    </ol>
                </div>

                {{-- Catatan --}}
                <div class="px-6 py-4 bg-zinc-50">
                    <div class="flex gap-2 items-start">
                        <svg class="w-4 h-4 text-zinc-400 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-xs text-zinc-500">
                            Satuan barang diisi bebas sesuai kebutuhan — misalnya:
                            <span class="font-medium text-zinc-700">pcs, pack, box, kg, liter</span>,
                            dan lain-lain.
                        </p>
                    </div>
                </div>

            </div>
        </div>

        {{-- ── Informasi Developer --}}
        <div class="bg-white rounded-2xl border border-zinc-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-zinc-100">
                <h2 class="font-bold text-zinc-900">Informasi Developer</h2>
            </div>
            <div class="p-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach ([['label' => 'Nama', 'value' => 'Achmad Faisal Andriansah', 'icon' => 'user'], ['label' => 'NIM', 'value' => '2331740019', 'icon' => 'hashtag'], ['label' => 'Kelas', 'value' => '3A', 'icon' => 'academic-cap'], ['label' => 'Alamat', 'value' => 'Jl. Srikaya No.42 Kecamatan Sukodono, Kabupaten Lumajang', 'icon' => 'location-marker'], ['label' => 'No. Telepon', 'value' => '+62-819-9911-3413', 'icon' => 'phone'], ['label' => 'Email', 'value' => 'faisalrahmad039@gmail.com', 'icon' => 'mail']] as $item)
                        <div class="flex items-start gap-3">
                            <div
                                class="w-8 h-8 bg-brand-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                @php
                                    $icons = [
                                        'user' =>
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />',
                                        'hashtag' =>
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />',
                                        'academic-cap' =>
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />',
                                        'location-marker' =>
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />',
                                        'phone' =>
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />',
                                        'mail' =>
                                            '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />',
                                    ];
                                @endphp
                                <svg class="w-4 h-4 text-brand-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    {!! $icons[$item['icon']] !!}
                                </svg>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-zinc-400 uppercase tracking-wide mb-0.5">
                                    {{ $item['label'] }}
                                </dt>
                                <dd class="text-sm font-medium text-zinc-800">{{ $item['value'] }}</dd>
                            </div>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>

    </div>

@endsection
