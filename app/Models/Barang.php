<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'satuan',
        'jumlah_stok',
        'stok_minimum',
        'harga_jual',
        'harga_beli',
        'berat_ukuran',
        'lokasi_simpan',
        'deskripsi',
        'gambar',
    ];

    protected $casts = [
        'jumlah_stok' => 'integer',
        'stok_minimum' => 'integer',
        'harga_jual' => 'decimal:2',
        'harga_beli' => 'decimal:2',
    ];

    // relasi nya setiap barang memiliki satu kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // filter berdasarkan nama (pencarian)

    public function scopeCariNama($query, string $keyword)
    {
        return $query->where('nama_barang', 'like', "%{$keyword}%");
    }

    // filter barang berdasarkan kategori
    public function scopeFilterKategori($query, int $kategoriId)
    {
        return $query->where('kategori_id', $kategoriId);
    }

    // barang dengan stok yang sudah habis (stok = 0)
    public function scopeStokHabis($query)
    {
        return $query->where('jumlah_stok', 0);
    }

    // barang stok yang menipis (stok > 0 dan < 20)
    public function scopeStokMenipis($query)
    {
        return $query->where('jumlah_stok', '>', 0)->where('jumlah_stok', '<', 20);
    }

    // format harga jual ke format rupiah
    public function getHargajualFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_jual, 0, ',', '.');
    }

    // format harga beli ke format rupiah
    public function getHargabeliFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_beli, 0, ',', '.');
    }

    // cek apakah stok barang ini tergolong menipis (<20)
    public function isStokMenipis(): bool
    {
        return $this->jumlah_stok < 20;
    }

    // cek apakah stok barang habis (= 0)
    public function isStokHabis(): bool
    {
        return $this->jumlah_stok === 0;
    }
}
