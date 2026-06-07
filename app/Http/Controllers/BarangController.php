<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource form tambah barang baru.
     */
    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('barang.form', [
            'barang' => null,
            'kategoris' => $kategoris,
            'title' => 'Tambah Barang Baru',
        ]);
    }

    /**
     * Store a newly created resource in storage simpan data baru.
     */
    public function store(Request $request)
    {
        $validated = $this->validasiBarang($request);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('barang', 'public');
        }

        Barang::create($validated);

        return redirect()->route('dashboard')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Display the specified resource tampilkan halaman detail satu barang.
     */
    public function show(Barang $barang)
    {
        $barang->load('kategori');
        return view('barang.detail', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource tampilkan halaman edit satu barang.
     */
    public function edit(Barang $barang)
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('barang.form', [
            'barang' => $barang,
            'kategoris' => $kategoris,
            'title' => 'Edit Barang',
        ]);
    }

    /**
     * Update the specified resource in storage update data di database.
     */
    public function update(Request $request, Barang $barang)
    {
        $validated = $this->validasiBarang($request, $barang->id);

        if ($request->hasFile('gambar')) {
            if ($barang->gambar) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('barang', 'public');
        }
        $barang->update($validated);

        return redirect()->route('dashboard')->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage hapus barang.
     */
    public function destroy(Barang $barang)
    {
        if ($barang->gambar) {
            Storage::disk('public')->delete($barang->gambar);
        }
        $barang->delete();

        return redirect()->route('dashboard')->with('success', 'Barang berhasil dihapus.');
    }

    // validasi input form barang dipakai untuk create dan update (pengecekan)
    private function validasiBarang(Request $request, ?int $barangId = null): array
    {
        return $request->validate([
            'nama_barang'   => 'required|string|max:150',
            'kategori_id'   => 'nullable|exists:kategoris,id',
            'satuan'        => 'required|string|max:50',
            'jumlah_stok'   => 'required|integer|min:0',
            'stok_minimum'  => 'nullable|integer|min:0',
            'harga_jual'    => 'nullable|numeric|min:0',
            'harga_beli'    => 'nullable|numeric|min:0',
            'berat_ukuran'  => 'nullable|string|max:100',
            'lokasi_simpan' => 'nullable|string|max:100',
            'deskripsi'     => 'nullable|string',
            'gambar'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // maks 2 MB
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'satuan.required'      => 'Satuan wajib diisi.',
            'jumlah_stok.required' => 'Jumlah stok wajib diisi.',
            'jumlah_stok.min'      => 'Jumlah stok tidak boleh negatif.',
            'gambar.image'           => 'File harus berupa gambar.',
            'gambar.mimes'           => 'Format gambar harus JPG atau PNG.',
            'gambar.max'             => 'Ukuran gambar maksimal 2 MB.',
        ]);
    }
}
