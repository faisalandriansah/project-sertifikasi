<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $table= 'kategoris';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];


    // untuk relasi nya satu kategori memiliki banyak barang
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }

    // hitung jumlah barang yang terdaftar dalam kategori ini
    public function jumlahBarang(): int
    {
        return $this->barangs()->count();
    }
}
