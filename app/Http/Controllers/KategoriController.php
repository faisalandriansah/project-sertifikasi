<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource tampilkan semua kategori dan jumlah barang.
     */
    public function index(Request $request)
    { 
        $keyword = $request->input('cari');

        $kategoris = Kategori::withCount('barangs')->when($keyword, fn($q) => $q->where('nama_kategori', 'like', "%{keyword}%" ))->orderBy('nama_kategori')->get();

        return view('kategori.index', compact('kategoris', 'keyword'));
    }

    /**
     * Show the form for creating a new resource tambah kategori baru.
     */
    public function create()
    {
        return view('kategori.form', [
            'kategori' => null,
            'title' => 'Tambah Kategori Baru',
        ]);
    }

    /**
     * Store a newly created resource in storage simpan data ke database.
     */
    public function store(Request $request)
    {
        $validated = $this->validasiKategori($request);

        Kategori::create($validated);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.form', [
            'kategori' => $kategori,
            'title' => 'Edit Kategori',
        ]);
    }

    /**
     * Update the specified resource in storage update didatabase.
     */
    public function update(Request $request, Kategori $kategori)
    {
        $validated = $this->validasiKategori($request);

        $kategori->update($validated);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    // pengecekan (validasi) inputan
    private function validasiKategori(Request $request): array
    {
        return $request->validate([
            'nama_kategori'=>'required|string|max:100',
            'deskripsi'=>'nullable|string',
        ],[
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
        ]);
    }
}
