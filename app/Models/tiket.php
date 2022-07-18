<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Concerns\SupportsDefaultModels;
use Illuminate\Database\Eloquent\SoftDeletes;

class tiket extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "tiket";

    protected $fillable = [
        'nama_tiket',
        'deskripsi',
        'harga',
        'id_tiket',
        'kloter',
        'kode',
        'status',
        'tgl_carter',
        'id_kategori'

    ];

    public function galeri_tiket() {
        return $this->hasMany(galeri_tiket::class, 'id_tiket', 'id');
    }

    public function items() {
        return $this->belongsTo(kategori_tiket::class, 'id_kategori', 'id');
    }
}
