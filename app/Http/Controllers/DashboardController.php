<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // ambil parameter pencarian & filter dari url
        $keyword = $request->input('cari');
        $kategoriId = $request->input('kategori_id');

        // Ambil data barang sekalian dengan kategori-nya
        $query = Barang::with('kategori');

        if ($keyword) {
            $query->cariNama($keyword);
        }

        if ($kategoriId) {
            $query->filterKategori($kategoriId);
        }

        $barangs = $query->orderBy('nama_barang')->paginate(10)->withQueryString();

        // Data untuk card statistik
        $statistik = [
            'total_barang' => Barang::count(),
            'total_kategori' => Kategori::count(),
            'stok_menipis' => Barang::where('jumlah_stok', '<', 20)->count(),
            'stok_habis' => Barang::where('jumlah_stok', 0)->count(),
        ];

        // data untuk dropdown filter kategori
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        return view('dashboard.index', compact('barangs', 'statistik', 'kategoris', 'keyword', 'kategoriId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
